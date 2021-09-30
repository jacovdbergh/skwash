<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-cyan-900">
                Tournaments
            </h2>
            <div>
                <x-button href="{{ route('tournaments.create') }}" icon="heroicon-s-plus-circle">Create tournament</x-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12 space-y-4">
        @foreach ($tournaments as $tournament)
        <a class="block p-4 overflow-hidden bg-white shadow-sm sm:rounded-lg" href="{{ route('tournaments.show', $tournament) }}">
            <div class="flex justify-between text-cyan-900">
                <span>{{ $tournament->name }}</span>
                <span>&rarr;</span>
            </div>
        </a>
        @endforeach
    </div>
</div>
