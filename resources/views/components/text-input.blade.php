@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'dark:bg-gray-900 dark:text-gray-300 focus:border-stone-700 dark:focus:border-stone-700 rounded-sm shadow-sm']) !!}>
