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
        Schema::create('website_banners', function (Blueprint $table) {
            $table->id();
            $table->string('about_banner')->nullable();
            $table->string('about_title')->nullable();
            $table->string('about_subtitle')->nullable();

            $table->string('healthcare_banner')->nullable();
            $table->string('healthcare_title')->nullable();
            $table->string('healthcare_subtitle')->nullable();

            $table->string('corporate_banner')->nullable();
            $table->string('corporate_title')->nullable();
            $table->string('corporate_subtitle')->nullable();

            $table->string('health_force_banner')->nullable();
            $table->string('health_force_title')->nullable();
            $table->string('health_force_subtitle')->nullable();

            $table->string('join_us_banner')->nullable();
            $table->string('join_us_title')->nullable();
            $table->string('join_us_subtitle')->nullable();

            $table->string('stories_banner')->nullable();
            $table->string('stories_title')->nullable();
            $table->string('stories_subtitle')->nullable();
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
        Schema::dropIfExists('website_banners');
    }
};
