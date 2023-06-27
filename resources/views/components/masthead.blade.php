<div class="border border-r-0 border-bg-soft bg-primary text-soft text-xl mt-5 py-32 font-montserrat w-full">
    <h1 class="text-center md:text-9xl sm:text-5xl text-5xl font-extrabold">
        <a href="{{ route('home') }}" class="text-soft hover:text-strong">
            Digi.Art
        </a>
    </h1>
    <div class="container mx-auto justify-items-center grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="mb-4 mt-20">
            <a href="{{ route('monsters') }}" class="text-2xl hover:text-strong font-bold font-montserrat mt-20 mb-2">
                Monsters
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route('landscapes') }}" class="text-2xl hover:text-strong font-bold font-montserrat mt-20 mb-2">
                Landscapes
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route('heroes') }}" class="text-2xl hover:text-strong font-bold font-montserrat mt-20 mb-2">
                Heroes
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route('anti_heroes') }}" class="text-2xl hover:text-strong font-bold font-montserrat mt-20 mb-2">
                Anti-Heroes
            </a>
        </div>
    </div>
</div>