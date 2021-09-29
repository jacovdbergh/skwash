<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function player1Games()
    {
        return $this->hasMany(Game::class, 'player_1_id', 'id');
    }

    public function player2Games()
    {
        return $this->hasMany(Game::class, 'player_2_id', 'id');
    }

    public function player1GamesPlayed()
    {
        return $this->player1Games()->whereNotNull('player_1_score');
    }

    public function player2GamesPlayed()
    {
        return $this->player2Games()->whereNotNull('player_1_score');
    }

    public function player1GamesWon()
    {
        return $this->player1GamesPlayed()->whereColumn('player_1_score', '>', 'player_2_score');
    }

    public function player2GamesWon()
    {
        return $this->player2GamesPlayed()->whereColumn('player_2_score', '>', 'player_1_score');
    }

    public function pointDiff()
    {
        $this->loadMissing('player1Games', 'player2Games');

        return $this->player1Games->sum('player_1_score') - $this->player1Games->sum('player_2_score')
            + $this->player2Games->sum('player_2_score') - $this->player2Games->sum('player_1_score');
    }
}
