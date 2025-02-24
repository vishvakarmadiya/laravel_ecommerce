<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id');  // Foreign key to users table
            $table->unsignedBigInteger('product_id');  // Foreign key to products table
            $table->integer('quantity');  // Quantity of the product in the cart
            $table->decimal('price', 10, 2);  // Price of the product at the time of adding to the cart
            $table->enum('status', ['active', 'inactive', 'purchased'])->default('active');  // Default status
            $table->timestamps();  // Created at and updated at columns

            // Adding foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
