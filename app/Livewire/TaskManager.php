<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class TaskManager extends Component
{
    public $title, $description, $tasks, $editMode = false, $editTaskId = null;

    public function mount()
    {
        $this->tasks = Task::latest()->get();
    }

    public function addTask()
    {
        $this->validate(['title' => 'required']);

        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => Auth::id(),
        ]);

        $this->resetFields();
        $this->tasks = Task::latest()->get();
        $this->js('window.dispatchEvent(new CustomEvent("task-added"))');
    }


    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        $this->editMode = true;
        $this->editTaskId = $id;
        $this->title = $task->title;
        $this->description = $task->description;
    }

    public function updateTask()
    {
        $this->validate(['title' => 'required']);

        $task = Task::findOrFail($this->editTaskId);
        $task->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        $this->resetFields();
        $this->tasks = Task::latest()->get();
        $this->js('window.dispatchEvent(new CustomEvent("task-added"))');
    }
    public function cancelEdit()
    {
        $this->resetFields();
    }

    public function deleteTask($id)
    {
        Task::findOrFail($id)->delete();
        $this->tasks = Task::latest()->get();
        $this->js('window.dispatchEvent(new CustomEvent("task-added"))');
    }


    private function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->editMode = false;
        $this->editTaskId = null;
    }

}
