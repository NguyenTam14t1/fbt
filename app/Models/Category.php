<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
