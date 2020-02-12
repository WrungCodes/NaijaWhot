<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public const TRANSACTION_PENDING = 'pending';

    public const TRANSACTION_FAILED = 'failed';

    public const TRANSACTION_SUCCESSFUL = 'successful';

    public const TRANSACTION_TYPE_COMBO = 'combo';

    public const TRANSACTION_TYPE_NAIRA = 'naira';

    protected $fillable = [
        'amount', 'user_id', 'platform', 'transaction_type', 'transaction_ref', 'access_code', 'status'
    ];

    protected $hidden = [
        'id'
    ];

    public function withdrawal()
    {
        return $this->hasOne(Withdrawal::class, 'transaction_id');
    }
}
