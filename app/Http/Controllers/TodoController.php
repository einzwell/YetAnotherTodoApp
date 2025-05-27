<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->get('filter', 'all');
        $search = $request->get('search');

        $query = auth()->user()->todos()->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        switch ($filter) {
            case 'completed':
                $query->where('is_completed', true);
                break;
            case 'pending':
                $query->where('is_completed', false);
                break;
            case 'today':
                $query->whereDate('due_date', today());
                break;
            case 'overdue':
                $query->where('due_date', '<', today())
                    ->where('is_completed', false);
                break;
        }

        $todos = $query->paginate(20);

        $stats = [
            'total' => auth()->user()->todos()->count(),
            'completed' => auth()->user()->completedTodos()->count(),
            'pending' => auth()->user()->pendingTodos()->count(),
            'today' => auth()->user()->todos()->whereDate('due_date', today())->count(),
            'overdue' => auth()->user()->todos()
                ->where('due_date', '<', today())
                ->where('is_completed', false)
                ->count(),
        ];

        return view('todos.index', compact('todos', 'filter', 'search', 'stats'));
    }

    public function create(): View
    {
        return view('todos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date|after_or_equal:today',
        ]);

        auth()->user()->todos()->create($validated);

        return redirect()->route('todos.index')
            ->with('success', 'Todo item created successfully!');
    }

    public function show(Todo $todo): View
    {
        $this->authorize('view', $todo);
        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo): View
    {
        $this->authorize('update', $todo);
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo): RedirectResponse
    {
        $this->authorize('update', $todo);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $todo->update($validated);

        return redirect()->route('todos.index')
            ->with('success', 'Todo item updated successfully!');
    }

    public function destroy(Todo $todo): RedirectResponse
    {
        $this->authorize('delete', $todo);

        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'Todo item deleted successfully!');
    }

    public function toggle(Todo $todo): RedirectResponse
    {
        $this->authorize('update', $todo);

        if ($todo->is_completed) {
            $todo->markAsIncomplete();
        } else {
            $todo->markAsCompleted();
        }

        return back()->with('success', 'Todo status updated!');
    }
}
