<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $fillable = [
        'name',
        'address',
        'mail',
        'phone',
        'gender',
        'information',
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
