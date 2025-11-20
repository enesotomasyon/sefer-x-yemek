<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'description',
        'logo',
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

    public function isSubscriptionActive()
    {
        return $this->subscription_end_date && $this->subscription_end_date->isFuture();
    }
}
