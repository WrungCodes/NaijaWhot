<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stake extends Model
{

    public const STAKE_PENDING = 'pending';

    public const STAKE_FAILED = 'failed';

    public const STAKE_SUCCESSFUL = 'successful';

    protected $fillable = [
        'amount', 'user_id', 'stake_type_uid', 'status'
    ];

    protected $hidden = [
        'id'
    ];
}
