<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwitchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('box_id')->index();
            $table->string('code')->index();
            $table->integer('port')->default(0);
            $table->tinyInteger('status')->default(1)->index()
                ->comment('[1 = active, 0 = inactive]');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('switches');
    }
}
