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
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->text('address');
            $table->string('cell_1')->nullable()->index();
            $table->string('cell_2')->nullable()->index();
            $table->string('username')->unique();
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
