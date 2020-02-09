<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id', 'title', 'body', 'is_read', 'uid'
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
