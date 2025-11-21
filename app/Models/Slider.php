<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'image',
        'link_type',
        'link_id',
        'external_url',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function getLink()
    {
        if ($this->link_type === 'product' && $this->link_id) {
            return route('products.show', $this->link_id);
        } elseif ($this->link_type === 'restaurant' && $this->link_id) {
            return route('restaurants.menu', $this->link_id);
        } elseif ($this->link_type === 'external' && $this->external_url) {
            return $this->external_url;
        }
        return '#';
    }
}
