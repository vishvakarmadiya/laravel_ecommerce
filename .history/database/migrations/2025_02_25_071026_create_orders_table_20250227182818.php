<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('sub_total', 10, 2);
            $table->decimal('shipping_charge', 10, 2)->default(50);
            $table->decimal('total', 10, 2);
            $table->string('payment_method');
            $table->string('status')->default('pending');
            $table->string('razorpay_order_id')->nullable();
            $table->timestamps();
        
            // Foreign key with cascade delete
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // If user is deleted, their orders are also deleted
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
