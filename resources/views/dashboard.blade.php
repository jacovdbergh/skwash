<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                Upcoming matches
            </div>
        </div>

        <div class="mt-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                Tournament 1 ranking
            </div>
        </div>
    </div>
</x-app-layout>
