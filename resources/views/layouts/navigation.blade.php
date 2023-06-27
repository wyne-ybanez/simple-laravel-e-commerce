<header
    x-data="{
        mobileMenuOpen: false,
        cartItemsCount: {{ \App\Helpers\Cart::getCartItemsCount() }},
    }"
    @cart-change.window="cartItemsCount = $event.detail.count"
    class="flex justify-between border-b border-bg-soft sticky top-0 z-50" :class="productView ? 'bg-black' : 'bg-primary'"
>
    <div>
        <a href="{{ route('home') }}" class="block py-navbar-item pl-5 font-bold font-montserrat text-4xl text-strong"> Digi.Art </a>
    </div>
    <!-- Mobile: Responsive Menu -->
    <div class="block fixed z-10 top-0 bottom-0 height h-full w-[220px] transition-all md:hidden shadow-md border border-bg-soft bg-primary" :class="mobileMenuOpen ? 'left-0' : '-left-[220px]'">
        <ul>
            <li>
                <div>
                    <a href="/" class="block py-navbar-item pl-5 font-bold text-primary font-montserrat text-3xl"> Digi.Art </a>
                </div>
            </li>
            <li>
                <a href="/" class="relative flex items-center justify-between py-3 px-6 transition-colors hover:bg-gray-100">
                    <div class="flex items-center">
                        <div class="link-underline link-underline-black text-stone-600">
                            Home
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('cart.index') }}" class="relative flex items-center justify-between py-3 px-6 transition-colors hover:bg-gray-100">
                    <div class="flex items-center">
                        <div class="link-underline link-underline-black text-stone-600">
                            Basket
                        </div>
                    </div>
                    <!-- Cart Items Counter -->
                    <small
                        x-show="cartItemsCount"
                        x-transition
                        x-text="cartItemsCount"
                        x-cloak
                        class="py-[2px] px-[8px] rounded-full bg-stone-700 text-white">
                    </small>
                    <!--/ Cart Items Counter -->
                </a>
            </li>
            @if (!Auth::guest())
            <li x-data="{open: false}" class="relative">
                <a @click="open = !open" class="cursor-pointer flex justify-between items-center py-3 px-6 hover:text-primary text-stone-600">
                    <div class="flex items-center">
                        <div class="link-underline link-underline-black">
                            My Account
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 mt-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
                <ul x-show="open" x-transition class="z-10 right-0 py-2 text-stone-600">
                    <li>
                        <a href="{{ route('profile') }}" class="flex px-10 py-4 hover:bg-gray-100">
                            My Profile
                        </a>
                    </li>
                    <li class="hover:bg-gray-100">
                        <a href="/" class="flex items-center px-10 py-4">
                            My Orders
                        </a>
                    </li>
                    <li class="hover:bg-gray-100">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="flex items-center px-10 py-4 hover:bg-gray-100" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
            @else
            <li>
                <a href="{{ route('login') }}" class="flex items-center py-3 px-6 transition-colors hover:bg-gray-100">
                    <div class="flex items-center">
                        <div class="link-underline link-underline-black text-stone-600">
                            Login
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="flex items-center py-3 px-6 transition-colors hover:bg-gray-100">
                    <div class="link-underline link-underline-black text-stone-600">
                        Register
                    </div>
                </a>
            </li>
            @endif
        </ul>
    </div>
    <!-- Desktop: Responsive Menu -->
    <nav class="hidden md:block text-primary text-lg">
        <ul class="grid grid-flow-col items-center">
            <li class="mt-5">
                <a href="{{ route('home') }}" class="relative inline-flex items-center py-navbar-item px-navbar-item hover:text-primary">
                    <div class="link-underline link-underline-strong">
                        All Works
                    </div>
                </a>
            </li>
            <li class="mt-5">
                <a href="{{ route('monsters') }}" class="relative inline-flex items-center py-navbar-item px-navbar-item hover:text-primary">
                    <div class="link-underline link-underline-strong">
                        Monsters
                    </div>
                </a>
            </li>
            <li class="mt-5">
                <a href="{{ route('landscapes') }}" class="relative inline-flex items-center py-navbar-item px-navbar-item hover:text-primary">
                    <div class="link-underline link-underline-strong">
                        Landscapes
                    </div>
                </a>
            </li>
            <li class="mt-5">
                <a href="{{ route('heroes') }}" class="relative inline-flex items-center py-navbar-item px-navbar-item hover:text-primary">
                    <div class="link-underline link-underline-strong">
                        Heroes
                    </div>
                </a>
            </li>
            <li class="mt-5">
                <a href="{{ route('anti_heroes') }}" class="relative inline-flex items-center py-navbar-item px-navbar-item hover:text-primary">
                    <div class="link-underline link-underline-strong">
                        Anti-Heroes
                    </div>
                </a>
            </li>
            <li class="mx-1">
                <div class="text-5xl font-bold relative inline-flex items-center mb-2 px-navbar-item">
                    .
                </div>
            </li>
            <li>
                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center py-navbar-item px-navbar-item hover:text-primary">
                    <div class="link-underline link-underline-strong">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Basket
                    </div>
                    <!-- Cart Items Counter -->
                    <small 
                        x-show="cartItemsCount" 
                        x-transition 
                        x-cloak 
                        x-text="cartItemsCount" 
                        class="absolute z-[100] top-4 right-4 py-0 px-[8px] rounded-full w-[1.7rem] text-center text-white bg-stone-700"
                    >
                    </small>
                    <!-- End Cart Items Counter -->
                </a>
            </li>
            @if (!Auth::guest())
            <li x-data="{open: false}" class="relative">
                <a @click="open = !open" class="cursor-pointer flex items-center py-navbar-item px-navbar-item pr-5 hover:text-primary">
                    <div class="flex items-center">
                        <div class="link-underline link-underline-strong">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Account
                        </div>
                    </div>
                </a>
                <ul @click.outside="open = false" x-show="open" x-transition x-cloak class="rounded-sm shadow-md absolute z-10 right-0 bg-white py-2 w-48">
                    <li>
                        <a href="{{ route('profile') }}" class="flex w-full px-5 py-2 hover:bg-gray-100">
                            My Profile
                        </a>
                    </li>
                    <li>
                        <a href="/src/orders.html" class="flex px-5 py-2 hover:bg-gray-100">
                            My Orders
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="/" class="flex px-5 py-2 hover:bg-gray-100" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
            @else
            <li>
                <a href="{{ route('login') }}" class="flex items-center py-navbar-item px-navbar-item hover:text-primary">
                    <div class="link-underline link-underline-strong">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="flex items-center py-navbar-item px-navbar-item transition-colors">
                    <div class="link-underline link-underline-strong">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Register
                    </div>
                </a>
            </li>
            @endif
        </ul>
    </nav>
    <button @click="mobileMenuOpen=!mobileMenuOpen" class="p-4 block md:hidden text-strong">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</header>