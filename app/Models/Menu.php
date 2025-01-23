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
        'menu_category_id',
        'image',
        'is_available',
    ];

    // Define relationship with MenuCategory
    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }
}
