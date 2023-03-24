<button {{ $attributes->merge(['type' => 'submit', 'class' => 'group relative w-full flex justify-center py-2 px-4 border border-transparent text-base font-medium rounded-sm text-white bg-strong hover:bg-gray-900 hover:text-white transition duration-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500']) }}>
    {{ $slot }}
</button>