<div class="container mt-4">
    <div class="header text-center mb-4">
        <h6 class="">My Task Manager</h6>
        <p class="lead text-muted">Stay organized and productive</p>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h2 class="h5 mb-0">{{ $editTaskId ? 'Edit Task' : 'Add New Task' }}</h2>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="{{ $editTaskId ? 'updateTask' : 'addTask' }}">
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Task Title</label>
                            <input
                                type="text"
                                wire:model="title"
                                id="title"
                                placeholder="What needs to be done?"
                                class="form-control"
                            >
                            @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea
                                wire:model="description"
                                id="description"
                                placeholder="Add details..."
                                class="form-control"
                                rows="3"
                            ></textarea>
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary">
                                {{ $editTaskId ? 'Update Task' : 'Add Task' }}
                            </button>

                            @if($editTaskId)
                                <button type="button" wire:click="cancelEdit" class="btn btn-secondary ms-2">
                                    Cancel
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="h4 mb-3">Your Tasks</h2>

            @if(count($tasks) > 0)
                <div class="list-group">
                    @foreach($tasks as $task)
                        <div class="list-group-item mb-3 shadow-sm rounded">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h3 class="h5 mb-0">{{ $task->title }}</h3>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-secondary" wire:click="editTask({{ $task->id }})" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" wire:click="deleteTask({{ $task->id }})" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="text-muted mb-2">{{ $task->description }}</p>
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">Created: {{ $task->created_at->timezone('Asia/Karachi')->format('M d, Y h:i A') }}</small>
                                <small class="text-muted">Updated: {{ \Carbon\Carbon::parse($task->updated_at)->timezone('Asia/Karachi')->format('M d, Y h:i A') }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#6c757d" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                    <h3 class="h4">No tasks yet</h3>
                    <p class="text-muted">Add your first task to get started!</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('taskAdded', function () {
            alert('Task added successfully!');
        });
        Livewire.on('taskUpdated', function () {
            alert('Task updated successfully!');
        });
        Livewire.on('taskDeleted', function () {
            alert('Task deleted successfully!');
        });
    });
</script>
