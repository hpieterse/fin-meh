



<button type="button" class="md:hidden">
    <span>MENU</span>
</button>

<nav class="flex-1 flex flex-row items-center gap-x-8
    @guest justify-end @endguest
    ">
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
</nav>

@auth
    <p>{{ Auth::user()->name }}</p>
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@endauth