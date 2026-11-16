<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name',191)->nullable();
            $table->integer('division_id');
            $table->integer('district_id')->nullable();
            $table->integer('upazilla_id')->nullable();
            $table->text('banner_image')->nullable();
            $table->string('contact_info',191)->nullable();
            $table->string('address',191)->nullable();
            $table->boolean('is_active')->default(TRUE);
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
        Schema::dropIfExists('health_centers');
    }
}
