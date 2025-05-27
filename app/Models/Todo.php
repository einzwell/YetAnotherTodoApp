<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'due_date',
        'completed_at',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'due_date' => 'date',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsCompleted(): void
    {
        $this->update([
            'is_completed' => true,
            'completed_at' => now(),
        ]);
    }

    public function markAsIncomplete(): void
    {
        $this->update([
            'is_completed' => false,
            'completed_at' => null,
        ]);
    }

    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date->isPast() && !$this->is_completed;
    }

    public function isDueToday(): bool
    {
        return $this->due_date && $this->due_date->isToday();
    }
}
