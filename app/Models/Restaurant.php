<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'description',
        'logo',
        'header_video',
        'phone',
        'address',
        'subscription_end_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'subscription_end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($restaurant) {
            if (empty($restaurant->slug)) {
                $slug = Str::slug($restaurant->name);
                $count = 1;

                // Benzersiz slug oluştur
                while (static::where('slug', $slug)->exists()) {
                    $slug = Str::slug($restaurant->name) . '-' . $count;
                    $count++;
                }

                $restaurant->slug = $slug;
            }
        });

        static::updating(function ($restaurant) {
            if ($restaurant->isDirty('name') && empty($restaurant->slug)) {
                $slug = Str::slug($restaurant->name);
                $count = 1;

                while (static::where('slug', $slug)->where('id', '!=', $restaurant->id)->exists()) {
                    $slug = Str::slug($restaurant->name) . '-' . $count;
                    $count++;
                }

                $restaurant->slug = $slug;
            }
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function categoryImages()
    {
        return $this->hasMany(RestaurantCategoryImage::class);
    }

    public function isSubscriptionActive()
    {
        return $this->subscription_end_date && $this->subscription_end_date->isFuture();
    }
}
