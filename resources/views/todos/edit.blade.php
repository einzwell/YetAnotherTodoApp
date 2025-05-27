<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Edit Task
                    </h2>
                </div>

                <!-- Task Status Toggle -->
                <div class="mb-6 p-4 rounded-lg {{ $todo->is_completed ? 'bg-green-50 border border-green-200' : 'bg-blue-50 border border-blue-200' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @if($todo->is_completed)
                                <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                                <div>
                                    <h3 class="font-semibold text-green-800">Task Completed</h3>
                                    <p class="text-green-600 text-sm">
                                        Completed on {{ $todo->completed_at->format('F j, Y \a\t g:i A') }}
                                    </p>
                                </div>
                            @else
                                <i class="fas fa-clock text-blue-600 text-xl mr-3"></i>
                                <div>
                                    <h3 class="font-semibold text-blue-800">Task Pending</h3>
                                    @if($todo->due_date)
                                        <p class="text-blue-600 text-sm">
                                            @if($todo->isOverdue())
                                                <span class="text-red-600 font-medium">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                                    Overdue since {{ $todo->due_date->format('F j, Y') }}
                                                </span>
                                            @elseif($todo->isDueToday())
                                                <span class="text-yellow-600 font-medium">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Due today
                                                </span>
                                            @else
                                                Due on {{ $todo->due_date->format('F j, Y') }}
                                            @endif
                                        </p>
                                    @else
                                        <p class="text-blue-600 text-sm">No due date set</p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Toggle Status Button -->
                        <form method="POST" action="{{ route('todos.toggle', $todo) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-primary flex items-center gap-2">
                                @if($todo->is_completed)
                                    <i class="fas fa-undo"></i>
                                    Mark as Pending
                                @else
                                    <i class="fas fa-check"></i>
                                    Mark as Complete
                                @endif
                            </button>
                        </form>
                    </div>
                </div>

                <form method="POST" action="{{ route('todos.update', $todo) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="title" class="form-label">
                            Title *
                        </label>
                        <input
                                type="text"
                                id="title"
                                name="title"
                                class="form-input @error('title') border-red-500 @enderror"
                                value="{{ old('title', $todo->title) }}"
                                required
                                autofocus
                        >
                        @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">
                            Description
                        </label>
                        <textarea
                                id="description"
                                name="description"
                                class="form-input form-textarea @error('description') border-red-500 @enderror"
                        >{{ old('description', $todo->description) }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="due_date" class="form-label">
                            Due Date
                        </label>
                        <input
                                type="date"
                                id="due_date"
                                name="due_date"
                                class="form-input @error('due_date') border-red-500 @enderror"
                                value="{{ old('due_date', $todo->due_date?->format('Y-m-d')) }}"
                        >
                        @error('due_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Leave empty to remove due date</p>
                    </div>

                    <!-- Task Metadata -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <h3 class="font-medium text-gray-900 mb-3">
                            <i class="fas fa-info-circle mr-1"></i>
                            Task Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div>
                                <strong>Created:</strong>
                                <div>{{ $todo->created_at->format('M j, Y g:i A') }}</div>
                                <div class="text-xs text-gray-500">{{ $todo->created_at->diffForHumans() }}</div>
                            </div>
                            @if($todo->updated_at != $todo->created_at)
                                <div>
                                    <strong>Last Updated:</strong>
                                    <div>{{ $todo->updated_at->format('M j, Y g:i A') }}</div>
                                    <div class="text-xs text-gray-500">{{ $todo->updated_at->diffForHumans() }}</div>
                                </div>
                            @endif
                            @if($todo->completed_at)
                                <div>
                                    <strong>Completed:</strong>
                                    <div>{{ $todo->completed_at->format('M j, Y g:i A') }}</div>
                                    <div class="text-xs text-gray-500">{{ $todo->completed_at->diffForHumans() }}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4 justify-between">
                        <a href="{{ route('todos.index') }}" class="btn-secondary">
                            Cancel
                        </a>
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('todos.destroy', $todo) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-secondary bg-red-600 hover:bg-red-500 text-white hover:text-white"
                                        onclick="return confirm('Are you sure you want to delete this task?')">
                                    <i class="fas fa-trash mr-2"></i>
                                    Delete
                                </button>
                            </form>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
