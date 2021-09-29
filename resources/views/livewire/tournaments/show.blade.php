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
                                        <th
                                            scope="col"
                                            class="hidden px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase sm:block"
                                        >
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tournament->players()->withCount('player1GamesPlayed', 'player2GamesPlayed', 'player1GamesWon', 'player2GamesWon')
                                        ->get()->sortBy([
                                            fn($a, $b) => $b->player1_games_won_count + $b->player2_games_won_count <=> $a->player1_games_won_count + $a->player2_games_won_count,
                                            fn($a, $b) => $b->player1_games_played_count + $b->player2_games_played_count <=> $a->player1_games_played_count + $a->player2_games_played_count,
                                            fn($a, $b) => $b->pointDiff() <=> $a->pointDiff(),
                                        ]) as $player)
                                        <tr>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                {{ $player->name }}
                                            </td>
                                            <td class="w-16 px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $player->player1_games_played_count + $player->player2_games_played_count }}
                                            </td>
                                            <td class="w-16 px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $player->player1_games_won_count + $player->player2_games_won_count }}
                                            </td>
                                            <td class="w-16 px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ ($player->player1_games_played_count + $player->player2_games_played_count)
                                                 - ($player->player1_games_won_count + $player->player2_games_won_count) }}
                                            </td>
                                            <td class="w-16 px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $player->pointDiff() }}
                                            </td>
                                            <td
                                                class="hidden px-6 py-4 text-sm text-gray-500 sm:block whitespace-nowrap">
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
            <div class="p-6 space-y-6">
                @foreach ($tournament->games()->with('player1', 'player2')->get()->groupBy('round') as $round)
                    <div class="">
                        <span class="font-bold">Round {{ $loop->iteration }}</span>
                        @foreach ($round as $game)
                            <div class="mt-2">
                                {{ $game->player1->name }}
                                <span class="text-sm text-cyan-800">vs</span>
                                {{ $game->player2->name }}
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
