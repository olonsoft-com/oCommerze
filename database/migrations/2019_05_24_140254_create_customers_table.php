<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mikrotik_id')->nullable();
            $table->macAddress('remote_mac')->nullable();
            $table->ipAddress('remote_ip')->nullable();
            $table->integer('user_id')->index();
            $table->integer('zone_id')->default(1)->index();
            $table->integer('area_id')->default(2)->index();
            $table->integer('package_id')->default(1)->index();
            $table->string('name');
            $table->string('username')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->text('address')->nullable();
            $table->string('cell_1')->nullable()->index();
            $table->string('cell_2')->nullable()->index();
            $table->string('type')->index();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('customers');
    }
}
