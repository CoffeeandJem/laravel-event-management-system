<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
    ];

    // Relationship: A Registration belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A Registration belongs to an Event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
