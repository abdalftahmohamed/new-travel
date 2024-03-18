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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->longText('coupon_name');
            $table->boolean('status')->default(true);
            $table->double('coupon_amount',8,2)->default(0);
            $table->dateTime('coupon_start')->default(now());
            $table->dateTime('coupon_end')->nullable();
            $table->bigInteger('trip_id')->unsigned()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
