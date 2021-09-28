<?php

namespace App\Http\Livewire\Tournaments;

use App\Models\Player;
use App\Models\Tournament;
use Livewire\Component;

class Show extends Component
{
    public Tournament $tournament;

    public function render()
    {
        return view('livewire.tournaments.show')->layout('layouts.app');
    }
}
