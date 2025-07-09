<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    // Properties
    public $receiverId;
    public $message = '';
    public $messages;
    public $receiver;

    // Message editing state
    public $editingMessageId = null;
    public $editingMessageText = '';

    // Confirmation states
    public $showConfirmation = false;
    public $confirmationType = ''; // 'message_delete', 'chat_clear'
    public $confirmationTargetId = null;

    public function mount($receiverId)
    {
        $this->receiverId = $receiverId;
        $this->receiver = User::findOrFail($receiverId);
        $this->loadMessages();
    }

    /**
     * Load messages between current user and receiver
     */
    public function loadMessages()
    {
        $this->messages = Message::with('sender')
            ->where(function ($query) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $this->receiverId);
            })
            ->orWhere(function ($query) {
                $query->where('sender_id', $this->receiverId)
                      ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at')
            ->get();
    }

    /**
     * Send a new message
     */
            public function sendMessage()
                {
                    if ($this->message !== '') {
                        Message::create([
                            'sender_id' => Auth::id(),
                            'receiver_id' => $this->receiverId,
                            'message' => $this->message,
                        ]);

                        $this->message = '';
                        $this->loadMessages(); // Reload after sending
                    }
                }

    /**
     * Prepare a message for editing
     */
    public function startEditing($messageId)
    {
        $message = Message::findOrFail($messageId);

        if ($message->sender_id !== Auth::id()) {
            return;
        }

        $this->editingMessageId = $messageId;
        $this->editingMessageText = $message->message;
    }

    /**
     * Save edited message
     */
    public function updateMessage()
    {
        $this->validate(['editingMessageText' => 'required|string|max:1000']);

        if ($this->editingMessageId) {
            $message = Message::findOrFail($this->editingMessageId);

            if ($message->sender_id === Auth::id()) {
                $message->update(['message' => $this->editingMessageText]);
            }

            $this->cancelEditing();
            $this->loadMessages();
        }
    }

    /**
     * Cancel the editing process
     */
    public function cancelEditing()
    {
        $this->reset(['editingMessageId', 'editingMessageText']);
    }

    /**
     * Show confirmation dialog for destructive actions
     */
    public function confirmAction($type, $targetId = null)
    {
        $this->confirmationType = $type;
        $this->confirmationTargetId = $targetId;
        $this->showConfirmation = true;
    }

    /**
     * Cancel any pending confirmation
     */
    public function cancelConfirmation()
    {
        $this->reset(['showConfirmation', 'confirmationType', 'confirmationTargetId']);
    }

    /**
     * Execute the confirmed action
     */
    public function executeConfirmedAction()
    {
        switch ($this->confirmationType) {
            case 'message_delete':
                $this->deleteMessage($this->confirmationTargetId);
                break;

            case 'chat_clear':
                $this->clearAllMessages();
                break;
        }

        $this->cancelConfirmation();
    }

    /**
     * Delete a specific message
     */
    protected function deleteMessage($messageId)
    {
        $message = Message::findOrFail($messageId);

        if ($message->sender_id === Auth::id()) {
            $message->delete();
            $this->loadMessages();
        }
    }

    /**
     * Clear all messages in the chat
     */
    protected function clearAllMessages()
    {
        Message::where(function ($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->receiverId);
        })
        ->orWhere(function ($query) {
            $query->where('sender_id', $this->receiverId)
                ->where('receiver_id', Auth::id());
        })
        ->delete();
    }

    public function render()
    {
        $this->loadMessages();
        return view('livewire.chat');
    }
}
