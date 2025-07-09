<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
    <!-- Chat header -->
    <div class="bg-indigo-600 text-white p-4">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-xl font-semibold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                    </svg>
                    <div class="flex items-center space-x-2">
                        @if($receiver->image)
                            <img src="{{ asset('uploads/user/' . $receiver->image) }}" class="h-8 w-8 rounded-full object-cover" alt="Receiver Avatar">
                        @else
                            <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center text-sm font-semibold text-gray-600">
                                {{ strtoupper(substr($receiver->name ?? '?', 0, 1)) }}
                            </div>
                        @endif
                        <span class="font-medium">
                            {{ $receiver->name ?? 'Unknown' }}
                        </span>
                    </div>
                    Live Chat
                </h2>
                <p class="text-indigo-100 text-sm flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                    Messages refresh every 2 seconds
                </p>
            </div>
            <button wire:click="confirmAction('chat_clear')" class="text-sm text-red-300 hover:text-white transition">
                Clear All Chat
            </button>
        </div>
    </div>

    <!-- Confirmation Dialog -->
    @if($showConfirmation)
        <div class="bg-red-50 border border-red-200 text-red-700 p-3 mx-4 mt-2 rounded-lg">
            <p class="mb-2">
                @if($confirmationType === 'message_delete')
                    Are you sure you want to delete this message?
                @elseif($confirmationType === 'chat_clear')
                    Are you sure you want to clear all chat messages?
                @endif
            </p>
            <div class="flex space-x-2">
                <button wire:click="executeConfirmedAction" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Yes, Continue
                </button>
                <button wire:click="cancelConfirmation" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                    Cancel
                </button>
            </div>
        </div>
    @endif

    <!-- Messages container -->
    <div wire:poll.2000ms class="h-96 overflow-y-auto p-4 bg-gray-50">
        @foreach ($messages as $msg)
            <div class="mb-4 flex {{ $msg->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-xs lg:max-w-md">
                    @if ($editingMessageId === $msg->id)
                        <div class="bg-white p-3 rounded-lg shadow border border-gray-200">
                            <input
                                type="text"
                                wire:model.defer="editingMessageText"
                                wire:keydown.enter="updateMessage"
                                class="w-full border-b-2 border-indigo-300 focus:border-indigo-500 focus:outline-none p-2"
                                autofocus
                            >
                            <div class="flex justify-end mt-2 space-x-2">
                                <button wire:click="updateMessage" class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Save
                                </button>
                                <button wire:click="cancelEditing" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    Cancel
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="relative">
                            <div class="flex items-center space-x-2 mb-1">
                                @if ($msg->sender && $msg->sender->image)
                                    <img src="{{ asset('uploads/user/' . $msg->sender->image) }}" class="h-6 w-6 rounded-full object-cover" alt="Avatar">
                                @else
                                    <div class="h-6 w-6 rounded-full bg-gray-400 flex items-center justify-center text-xs text-white">
                                        {{ strtoupper(substr($msg->sender->name ?? '?', 0, 1)) }}
                                    </div>
                                @endif
                                <span class="text-xs text-gray-500">
                                    {{ $msg->sender->name ?? 'Unknown' }}
                                </span>
                            </div>
                            <div class="{{ $msg->sender_id == auth()->id() ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800' }} p-3 rounded-lg shadow">
                                {{ $msg->message }}
                            </div>

                            <!-- Message tail -->
                            <div class="absolute top-0 {{ $msg->sender_id == auth()->id() ? 'right-0 -mr-1' : 'left-0 -ml-1' }}">
                                <svg class="h-4 w-4 {{ $msg->sender_id == auth()->id() ? 'text-indigo-600' : 'text-gray-200' }}" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 0L0 10h20L10 0z" />
                                </svg>
                            </div>

                            @if ($msg->sender_id == auth()->id())
                                <div class="flex justify-end mt-1 space-x-2">
                                    <button wire:click="startEditing({{ $msg->id }})" class="text-xs text-indigo-500 hover:text-indigo-700 transition flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button wire:click="confirmAction('message_delete', {{ $msg->id }})" class="text-xs text-red-500 hover:text-red-700 transition flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Message input -->
    <div class="border-t border-gray-200 p-4 bg-gray-50">
        <div class="flex items-center space-x-2">
            <input
                wire:model="message"
                wire:keydown.enter="sendMessage"
                type="text"
                class="flex-1 border-2 border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:border-indigo-500 transition"
                placeholder="Type your message..."
            >
            <button
                wire:click="sendMessage"
                class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center justify-center"
                title="Send message"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                <span class="sr-only">Send message</span>
            </button>
        </div>
    </div>
</div>
