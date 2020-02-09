<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStakeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stake_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('stake_amount');
            $table->decimal('win_amount');
            $table->integer('number_of_players');
            $table->string('description');
            $table->string('uid');

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
        Schema::dropIfExists('stake_types');
    }
}
