@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="max-w-3xl mx-auto px-5 sm:px-8 py-14">
    <header class="mb-10 text-center">
        <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-2">FAQ</p>
        <h1 class="font-display italic text-4xl sm:text-5xl text-plum leading-tight">
            Pertanyaan yang Sering Ditanyakan
        </h1>
    </header>

    @php
        $faqs = [
            [
                'q' => 'Bagaimana cara memesan buket custom?',
                'a' => 'Buka halaman "Choose Your Moment", pilih jenis bunga beserta jumlah tangkainya, tentukan warna kertas pembungkus, tulis kartu ucapan, lalu klik "Simpan & Buat Pesanan".',
            ],
            [
                'q' => 'Apakah harga dihitung otomatis?',
                'a' => 'Ya. Total harga muncul secara real-time di ringkasan pesanan sebelah kanan setiap kali kamu menambah bunga atau mengganti pembungkus.',
            ],
            [
                'q' => 'Berapa lama proses pesanan diproses?',
                'a' => 'Setelah pesanan dibuat, status awalnya "pending". Admin akan memproses dan memperbarui status pesanan secara berkala.',
            ],
            [
                'q' => 'Apakah saya bisa mengubah pesanan setelah disubmit?',
                'a' => 'Untuk saat ini perubahan pesanan yang sudah disubmit perlu dikoordinasikan langsung dengan admin.',
            ],
        ];
    @endphp

    <div class="space-y-4">
        @foreach ($faqs as $faq)
            <div class="bg-white/70 rounded-2xl border border-blush-light p-5">
                <p class="font-medium text-plum mb-1">{{ $faq['q'] }}</p>
                <p class="text-sm text-plum/70 leading-relaxed">{{ $faq['a'] }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
