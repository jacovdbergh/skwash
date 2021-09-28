<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-900 leading-tight">
            {{ $tournament->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 ">
                @foreach ($tournament->games->groupBy('round') as $round)
                <div class="mt-4">
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
        <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                Show matches
            </div>
        </div>
    </div>
</div>
