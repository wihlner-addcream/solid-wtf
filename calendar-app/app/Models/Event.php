<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'start_time', 'end_time'];

    public function rsvps(): HasMany
    {
        return $this->hasMany(Rsvp::class);
    }
}
