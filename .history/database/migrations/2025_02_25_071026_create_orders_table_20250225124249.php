<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->decimal('sub_total', 10, 2); // Subtotal amount
            $table->decimal('shipping_charge', 10, 2); // Shipping cost
            $table->string('payment_method'); // Payment type (e.g., COD, Card, PayPal)
            $table->decimal('total', 10, 2); // Total amount
            $table->tinyInteger('status')->default(1)->comment('1 = Placed, 2 = Processing, 3 = Shipped, 4 = Delivered, 5 = Cancelled');
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
