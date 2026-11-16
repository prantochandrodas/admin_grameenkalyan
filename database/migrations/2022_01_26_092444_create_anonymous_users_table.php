<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnonymousUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anonymous_users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable();
            $table->string('email',50)->nullable();
            $table->text('profile_image')->nullable();
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
        Schema::dropIfExists('anonymous_users');
    }
}
