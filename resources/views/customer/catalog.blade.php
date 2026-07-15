@extends('layouts.app')

@section('title', 'Katalog Bunga')

@section('content')
<div class="max-w-7xl mx-auto px-5 sm:px-8 py-12">

    <header class="mb-10 text-center">
        <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-2">Katalog</p>
        <h1 class="font-display italic text-4xl sm:text-5xl text-plum leading-tight">
            Semua bunga yang tersedia
        </h1>
        <p class="mt-3 text-sm sm:text-base text-plum/70 max-w-xl mx-auto">
            Lihat semua jenis bunga yang bisa kamu pakai untuk merangkai buket. Sudah siap merangkai?
            <a href="{{ route('planner') }}" class="text-blush-dark font-medium hover:underline">Mulai di Planner &rarr;</a>
        </p>
    </header>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
        @forelse ($flowers as $flower)
            <div class="bg-white/70 rounded-3xl p-4 border border-blush-light shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="aspect-square w-full rounded-2xl overflow-hidden bg-lavender-light mb-3">
                    <img
                        src="{{ $flower->display_image }}"
                        alt="{{ $flower->flower_name }}"
                        class="w-full h-full object-cover"
                        loading="lazy"
                    >
                </div>
                <h3 class="font-medium text-sm text-plum truncate">{{ $flower->flower_name }}</h3>
                <p class="text-xs text-plum/60">Rp {{ number_format($flower->price_per_stem, 0, ',', '.') }} / tangkai</p>
            </div>
        @empty
            <p class="col-span-full text-center text-sm text-plum/50 italic py-10">
                Belum ada data bunga di master data.
            </p>
        @endforelse
    </div>
</div>
@endsection
