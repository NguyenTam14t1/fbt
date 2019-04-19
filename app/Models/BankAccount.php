<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'user_id',
        'card_number',
        'bank_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
