<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    // Order model
    protected $fillable = ['name','phone','menu_id', 'price', 'quantity', 'user_id', 'status', 'address', 'payment_method'];

    /**
     * Relationships
     */

    // Each order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each order is linked to a specific menu item
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
