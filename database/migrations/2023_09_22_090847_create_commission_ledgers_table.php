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
        Schema::create('commission_ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('commission_agent_id');
            $table->integer('delivered_quantity');
            // $table->integer('remaining_quantity');
            $table->date('transection_date');
            $table->integer('balance');
            $table->string('product_id');
            $table->string('category_id');
            $table->string('border_id');

            // $table->string('warehouse_id');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_ledgers');
    }
};
