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
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('year_id')->references('id')->on('years');
            $table->string('reg_no');
            $table->date('date_order');
            $table->float('total',15,2);
            $table->enum('status',['draft','confirmed','payment_received','cancelled']);
            $table->text('payment_image')->nullable();
            $table->foreignId('discount_id')->nullable()->constrained();
            $table->boolean('use_disc');
            $table->float('discount_amount',15,2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
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
