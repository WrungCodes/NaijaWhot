<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public const SUPER_ADMIN_USER = 1;
    public const ADMIN_USER = 2;
    public const PLAYER_USER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];
}
