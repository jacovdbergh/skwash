<div class="overflow-hidden rounded-md">
    <div class="px-4 py-5 bg-white border-b border-gray-200 sm:px-6">
        <div class="flex flex-wrap items-center justify-between -mt-2 -ml-4 sm:flex-nowrap">
            <div class="mt-2 ml-4">
                <h2 class="text-xl font-semibold leading-tight text-cyan-900">
                    Enter scores
                    </h3>
            </div>
            <div class="flex items-baseline justify-end flex-shrink-0 mt-2 ml-4 space-x-2">
                <button
                    id="cancelButton"
                    type="button"
                    wire:click="$emit('closeModal')"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-transparent border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                >
                    Cancel
                </button>
                <x-button
                    id="saveButton"
                    wire:click="save"
                    type="submit"
                    level="1"
                >
                    Save
                </x-button>
            </div>
        </div>
    </div>
    <div class="p-6 space-y-4">
        <div class="flex w-full">
            <span class="w-32"></span>
            <span class="flex-1 text-center text-gray-900">{{ $match->player1->name }}</span>
            <span class="flex-1 text-center text-gray-900">{{ $match->player2->name }}</span>
        </div>
        @foreach ($games as $gameNumber => $game)
            <div class="flex items-center w-full">
                <span class="w-32 text-center text-gray-600">Game {{ $loop->iteration }}</span>
                <div class="flex-1 text-center">
                    <select
                        @if ($loop->iteration == 3 and $wonInTwo) disabled @endif
                        id="game-{{ $gameNumber }}-player-1-score"
                        rows=4
                        wire:model="games.{{ $gameNumber }}.player_1_score"
                        name="game-{{ $gameNumber }}-player-1-score"
                        class="border-gray-300 rounded-md shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                    >
                        @foreach (range(0, 20) as $i)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 text-center">
                    <select
                        @if ($loop->iteration == 3 and $wonInTwo) disabled @endif
                        id="game-{{ $gameNumber }}-player-2-score"
                        rows=4
                        wire:model="games.{{ $gameNumber }}.player_2_score"
                        name="game-{{ $gameNumber }}-player-2-score"
                        class="border-gray-300 rounded-md shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                    >
                        @foreach (range(0, 20) as $i)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
        @error('scores')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
