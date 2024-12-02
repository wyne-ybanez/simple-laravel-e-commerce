<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-commerce Website') }}</title>

    <!-- Font imports-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-primary overflow-x-hidden">
    @include('layouts.navigation')

    <main class="overflow-x-hidden px-10 lg:px-20 py-20 text-lg">
        <h1 class="mb-10 font-[500] text-[2.5rem] lg:text-[4rem] font-montserrat leading-snug"> Digi.Art - A Digital Art Metal Poster E-Commerce Platform</h1>
        <p>
            A Laravel-powered showcase demonstrating web development skills through a digital art metal poster e-commerce concept. 
            This personal project highlights technical proficiency in building a full-featured web application, focusing on creating a streamlined online platform for digital art poster sales.
        </p>
        <h3 class="font-[500] text-[1.3rem] font-montserrat my-10">Key Highlights:</h3>
        <ul class="list-disc relative left-4">
            <li>Solo Laravel development project</li>
            <li>Digital art metal poster e-commerce simulation</li>
            <li>Technical skill demonstration</li>
        </ul>
    </main>

    <!-- footer -->
    <x-footer>
    </x-footer>

    <!-- Toast -->
    <div x-data="toast" x-show="visible" x-transition x-cloak @notify.window="show($event.detail.message)" class="fixed w-[300px] right-[0.1rem] top-[5.8rem] py-2 px-4 pb-4 bg-emerald-500 text-white">
        <div class="font-semibold" x-text="message"></div>
        <button @click="close" class="absolute flex items-center justify-center right-2 top-2 w-[30px] h-[30px] rounded-full hover:bg-black/10 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <!-- Progress -->
        <div>
            <div class="absolute left-0 bottom-0 right-0 h-[6px] bg-black/10" :style="{'width': `${percent}%`}"></div>
        </div>
    </div>
    <!--/ Toast -->
</body>

</html>