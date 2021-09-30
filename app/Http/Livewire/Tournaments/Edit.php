<?php

namespace App\Http\Livewire\Tournaments;

use App\Models\Game;
use App\Models\Player;
use App\Models\SquashMatch;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use PhpParser\Node\Expr\Match_;

class Edit extends Component
{
    public ?Tournament $tournament = null;
    public array $players = [];

    protected array $rules = [
        'tournament.name' => ['required'],
        'players' => ['array', 'min:2'],
        'players.*' => ['required'],
    ];

    protected array $messages = [
        'players.min' => 'You need at least 2 players',
        'players.*.required' => 'Enter a name for this player',
    ];

    public function mount()
    {
        if (! isset($this->tournament)) {
            $this->tournament = new Tournament();
        }
    }

    public function addPlayer()
    {
        $this->players[] = '';
    }

    public function removePlayer(int $id)
    {
        unset($this->players[$id]);
    }

    public function save()
    {
        $this->validate();

        $this->tournament->save();

        $this->tournament->players()->saveMany(
            collect($this->players)->map(fn ($player) => new Player(['name' => $player]))
        );

        $this->createRoundRobinGames();

        $this->redirect(route('tournaments.show', $this->tournament));
        $this->skipRender();
    }

    public function render()
    {
        return view('livewire.tournaments.edit')->layout('layouts.app');
    }

    public function createRoundRobinGames()
    {
        /** @var Collection<Player> */
        $players = $this->tournament->players;

        if ($players->count() % 2) {
            $players->push(null);
        }

        $playerCount = $players->count();
        $rounds = $playerCount - 1;
        $half = $playerCount / 2;

        $playersTwoAndOn = $players->slice(1);

        for ($round = 1; $round <= $rounds; $round++) {
            $newPlayers = collect([$players->first()])->concat($playersTwoAndOn);

            $firstHalf = $newPlayers->slice(0, $half);
            $secondHalf = $newPlayers->slice($half, $playerCount)->reverse()->values();

            for ($i = 0; $i < $firstHalf->count(); $i++) {
                if ($firstHalf[$i] and $secondHalf[$i]) {
                    SquashMatch::create([
                        'tournament_id' => $this->tournament->id,
                        'round' => $round,
                        'player_1_id' => $firstHalf[$i]->id,
                        'player_2_id' => $secondHalf[$i]->id,
                    ]);
                }
            }

            // rotate the players
            $playersTwoAndOn->push($playersTwoAndOn->shift());
        }
    }
}
