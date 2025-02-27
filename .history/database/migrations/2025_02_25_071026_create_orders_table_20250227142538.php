<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();  // Auto-incrementing primary key
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->decimal('sub_total', 10, 2);
                $table->decimal('shipping_charge', 10, 2);
                $table->string('payment_method')->nullable();
                $table->decimal('total', 10, 2);
                $table->tinyInteger('status')->default(1); // 1 = Placed, 2 = Processing, etc.
                $table->timestamps();
            });
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
