<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'location',
        'price_per_night', 'category',
        'has_ac', 'has_wifi', 'has_restaurant', 'has_front_desk',
        'has_parking', 'has_pool', 'has_gym', 'has_laundry',
        'is_active',
    ];

    protected $casts = [
        'has_ac'          => 'boolean',
        'has_wifi'        => 'boolean',
        'has_restaurant'  => 'boolean',
        'has_front_desk'  => 'boolean',
        'has_parking'     => 'boolean',
        'has_pool'        => 'boolean',
        'has_gym'         => 'boolean',
        'has_laundry'     => 'boolean',
        'is_active'       => 'boolean',
        'price_per_night' => 'decimal:2',
    ];

    // Scope: only active hotels
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: by category
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/hotel-placeholder.jpg');
    }

    // Get facilities as array
    public function getFacilitiesAttribute()
    {
        $facilities = [];
        if ($this->has_ac)          $facilities[] = 'AC';
        if ($this->has_wifi)        $facilities[] = 'Wi-Fi';
        if ($this->has_restaurant)  $facilities[] = 'Restaurant';
        if ($this->has_front_desk)  $facilities[] = '24-Hour Front Desk';
        if ($this->has_parking)     $facilities[] = 'Parking';
        if ($this->has_pool)        $facilities[] = 'Swimming Pool';
        if ($this->has_gym)         $facilities[] = 'Gym';
        if ($this->has_laundry)     $facilities[] = 'Laundry';
        return $facilities;
    }
}
