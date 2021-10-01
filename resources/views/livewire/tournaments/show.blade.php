<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-cyan-900">
            {{ $tournament->name }}
        </h2>
    </x-slot>

    <div class="py-10 space-y-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                        >
                                            Player
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                        >
                                            P
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                        >
                                            W
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                        >
                                            L
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                        >
                                            PD
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tournament->players()->withCount('player1MatchesPlayed', 'player2MatchesPlayed', 'player1MatchesWon', 'player2MatchesWon')->get()->sortBy([fn($a, $b) => $b->player1_matches_won_count + $b->player2_matches_won_count <=> $a->player1_matches_won_count + $a->player2_matches_won_count, fn($a, $b) => $b->player1_matches_played_count + $b->player2_matches_played_count <=> $a->player1_matches_played_count + $a->player2_matches_played_count, fn($a, $b) => $b->pointDiff() <=> $a->pointDiff()])
    as $player)
                                        <tr>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                {{ $player->name }}
                                            </td>
                                            <td class="w-16 px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $player->player1_matches_played_count + $player->player2_matches_played_count }}
                                            </td>
                                            <td class="w-16 px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $player->player1_matches_won_count + $player->player2_matches_won_count }}
                                            </td>
                                            <td class="w-16 px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $player->player1_matches_played_count + $player->player2_matches_played_count - ($player->player1_matches_won_count + $player->player2_matches_won_count) }}
                                            </td>
                                            <td class="w-16 px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $player->pointDiff() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="flex flex-col p-6 space-y-4">
                @foreach ($tournament->matches()->with('games', 'player1', 'player2')->get()->groupBy('round')
    as $round)
                    <div class="w-full">
                        <div class="w-full font-bold border-b border-gray-300">Round {{ $loop->iteration }}</div>
                        @foreach ($round as $match)
                            <div
                                @class([
                                    'flex items-center w-full mt-4',
                                    'cursor-pointer' => auth()->check(),
                                ])
                                @auth
                                    wire:click="$emit('openModal', 'tournaments.enter-match-scores', {{ json_encode([$match->id]) }})"
                                @endauth
                            >
                                <div class="flex flex-col items-center justify-center flex-1">
                                    {{ $match->player1->name }}
                                    <span
                                        class="block text-cyan-700">{{ $match->games->isNotEmpty() ? $match->games->filter(fn($game) => $game->player_1_score > $game->player_2_score)->count() : '-' }}</span>
                                </div>
                                <div class="text-sm text-cyan-800">vs</div>
                                <div class="flex flex-col items-center justify-center flex-1">
                                    {{ $match->player2->name }}
                                    <span
                                        class="block text-cyan-700">{{ $match->games->isNotEmpty() ? $match->games->filter(fn($game) => $game->player_2_score > $game->player_1_score)->count() : '-' }}</span>
                                </div>
                                @auth
                                    <div>
                                        &rarr;
                                    </div>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
