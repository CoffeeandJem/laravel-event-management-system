<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'venue',
        'capacity',
    ];
    protected $casts = [
        'date' => 'date', // Automatically casts 'date' column to a Carbon date object
        // You could cast time too, depending on its DB type and how you use it.
        // If DB type is TIME: maybe 'datetime:H:i' for formatting or handle in view.
        // If DB type is DATETIME/TIMESTAMP: 'time' => 'datetime',
    ];

    // Relationship: An Event has many Registrations
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
