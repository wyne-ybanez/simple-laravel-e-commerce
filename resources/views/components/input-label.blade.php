@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-black font-monsterrat dark:text-black']) }}>
    {{ $value ?? $slot }}
</label>