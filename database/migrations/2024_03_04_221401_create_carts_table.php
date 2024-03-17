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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity_old')->default(1);
            $table->double('subtotal_old',8,2)->nullable();
            $table->integer('quantity_young')->default(0);
            $table->double('subtotal_child',8,2)->nullable();
            $table->double('total',8,2)->nullable();
            $table->dateTime('date')->nullable();
            $table->double('coupon_amount',8,2)->nullable();
            $table->double('final_subtotal',8,2)->nullable();
            $table->boolean('status')->default(0);
            $table->string('coupon_name')->nullable();
            $table->longText('description')->nullable();
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->bigInteger('trip_id')->unsigned()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
