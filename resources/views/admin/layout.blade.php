@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto w-full px-5 sm:px-8 py-10">

    @if (session('success'))
        <div class="mb-6 rounded-xl bg-sage/15 border border-sage/40 text-plum text-sm px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 rounded-xl bg-blush-light/60 border border-blush-dark/40 text-plum text-sm px-4 py-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-8">
        <aside class="md:w-52 shrink-0">
            <p class="font-display italic text-xl text-plum mb-4">Admin Panel</p>
            <nav class="flex md:flex-col gap-2 text-sm flex-wrap">
                <a href="{{ route('admin.flowers.index') }}"
                   class="px-4 py-2 rounded-full md:rounded-lg transition {{ request()->routeIs('admin.flowers.*') ? 'bg-blush-dark text-white' : 'bg-white/70 text-plum hover:bg-blush-light' }}">
                    Kelola Bunga
                </a>
                <a href="{{ route('admin.wrappers.index') }}"
                   class="px-4 py-2 rounded-full md:rounded-lg transition {{ request()->routeIs('admin.wrappers.*') ? 'bg-blush-dark text-white' : 'bg-white/70 text-plum hover:bg-blush-light' }}">
                    Kelola Wrapper
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="px-4 py-2 rounded-full md:rounded-lg transition {{ request()->routeIs('admin.orders.*') ? 'bg-blush-dark text-white' : 'bg-white/70 text-plum hover:bg-blush-light' }}">
                    Kelola Pesanan
                </a>
            </nav>
        </aside>

        <div class="flex-1 min-w-0">
            @yield('admin-content')
        </div>
    </div>
</div>
@endsection