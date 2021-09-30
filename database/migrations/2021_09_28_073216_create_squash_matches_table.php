<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSquashMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('squash_matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('round');
            $table->foreignId('tournament_id')->constrained();
            $table->foreignId('player_1_id')->constrained('players');
            $table->foreignId('player_2_id')->constrained('players');
            $table->tinyInteger('winning_player')->nullable();
            $table->integer('player_1_pd')->nullable();
            $table->integer('player_2_pd')->nullable();
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
        Schema::dropIfExists('squash_matches');
    }
}
