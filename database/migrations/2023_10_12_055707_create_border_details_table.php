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
        Schema::create('border_details', function (Blueprint $table) {
            $table->id();
        
            $table->unsignedBigInteger('border_transaction_id');
            $table->integer('category_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('border_transaction_id')->references('id')->on('border_transactions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('border_details');
    }
};
