<footer class="mx-auto text-soft text-xl py-8 font-montserrat w-11/12 md:w-[94vw] mt-40 border-t-2 border-bg-strong">
    <h1 class="text-center text-black md:text-9xl sm:text-8xl text-7xl mt-20 font-extrabold">
        <a href="{{ route('home') }}" class="">
            {{ getenv('APP_NAME') }}
        </a>
    </h1>
    <div class="container text-black mx-auto justify-items-center grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_1')) }}" class="text-2xl hover:text-stone-600 font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_1') }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_4')) }}" class="text-2xl hover:text-stone-600 font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_4') }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_3')) }}" class="text-2xl hover:text-stone-600 font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_3') }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_2')) }}" class="text-2xl hover:text-stone-600 font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_2') }}
            </a>
        </div>
    </div>
    <div class="mt-10 pt-8 text-xl flex text-black items-end">
        <div>
            All rights reserved &copy; {{ date('Y') }} <span class="font-semibold px-2">{{ getenv('APP_NAME') }}</span>
            <br>
            This site was created by
            <span class="link-underline link-underline-black">
                <a href="https://wyne-ybanez-portfolio.vercel.app/" target="_blank">Wyne Ybanez</a>
            </span>
        </div>
        <div class="ml-auto align-center">
            <a class="mr-10 link-underline link-underline-black" href="#">Terms of Use</a>
            <a class="link-underline link-underline-black" href="#">Privacy Policy</a>
        </div>
    </div>
</footer>