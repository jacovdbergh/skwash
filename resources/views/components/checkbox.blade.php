@props(['name', 'label'])

<label for="{{ $name }}" class="inline-flex items-center">
    <input id="{{ $name }}" type="checkbox" {{ $attributes->merge(['class' => 'rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50']) }} name="{{ $name }}">
    <span class="ml-2 text-sm text-gray-600">{{ $label }}</span>
</label>