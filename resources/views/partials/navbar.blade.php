<nav class="bg-white/80 backdrop-blur border-b border-blush-light sticky top-0 z-50 px-5 sm:px-8 py-4 flex items-center justify-between shadow-sm">
 
    <a href="{{ route('home') }}" class="flex items-center gap-2 transition hover:opacity-80">
        <div class="w-9 h-9 flex items-center justify-center shrink-0">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="w-8 h-8 text-blush-dark">
                <path d="M12 2C12 2 15 5 15 8C15 11 12 12 12 12C12 12 9 11 9 8C9 5 12 2 12 2Z"></path>
                <path d="M12 12C12 12 15 12 17 14C19 16 19 19 17 21C15 23 12 22 12 22C12 22 9 23 7 21C5 19 5 16 7 14C9 12 12 12 12 12Z"></path>
                <path d="M12 2C12 2 9 5 8 7C7 9 7 12 9 12M12 2C12 2 15 5 16 7C17 9 17 12 15 12"></path>
            </svg>
        </div>
        <span class="font-display italic text-xl sm:text-2xl font-medium text-plum tracking-wide">BouquetCraft</span>
    </a>
 
    <div class="hidden md:flex items-center gap-6 text-sm text-plum">
        @php
            $navLinks = [
                'catalog'  => ['label' => 'Catalog',           'route' => 'catalog'],
                'planner'  => ['label' => 'Choose Your Moment','route' => 'planner'],
                'bouquets' => ['label' => 'Bouquets',           'route' => 'bouquets'],
                'faq'      => ['label' => 'FAQ',                'route' => 'faq'],
                'about'    => ['label' => 'About Us',           'route' => 'about'],
            ];
        @endphp
 
        @foreach ($navLinks as $key => $link)
            @php $isActive = request()->routeIs($link['route']); @endphp
            <a href="{{ route($link['route']) }}" class="tracking-wide transition hover:text-blush-dark {{ $isActive ? 'text-blush-dark font-medium' : '' }}">{{ $link['label'] }}</a>
        @endforeach
 
        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.flowers.index') }}" class="tracking-wide transition hover:text-blush-dark {{ request()->routeIs('admin.*') ? 'text-blush-dark font-medium' : '' }}">Admin Panel</a>
            @else
                <a href="{{ route('my-orders') }}" class="tracking-wide transition hover:text-blush-dark {{ request()->routeIs('my-orders') ? 'text-blush-dark font-medium' : '' }}">Pesanan Saya</a>
            @endif
        @endauth
    </div>
 
    <div class="flex items-center gap-3">
        @guest
            <a href="{{ route('login') }}" class="hidden sm:inline-block text-xs font-medium tracking-wide uppercase text-plum hover:text-blush-dark transition-colors">Masuk</a>
            <a href="{{ route('register') }}" class="hidden sm:inline-block text-xs font-medium tracking-wide uppercase px-4 py-2 rounded-full border border-blush-dark text-blush-dark hover:bg-blush-dark hover:text-white transition-colors">Daftar</a>
        @else
            <span class="hidden sm:inline-block text-xs text-plum/60">Hai, {{ Str::before(auth()->user()->name, ' ') }}</span>
            <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                @csrf
                <button type="submit" class="text-xs font-medium tracking-wide uppercase px-4 py-2 rounded-full border border-blush-dark text-blush-dark hover:bg-blush-dark hover:text-white transition-colors">Logout</button>
            </form>
        @endguest
 
        <a href="{{ route('planner') }}" class="hidden sm:inline-block text-xs font-medium tracking-wide uppercase px-4 py-2 rounded-full bg-blush-dark text-white hover:bg-plum transition-colors">Mulai Rangkai</a>
    </div>
</nav>
 
<div class="md:hidden flex items-center justify-center gap-4 flex-wrap text-xs text-plum bg-blush-light/40 py-2 px-4">
    @foreach ($navLinks as $key => $link)
        <a href="{{ route($link['route']) }}" class="hover:text-blush-dark {{ request()->routeIs($link['route']) ? 'text-blush-dark font-medium' : '' }}">{{ $link['label'] }}</a>
    @endforeach
 
    @auth
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.flowers.index') }}" class="hover:text-blush-dark">Admin</a>
        @else
            <a href="{{ route('my-orders') }}" class="hover:text-blush-dark">Pesanan Saya</a>
        @endif
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="hover:text-blush-dark">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="hover:text-blush-dark">Masuk</a>
        <a href="{{ route('register') }}" class="hover:text-blush-dark">Daftar</a>
    @endauth
</div>
