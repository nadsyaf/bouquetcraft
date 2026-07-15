@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="max-w-3xl mx-auto px-5 sm:px-8 py-14 text-center">
    <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-2">Tentang Kami</p>
    <h1 class="font-display italic text-4xl sm:text-5xl text-plum leading-tight mb-6">
        Cerita di balik BouquetCraft
    </h1>

    <p class="text-plum/70 leading-relaxed mb-4">
        BouquetCraft lahir dari ide sederhana: setiap orang punya cara sendiri untuk mengungkapkan perasaan,
        dan buket bunga seharusnya bisa dirangkai sesuai cerita itu — bukan sekadar pilihan yang sudah jadi.
    </p>
    <p class="text-plum/70 leading-relaxed mb-4">
        Lewat Custom Bouquet Planner, kamu bebas memilih jenis bunga, jumlah tangkai, warna kertas pembungkus,
        sampai menuliskan kartu ucapan sendiri — dan langsung tahu berapa total harganya sebelum memesan.
    </p>

    <div class="mt-10 rounded-3xl overflow-hidden border border-blush-light shadow-sm">
        <img
            src="https://images.unsplash.com/photo-1487070183336-b863922373d4?q=80&w=900&auto=format&fit=crop"
            alt="Proses merangkai buket"
            class="w-full h-48 sm:h-64 object-cover"
        >
    </div>

    <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
        @php
            $features = [
                ['title' => 'Fresh Flowers', 'desc' => 'Bunga segar dipilih langsung sebelum dirangkai.'],
                ['title' => 'Fully Custom', 'desc' => 'Kamu yang menentukan kombinasi bunga dan pembungkusnya.'],
                ['title' => 'Personal Touch', 'desc' => 'Kartu ucapan personal untuk tiap penerima.'],
            ];
        @endphp

        @foreach ($features as $feature)
            <div class="bg-white/70 rounded-2xl p-5 border border-blush-light">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="w-6 h-6 text-blush-dark mb-2">
                    <path d="M12 2C12 2 15 5 15 8C15 11 12 12 12 12C12 12 9 11 9 8C9 5 12 2 12 2Z"></path>
                    <path d="M12 12C12 12 15 12 17 14C19 16 19 19 17 21C15 23 12 22 12 22C12 22 9 23 7 21C5 19 5 16 7 14C9 12 12 12 12 12Z"></path>
                </svg>
                <p class="font-display text-lg text-plum mb-1">{{ $feature['title'] }}</p>
                <p class="text-sm text-plum/60">{{ $feature['desc'] }}</p>
            </div>
        @endforeach
    </div>

    <a href="{{ route('planner') }}" class="inline-block mt-10 px-6 py-3 rounded-full bg-sage hover:bg-sage-dark text-white text-sm font-medium transition-colors">
        Mulai Rangkai Buketmu
    </a>
</div>
@endsection
