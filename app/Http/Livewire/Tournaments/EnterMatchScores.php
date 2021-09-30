<?php

namespace App\Http\Livewire\Tournaments;

use App\Models\Game;
use App\Models\SquashMatch;
use Illuminate\Support\Collection;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EnterMatchScores extends ModalComponent
{
    public SquashMatch $match;
    public Collection $games;
    public int $winner = 0;
    public bool $wonInTwo = false;

    public function mount(SquashMatch $match)
    {
        $this->match = $match->load('games');

        $this->games = collect([]);
        foreach (range(0, 2) as $i) {
            $this->games->push([
                'player_1_score' => (string) ($this->match->games?->get($i)?->player_1_score ?? 0),
                'player_2_score' => (string) ($this->match->games?->get($i)?->player_2_score ?? 0),
            ]);
        }
    }

    public function updatedGames()
    {
        if ($this->games[0]['player_1_score'] > 10 and $this->games[0]['player_1_score'] > $this->games[0]['player_2_score']
        and $this->games[1]['player_1_score'] > 10 and $this->games[1]['player_1_score'] > $this->games[1]['player_2_score']) {
            $this->wonInTwo = true;
            $this->games[2] = [
                'player_1_score' => (string) 0,
                'player_2_score' => (string) 0,
            ];
        } elseif ($this->games[0]['player_2_score'] > 10 and $this->games[0]['player_1_score'] < $this->games[0]['player_2_score']
        and $this->games[1]['player_2_score'] > 10 and $this->games[1]['player_1_score'] < $this->games[1]['player_2_score']) {
            $this->wonInTwo = true;
            $this->games[2] = [
                'player_1_score' => (string) 0,
                'player_2_score' => (string) 0,
            ];
        } else {
            $this->wonInTwo = false;
        }
    }

    public function validateScores()
    {
        foreach ($this->games as $i => $game) {
            if (!$this->wonInTwo or $i < 2) {
                $i++;
                if ($game['player_1_score'] < 11 and $game['player_2_score'] < 11) {
                    $this->addError('scores', "One player must score at least 11 points in game {$i}.");

                    return false;
                }

                if ($game['player_1_score'] >= 10 and $game['player_2_score'] >= 10
                and abs($game['player_1_score'] - $game['player_2_score']) != 2) {
                    $this->addError('scores', "Margin must be two if scores are both above 10 in game {$i}.");

                    return false;
                }
            }
        }

        return true;
    }

    public function determineWinner()
    {
        if ($this->games[0]['player_1_score'] > $this->games[0]['player_2_score'] and
        ($this->games[1]['player_1_score'] > $this->games[1]['player_2_score'] or $this->games[2]['player_1_score'] > $this->games[2]['player_2_score'])) {
            $this->winner = 1;
        } else {
            $this->winner = 2;
        }
    }

    public function save()
    {
        if (! $this->validateScores()) {
            return;
        }

        $this->determineWinner();

        $pointsDiff = 0;
        foreach ($this->games as $gameNumber => $game) {
            if (!$this->wonInTwo or $gameNumber < 2) {
                Game::updateOrCreate([
                    'game' => $gameNumber + 1,
                    'squash_match_id' => $this->match->id,
                ], [
                    'player_1_score' => $game['player_1_score'],
                    'player_2_score' => $game['player_2_score'],
                ]);

                $pointsDiff += $game['player_1_score'] - $game['player_2_score'];
            }
        }

        $this->match->update([
            'player_1_pd' => $pointsDiff,
            'player_2_pd' => - $pointsDiff,
            'winning_player' => $this->winner,
        ]);

        $this->closeModalWithEvents([
            Show::getName() => 'matchUpdated',
        ]);
    }

    public function render()
    {
        return view('livewire.tournaments.enter-match-scores');
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }
}
