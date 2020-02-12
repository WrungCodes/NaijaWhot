<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NairaHistory extends Model
{
    public const DEBIT_TYPE = 'debit';
    public const CREDIT_TYPE = 'credit';

    public const DEPOSIT_TYPE = 'deposit';
    public const WITHDRAWAL_TYPE = 'withdrawal';
    public const STAKE_TYPE = 'stake';
    public const WIN_TYPE = 'win';
    public const REFUND_TYPE = 'refund';

    protected $fillable = [
        'initial_amount', 'final_amount', 'type', 'user_id', 'amount'
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'initial_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
    ];
}
