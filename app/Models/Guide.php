<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hash;

class Guide extends Model
{
    protected $fillable = [
        'name',
        'address',
        'mail',
        'password',
        'phone',
        'category_id',
    ];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_guide', 'guide_id', 'tour_id');
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::make($value);
    }
}
