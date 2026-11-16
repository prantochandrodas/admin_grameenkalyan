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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->text('badge_image')->nullable();
            $table->string('intro_title')->nullable();
            $table->string('intro_sub_title_one')->nullable();
            $table->string('intro_sub_title_two')->nullable();
            $table->text('chairman_thumb_image')->nullable();
            $table->text('chairman_speech')->nullable();
            $table->string('chairman_name')->nullable();
            $table->string('chairman_designation')->nullable();
            $table->text('md_thumb_image')->nullable();
            $table->text('md_speech')->nullable();
            $table->string('md_name')->nullable();
            $table->string('md_designation')->nullable();
            $table->text('annual_report_banner_image')->nullable();
            $table->text('mhi_banner_image')->nullable();
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
        Schema::dropIfExists('homes');
    }
};
