<?php

namespace App\Http\Livewire\Tournaments;

use App\Models\Tournament;
use Livewire\Component;

class Show extends Component
{
    public Tournament $tournament;

    protected $listeners = ['matchUpdated'];

    public function render()
    {
        return view('livewire.tournaments.show')->layout('layouts.app');
    }

    public function matchUpdated()
    {
        $this->tournament->refresh();
    }
}
