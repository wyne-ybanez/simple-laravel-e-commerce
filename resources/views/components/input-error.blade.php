@props(['messages'])

@if ($messages)
<div class="mb-5">
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif