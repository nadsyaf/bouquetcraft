@extends('layouts.app')

@section('title', 'Bouquets')

@section('content')
<div class="max-w-7xl mx-auto px-5 sm:px-8 py-14">
    <header class="mb-10 text-center">
        <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-2">Bouquets</p>
        <h1 class="font-display italic text-4xl sm:text-5xl text-plum leading-tight">
            Inspirasi kombinasi buket
        </h1>
        <p class="mt-3 text-sm sm:text-base text-plum/70 max-w-xl mx-auto">
            Nggak tahu mau mulai dari mana? Coba beberapa kombinasi populer ini di
            <a href="{{ route('planner') }}" class="text-blush-dark font-medium hover:underline">Custom Bouquet Planner</a>.
        </p>
    </header>

    @php
        $inspirations = [
            [
                'title' => 'Romantic Rose',
                'desc' => 'Mawar merah merona berpadu pembungkus putih suci — klasik, tulus, dan memikat hati.',
                'photo' => '/images/romantic-rose.jpg',
            ],
            [
                'title' => 'Soft Pastel',
                'desc' => 'Tulip pink dan baby breath dengan pembungkus soft pink — perpaduan warna pastel yang sempurna dan penuh kelembutan.',
                'photo' => '/images/soft-pastel.jpg',
            ],
            [
                'title' => 'Pure Elegance',
                'desc' => 'Keanggunan bunga lily putih yang bersih, dipadukan dengan sentuhan alam dari pembungkus kraft paper yang rustic dan hangat.',
                'photo' => '/images/pure-elegance.jpg',
            ],
            [
                'title' => 'Garden Fresh',
                'desc' => 'Kombinasi beragam bunga segar dengan pembungkus sage green — sentuhan alam yang cantik, manis, dan tak lekang oleh waktu.',
                'photo' => '/images/garden-fresh.jpg',
            ],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach ($inspirations as $item)
            <a href="{{ route('planner') }}" class="group block bg-white/70 rounded-3xl overflow-hidden border border-blush-light shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="aspect-square overflow-hidden">
                    <img src="{{ $item['photo'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                </div>
                <div class="p-4 text-center">
                    <h3 class="font-display text-lg text-plum mb-1">{{ $item['title'] }}</h3>
                    <p class="text-xs text-plum/60">{{ $item['desc'] }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
