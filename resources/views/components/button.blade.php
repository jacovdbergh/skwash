@props([
    'level' => 1,
    'icon' => null,
    'type' => 'button',
    'href' => null,
    'disabled' => false,
    'class' => '',
])

@if ($href)
    <a href="{{ $href }}"
@else
    <button type="{{ $type }}"
@endif

@if ($disabled) disabled @endif

@class([
    $class . ' relative inline-flex items-center justify-center px-4 py-2 disabled:opacity-50 disabled:cursor-not-allowed',

    'text-white border border-transparent rounded-md shadow-sm bg-cyan-700 focus:ring-2 focus:ring-offset-2 focus:ring-cyan-400' => $level == 1,
    'hover:bg-cyan-600' => $level == 1 and ! $disabled,

    'text-white border border-transparent rounded-md shadow-sm bg-gradient-to-br from-gray-800 via-gray-800 to-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700' => $level == 2,
    'hover:from-gray-700 hover:via-gray-700 hover:to-gray-900' => $level == 2 and ! $disabled,

    'text-gray-800 border border-gray-200 rounded-md bg-gradient-to-br from-gray-100 via-gray-100 to-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700' => $level == 3,
    'hover:from-gray-200 hover:via-gray-200 hover:to-gray-300' => $level == 3 and ! $disabled,
])

{{ $attributes->except('class') }}

>

@if ($icon)
    <x-dynamic-component :component="$icon" class="h-4 w-4 -ml-1 mr-1.5" />
@endif
    <span>{{ $slot }}</span>

@if ($href)
    </a>
@else
    </button>
@endif

