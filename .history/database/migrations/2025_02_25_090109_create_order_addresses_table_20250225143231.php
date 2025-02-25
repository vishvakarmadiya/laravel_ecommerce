<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name', 250);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // References users table
            $table->string('email', 250);
            $table->string('mobile', 50);
            $table->text('address');
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('pin_code', 10);
            $table->string('country', 255);
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // References orders table
            $table->timestamp('order_date')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_addresses');
    }
};
