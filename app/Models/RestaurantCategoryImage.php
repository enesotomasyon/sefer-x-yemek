<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantCategoryImage extends Model
{
    protected $fillable = [
        'restaurant_id',
        'category_id',
        'image',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
