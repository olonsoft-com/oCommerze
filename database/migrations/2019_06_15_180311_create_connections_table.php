<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mikrotik_id')->index();
            $table->integer('user_id')->index();
            $table->integer('zone_id')->index();
            $table->integer('area_id')->index();
            $table->integer('package_id')->index();
            $table->decimal('cable_cost', 8,2)->default(0);
            $table->decimal('installation_fee', 8,2)->default(0);
            $table->string('type')->index()->default('home');
            $table->ipAddress('remote_ip')->nullable();
            $table->macAddress('remote_mac')->nullable();
            $table->tinyInteger('status')->default(0)->index();
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
        Schema::dropIfExists('connections');
    }
}
