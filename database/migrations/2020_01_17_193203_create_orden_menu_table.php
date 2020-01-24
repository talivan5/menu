<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('num_orden');
            $table->string('nombre_submenu');

            $table->foreign('id')
            ->references('menu_id')
            ->on('menu')
            ->onDelete('cascade');
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
        Schema::dropIfExists('orden_menu');
    }
}
