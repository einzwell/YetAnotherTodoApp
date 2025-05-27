<x-app-layout>
    <div class="todo-container">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-0">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Search -->
                <div class="search-box">
                    <form method="GET" action="{{ route('todos.index') }}">
                        <div class="relative">
                            <input
                                    type="text"
                                    name="search"
                                    class="search-input"
                                    placeholder="Search todos..."
                                    value="{{ request('search') }}"
                            >
                            <input type="hidden" name="filter" value="{{ request('filter', 'all') }}">
                        </div>
                    </form>
                </div>

                <!-- Add Todo Button -->
                <a href="{{ route('todos.create') }}" class="add-todo-btn">
                    <i class="fas fa-plus"></i>
                    Add Task
                </a>

                <!-- Filters -->
                <div class="mt-6">
                    <a href="{{ route('todos.index', ['filter' => 'all', 'search' => request('search')]) }}"
                       class="sidebar-item {{ $filter === 'all' ? 'active' : '' }}">
                        <div class="flex items-center justify-between w-full">
                            <span><i class="fas fa-list"></i>All Tasks</span>
                            <span>{{ $stats['total'] }}</span>
                        </div>
                    </a>
                    <a href="{{ route('todos.index', ['filter' => 'pending', 'search' => request('search')]) }}"
                       class="sidebar-item {{ $filter === 'pending' ? 'active' : '' }}">
                        <div class="flex items-center justify-between w-full">
                            <span><i class="fas fa-clock"></i>Pending</span>
                            <span>{{ $stats['pending'] }}</span>
                        </div>
                    </a>
                    <a href="{{ route('todos.index', ['filter' => 'today', 'search' => request('search')]) }}"
                       class="sidebar-item {{ $filter === 'today' ? 'active' : '' }}">
                        <div class="flex items-center justify-between w-full">
                            <span><i class="fas fa-calendar-day"></i>Due Today</span>
                            <span>{{ $stats['today'] }}</span>
                        </div>
                    </a>
                    <a href="{{ route('todos.index', ['filter' => 'overdue', 'search' => request('search')]) }}"
                       class="sidebar-item {{ $filter === 'overdue' ? 'active' : '' }}">
                        <div class="flex items-center justify-between w-full">
                            <span><i class="fas fa-exclamation-triangle"></i>Overdue</span>
                            <span>{{ $stats['overdue'] }}</span>
                        </div>
                    </a>
                    <a href="{{ route('todos.index', ['filter' => 'completed', 'search' => request('search')]) }}"
                       class="sidebar-item {{ $filter === 'completed' ? 'active' : '' }}">
                        <div class="flex items-center justify-between w-full">
                            <span><i class="fas fa-check"></i>Completed</span>
                            <span style="text-align: left">{{ $stats['completed'] }}</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Todo List -->
            <div class="lg:col-span-3">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">
                            @switch($filter)
                                @case('pending')
                                    Pending Tasks
                                    @break
                                @case('completed')
                                    Completed Tasks
                                    @break
                                @case('today')
                                    Due Today
                                    @break
                                @case('overdue')
                                    Overdue Tasks
                                    @break
                                @default
                                    All Tasks
                            @endswitch
                            @if(request('search'))
                                - "{{ request('search') }}"
                            @endif
                        </h2>
                        <span class="text-sm text-gray-500">{{ $todos->total() }} tasks</span>
                    </div>

                    @if($todos->count() > 0)
                        <div class="space-y-0">
                            @foreach($todos as $todo)
                                <div class="todo-item">
                                    <!-- Checkbox -->
                                    <form method="POST" action="{{ route('todos.toggle', $todo) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="todo-checkbox {{ $todo->is_completed ? 'completed' : '' }}">
                                            @if($todo->is_completed)
                                                <i class="fas fa-check text-xs"></i>
                                            @endif
                                        </button>
                                    </form>

                                    <!-- Content -->
                                    <div class="todo-content">
                                        <div class="todo-title {{ $todo->is_completed ? 'completed' : '' }}">
                                            {{ $todo->title }}
                                        </div>
                                        @if($todo->description)
                                            <div class="todo-description">
                                                {{ Str::limit($todo->description, 100) }}
                                            </div>
                                        @endif
{{--                                        <div class="todo-meta">--}}
{{--                                            <span>--}}
{{--                                                <i class="fas fa-calendar-plus text-xs mr-1"></i>--}}
{{--                                                Created {{ $todo->created_at->format('M j, Y') }}--}}
{{--                                            </span>--}}
{{--                                            @if($todo->updated_at != $todo->created_at)--}}
{{--                                                <span>--}}
{{--                                                    <i class="fas fa-edit text-xs mr-1"></i>--}}
{{--                                                    Updated {{ $todo->updated_at->format('M j, Y') }}--}}
{{--                                                </span>--}}
{{--                                            @endif--}}
{{--                                            @if($todo->due_date)--}}
{{--                                                <span class="due-date {{ $todo->isOverdue() ? 'overdue' : ($todo->isDueToday() ? 'today' : '') }}">--}}
{{--                                                    <i class="fas fa-calendar text-xs mr-1"></i>--}}
{{--                                                    Due {{ $todo->due_date->format('M j, Y') }}--}}
{{--                                                    @if($todo->isOverdue())--}}
{{--                                                        (Overdue)--}}
{{--                                                    @elseif($todo->isDueToday())--}}
{{--                                                        (Today)--}}
{{--                                                    @endif--}}
{{--                                                </span>--}}
{{--                                            @endif--}}
{{--                                            @if($todo->completed_at)--}}
{{--                                                <span class="text-green-600">--}}
{{--                                                    <i class="fas fa-check-circle text-xs mr-1"></i>--}}
{{--                                                    Completed {{ $todo->completed_at->format('M j, Y') }}--}}
{{--                                                </span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
                                    </div>

                                    <!-- Actions -->
                                    <div class="todo-actions">
                                        <a href="{{ route('todos.edit', $todo) }}" class="btn-icon" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('todos.destroy', $todo) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon delete" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this task?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($todos->hasPages())
                            <div class="mt-6">
                                {{ $todos->withQueryString()->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-clipboard-list text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No tasks found</h3>
                            <p class="text-gray-500 mb-4">
                                @if(request('search'))
                                    No tasks match your search criteria.
                                @else
                                    Get started by creating your first task.
                                @endif
                            </p>
                            <a href="{{ route('todos.create') }}" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i>
                                Create your first task
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
