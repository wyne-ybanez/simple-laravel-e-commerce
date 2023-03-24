<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-strong dark:bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-200 uppercase tracking-widest hover:bg-stone-700 dark:hover:bg-stone-600 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-0 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
