<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'id',
    ];


    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_guest', 'guest_id', 'event_id');
    }
}
