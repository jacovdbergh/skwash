<?php

namespace App\Http\Livewire\Tournaments;

use App\Models\Tournament;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $tournaments = Tournament::all();

        return view('livewire.tournaments.index', compact('tournaments'))->layout('layouts.app', ['header' => 'Tournaments']);
    }
}
