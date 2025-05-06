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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->references('id')->on('children');
            $table->foreignId('session_id')->references('id')->on('sessions');
            $table->enum('status',['present','absent','late','permission'])->nullable();
            $table->foreignId('year_id')->references('id')->on('years');
            $table->boolean('is_active')->default(true);
            $table->text('reason')->nullable();
            $table->string('class'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
