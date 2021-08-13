<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'content',
        'status',
        'image',
        'user_id',
        'updated_at',
        'date_end'
    ];


    public function user()
    {
        return $this->belongsTo(Admin::class);
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'event_guest', 'event_id', 'guest_id')->withPivot('id'); // role_idla khoa ngoai trong bang pivot cua model tao ra lien ket
    }
}
