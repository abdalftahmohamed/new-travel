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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('trip_date')->nullable();
            $table->double('old_price',8,2)->nullable();
            $table->double('young_price',8,2)->nullable();
            $table->text('name')->nullable();
            $table->string('old_new_price')->nullable();
            $table->string('saving')->nullable();
            $table->string('image_path')->nullable();
            $table->longText('trip_description')->nullable();
            $table->boolean('status')->default(true);
//            $table->string('cus_rating')->nullable();
            $table->longText('address')->nullable();
            $table->longText('location')->nullable();
            $table->enum('type',['Top Destinations','Best Trips','Best Offers','Popular Experiences'])->default('Popular Experiences');

            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
