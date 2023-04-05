<footer class="bg-strong text-soft text-xl py-8 font-montserrat">
    <h1 class="text-center text-soft md:text-9xl sm:text-8xl text-7xl mt-20 font-extrabold">
        <a href="{{ route('home') }}" class="">
            Digi.Art
        </a>
    </h1>
    <div class="container mx-auto justify-items-center grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="mb-4 mt-20">
            <a href="{{ route('monsters') }}" class="text-2xl text-soft hover:text-white font-bold font-montserrat mt-20 mb-2">
                Monsters
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route('landscapes') }}" class="text-2xl text-soft hover:text-white font-bold font-montserrat mt-20 mb-2">
                Landscapes
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route('heroes') }}" class="text-2xl text-soft hover:text-white font-bold font-montserrat mt-20 mb-2">
                Heroes
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route('anti_heroes') }}" class="text-2xl text-soft hover:text-white font-bold font-montserrat mt-20 mb-2">
                Anti-Heroes
            </a>
        </div>
    </div>
    <div class="mt-10 pt-8 px-20 text-xl text-soft flex">
        <p>
            &copy; 2023 <span class="font-semibold px-2">Digi.Art</span>
            All rights reserved
        </p>
        <div class="ml-auto">
            <a class="mr-10 hover:text-white" href="#">Terms of Use</a>
            <a class="hover:text-white" href="#">Privacy Policy</a>
        </div>
    </div>
</footer>