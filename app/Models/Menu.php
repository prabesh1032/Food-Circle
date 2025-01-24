<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Define fillable properties
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'is_available',
    ];

    // Define relationship with MenuCategory
    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'menu_id');
    }
}
