<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'name', 'event_start', 'event_end', 'event_type_id'
    ];

    /**
     * Get the event type that owns the event.
     */
    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

}
