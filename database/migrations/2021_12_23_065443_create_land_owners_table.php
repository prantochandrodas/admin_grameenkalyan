<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('land_owners', function (Blueprint $table) {
        //     $table->id();
        //     $table->string("name_of_landowner",40)->nullable();
        //     $table->string("contact_person",40)->nullable();
        //     $table->string("user_email",40)->nullable();
        //     $table->string("mobile_number",40)->nullable();
        //     $table->text("address",100)->nullable();
        //     $table->text("land_address")->nullable();
        //     $table->string("area_of_plot",100)->nullable();
        //     $table->string("plot_dimension_in_front",100)->nullable();
        //     $table->string("plot_dimension_in_depth",100)->nullable();
        //     $table->string("width_of_road",100)->nullable();
        //     $table->string("special_feature",100)->nullable();
        //     $table->string("type_of_use",100)->nullable();
        //     $table->text("any_special_requirement")->nullable();
        //     $table->text("remarks")->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('land_owners');
    }
}
