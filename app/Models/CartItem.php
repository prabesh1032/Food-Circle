<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'menu_id', 'quantity'];

    // Relationship with MenuItem (assuming you have a MenuItem model)
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
