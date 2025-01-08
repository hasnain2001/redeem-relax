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
        Schema::create('delete_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
           $table->string('store_name');
            $table->unsignedBigInteger('deleted_by'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delete_stores');
    }
};