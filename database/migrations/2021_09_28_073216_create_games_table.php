<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('round');
            $table->foreignId('tournament_id')->constrained();
            $table->foreignId('player_1_id')->constrained('players');
            $table->foreignId('player_2_id')->constrained('players');
            $table->integer('player_1_score')->nullable();
            $table->integer('player_2_score')->nullable();
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
        Schema::dropIfExists('matches');
    }
}
