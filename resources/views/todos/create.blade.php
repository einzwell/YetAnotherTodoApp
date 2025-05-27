<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Create New Task
                    </h2>
                </div>

                <form method="POST" action="{{ route('todos.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="form-label">
                            Title *
                        </label>
                        <input
                                type="text"
                                id="title"
                                name="title"
                                class="form-input @error('title') border-red-500 @enderror"
                                value="{{ old('title') }}"
                                required
                                autofocus
                                placeholder="Enter task title..."
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
                                placeholder="Enter task description..."
                        >{{ old('description') }}</textarea>
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
                                value="{{ old('due_date') }}"
                                min="{{ date('Y-m-d') }}"
                        >
                        @error('due_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            Create Task
                        </button>
                        <a href="{{ route('todos.index') }}" class="btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
