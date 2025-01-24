<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the menu item
            $table->text('description')->nullable(); // Menu item description
            $table->decimal('price', 10, 2); // Price of the menu item
            $table->unsignedBigInteger('category_id'); // Foreign key for Menu Category
            $table->string('image')->nullable(); // Image URL for the menu item
            $table->boolean('is_available')->default(true); // Availability status
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('category_id')->references('id')->on('category_menus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
