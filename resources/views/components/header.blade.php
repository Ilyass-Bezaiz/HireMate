<header class="bg-white sticky top-0 z-[9999] w-full">
        <nav class="border-gray-200 px-4 lg:px-6 py-5  container mx-auto">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-3xl">
                <a href="/" class="flex items-center">
                    <span class="site-logo self-center text-green-400 text-2xl font-semibold whitespace-nowrap">{{ config('app.name') }}</span>
                </a>
                

                    @if (Route::has('login'))
                        <div class="flex items-center lg:order-2 gap-x-4">
                            @auth
                                <a href="{{ url('/home') }}" class="text-gray-800 p-2 px-4 hover:bg-gray-200 hover:text-black duration-200 rounded-full">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-800 p-2 px-4 hover:bg-gray-200 hover:text-black duration-200 rounded-full">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-green-400 py-2 px-4  border border-green-400 hover:bg-green-400 hover:text-white duration-200 rounded-full">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
            </div> 
        </nav>
</header>