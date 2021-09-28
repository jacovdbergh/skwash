<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-cyan-900 leading-tight">
                Tournaments
            </h2>
            <div>
                <x-button href="{{ route('tournaments.create') }}" icon="heroicon-s-plus-circle">Create tournament</x-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                Show active tournaments, with upcoming matches?
            </div>
        </div>
    </div>
</div>
