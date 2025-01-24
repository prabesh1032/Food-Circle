<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to the user placing the order
            $table->foreignId('menu_id')->constrained()->onDelete('cascade'); // Reference to the menu item
            $table->decimal('price', 10, 2); // Price of the menu item
            $table->integer('quantity'); // Quantity of the item ordered
            $table->string('status')->default('pending'); // Status of the order (e.g., "pending", "completed", etc.)
            $table->string('payment_method'); // Payment method (e.g., "cash", "card")
            $table->string('name'); // Name of the customer
            $table->string('phone'); // Customer's phone number
            $table->text('address'); // Delivery address
            $table->timestamps(); // Created at & Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
