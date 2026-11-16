<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('homepage_thumb_image')->nullable();
            $table->text('servicepage_thumb_image')->nullable();
            $table->string('sub_title_one')->nullable();
            $table->string('sub_title_two')->nullable();
            $table->text('short_description')->nullable();
            $table->text('service_detail_banner_image')->nullable();
            $table->string('service_detail_slogan')->nullable();
            $table->text('long_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
