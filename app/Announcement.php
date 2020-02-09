<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title', 'body'
    ];

    protected $hidden = [
        'id'
    ];
}
