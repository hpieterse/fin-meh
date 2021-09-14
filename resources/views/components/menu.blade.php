<nav class="bg-white shadow-sm px-2">
    <div class="flex flex-row container mx-auto">
        <div class="flex flex-1 justify-center md:justify-end flex-col md:flex-row" x-data="{ open: false }">
            <div class="flex justify-between md:justify-center">
                {{ $brand }}
                <button type="button" class="md:hidden h-14" @click="open = !open">
                    <x-icon-bars-light class="h-7 text-primary" />
                </button>
            </div>
            <div x-bind:class="open ? 'flex' : 'hidden md:flex'" 
                class="flex-1 flex-col md:flex-row md:items-center gap-x-8
                    @guest justify-end 
                    @else justify-center
                    @endguest">
                @auth
                    {{ $slot }}
                @endauth

                @guest
                    @if (Route::has('login'))
                        <x-menu-item :route-name="'login'">
                            {{ __('Login') }}
                        </x-menu-item>
                    @endif

                    @if (Route::has('register'))
                        <x-menu-item :route-name="'register'">
                            {{ __('Register') }}
                        </x-menu-item>
                    @endif
                @endguest
            </div>
            @auth
            
            <div x-bind:class="open ? 'flex' : 'hidden md:flex'">
                <x-drop-down>
                    <x-slot name="title">
                        <span class="h-14 flex items-center" >{{ Auth::user()->name }}</span>
                    </x-slot>

                    <x-drop-down-item>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </x-drop-down-item>
                </x-drop-down>        
            <div>
            @endauth
        </div>
    </div>
</nav>
