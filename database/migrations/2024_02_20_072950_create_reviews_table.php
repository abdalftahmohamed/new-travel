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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->integer('stars_numbers')->nullable();
            $table->longText('description')->nullable();
            $table->string('image_path')->nullable();

            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('blog_id')->unsigned()->nullable();
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('trip_id')->unsigned()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('offer_id')->unsigned()->nullable();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
