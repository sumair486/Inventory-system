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
        Schema::create('border_transactions', function (Blueprint $table) {
            $table->id();
          
            $table->integer('border_warehouse_id');
            $table->date('date');
            $table->string('invoice_no');
            $table->string('image');


          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('border_transactions');
    }
};
