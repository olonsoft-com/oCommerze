<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('province')->nullable();
            $table->string('zip_code')->default('1111');
            $table->string('country')->default('Bangladesh');
            $table->string('phone')->nullable()->index();
            $table->string('mobile')->nullable()->index();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('gender')->default('male')->index();
            $table->string('dobDay')->default('01');
            $table->string('dobMonth')->default('January');
            $table->string('dobYear')->default(2000);
            $table->tinyInteger('status')->default(0)->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
