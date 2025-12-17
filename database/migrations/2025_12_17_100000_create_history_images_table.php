<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('history_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('about_page_id'); // relasi ke about_pages (history section)
            $table->string('image_path');
            $table->timestamps();

            $table->foreign('about_page_id')->references('id')->on('about_pages')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_images');
    }
};
