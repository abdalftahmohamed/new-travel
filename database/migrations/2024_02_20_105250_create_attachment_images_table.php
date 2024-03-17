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
        Schema::create('attachment_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('attachment_id')->nullable();
            $table->foreign('attachment_id')
                ->references('id')
                ->on('attachments')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachment_images');
    }
};
