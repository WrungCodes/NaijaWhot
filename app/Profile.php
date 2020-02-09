<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naira_balance', 'user_id', 'points'
    ];

    protected $hidden = [
        'id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
