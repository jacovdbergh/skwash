@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-orange-800']) }}>
    {{ $value ?? $slot }}
</label>
