@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-3xl mx-auto w-full px-5 sm:px-8 py-12">
    <h1 class="font-display italic text-3xl text-plum mb-8 text-center">Pesanan Saya</h1>

    <div class="space-y-4">
        @forelse ($orders as $order)
            <div class="bg-white/70 border border-blush-light rounded-2xl p-5">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                    <p class="font-display italic text-lg text-plum">Pesanan #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                    <span class="text-xs px-3 py-1 rounded-full
                        @class([
                            'bg-sage/20 text-sage-dark' => $order->status === 'completed',
                            'bg-lavender-light text-plum' => $order->status === 'processing',
                            'bg-blush-light text-plum' => $order->status === 'pending',
                        ])">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <ul class="text-sm text-plum/70 mb-3 list-disc list-inside">
                    @foreach ($order->orderDetails as $detail)
                        <li>{{ $detail->flower->flower_name ?? 'Bunga dihapus' }} &times; {{ $detail->quantity }}</li>
                    @endforeach
                    <li>Wrapper: {{ $order->wrapper->wrapper_color ?? '-' }}</li>
                </ul>

                <p class="text-sm text-plum/60">
                    Total: <span class="font-medium text-blush-dark">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    &middot; {{ $order->created_at->format('d M Y, H:i') }}
                </p>
            </div>
        @empty
            <p class="text-center text-plum/50 py-10">Kamu belum pernah membuat pesanan.</p>
        @endforelse
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
</div>
@endsection