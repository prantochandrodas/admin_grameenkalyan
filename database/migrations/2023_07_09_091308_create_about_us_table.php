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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('banner_image')->nullable();
            $table->string('mission')->nullable();
            $table->string('vision')->nullable();
            $table->text('company_intro_title')->nullable();
            $table->text('company_intro_description')->nullable();
            $table->text('inception_banner_image')->nullable();
            $table->string('inception_title')->nullable();
            $table->text('inception_details')->nullable();
            $table->text('presence_title')->nullable();
            $table->text('presence_sub_title')->nullable();
            $table->text('presence_banner_image')->nullable();
            $table->text('presence_details')->nullable();
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
        Schema::dropIfExists('about_us');
    }
};
