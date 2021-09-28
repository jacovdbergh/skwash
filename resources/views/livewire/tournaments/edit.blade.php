<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-900 leading-tight">
            Create tournament
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="max-w-xs">
                    <x-label for="tournament.name" value="Tournament name" />
                    <x-input id="tournament.name" class="block mt-1 w-full" type="text" wire:model.defer="tournament.name" name="tournament.name" required autofocus />
                    @error('tournament.name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                @if (! $tournament->exists)
                    <div class="mt-8 max-w-xs">
                        <x-label for="players" value="Players" />
                        @forelse ($players as $i => $player)
                            <div class="flex items-center">
                                <x-input id="players.{{ $i }}" type="text" name="players.{{ $i }}" class="block mt-1 flex-1 mr-2" wire:model.defer="players.{{ $i }}" required />
                                <x-heroicon-s-minus-circle class="w-4 h-4 text-red-400 cursor-pointer flex-shrink-0" wire:click="removePlayer({{ $i }})"/>
                            </div>
                            @error('players.'.$i)
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        @empty
                            <p class="italic text-sm mt-1">No players added yet</p>
                        @endforelse
                        @error('players')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <x-button class="mt-4" level="2" wire:click="addPlayer">Add a player</x-button>
                    </div>
                @endif
                <div class="flex max-w-xs mt-8">
                    <x-button wire:click="save">Create tournament</x-button>
                </div>
            </div>
        </div>
    </div>
</div>
