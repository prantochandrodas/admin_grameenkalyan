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
        Schema::create('package_details', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id');
            $table->integer('test_id');
            $table->decimal('rate', 20, 2)->default(0);
            $table->tinyInteger('discount_type')->default(1)->comment('1=flat,2=percentage');
            $table->decimal('discount_percent', 20, 2)->default(0);
            $table->decimal('discount', 20, 2)->default(0);
            $table->decimal('net_price', 20, 2)->default(0);
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
        Schema::dropIfExists('package_details');
    }
};
