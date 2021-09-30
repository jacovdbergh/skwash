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

    public function player1Matches()
    {
        return $this->hasMany(SquashMatch::class, 'player_1_id', 'id');
    }

    public function player2Matches()
    {
        return $this->hasMany(SquashMatch::class, 'player_2_id', 'id');
    }

    public function player1MatchesPlayed()
    {
        return $this->player1Matches()->whereNotNull('winning_player');
    }

    public function player2MatchesPlayed()
    {
        return $this->player2Matches()->whereNotNull('winning_player');
    }

    public function player1MatchesWon()
    {
        return $this->player1MatchesPlayed()->where('winning_player', 1);
    }

    public function player2MatchesWon()
    {
        return $this->player2MatchesPlayed()->where('winning_player', 2);
    }

    public function pointDiff()
    {
        $this->loadMissing('player1MatchesPlayed', 'player2MatchesPlayed');

        return $this->player1MatchesPlayed->sum('player_1_pd') + $this->player2MatchesPlayed->sum('player_2_pd');
    }
}
