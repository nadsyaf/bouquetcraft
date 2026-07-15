@extends('admin.layout')

@section('admin-content')
<h1 class="font-display italic text-2xl text-plum mb-6">Kelola Pesanan</h1>

<div class="space-y-4">
    @forelse ($orders as $order)
        <div class="bg-white/70 border border-blush-light rounded-2xl p-5">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                <div>
                    <p class="font-display italic text-lg text-plum">Pesanan #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-xs text-plum/60">
                        {{ $order->user?->name ?? 'Tamu (belum login)' }} &middot; {{ $order->created_at->format('d M Y, H:i') }}
                    </p>
                </div>
                <span class="text-sm font-medium text-blush-dark">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>

            <ul class="text-sm text-plum/70 mb-4 list-disc list-inside">
                @foreach ($order->orderDetails as $detail)
                    <li>{{ $detail->flower->flower_name ?? 'Bunga dihapus' }} &times; {{ $detail->quantity }}</li>
                @endforeach
                <li>Wrapper: {{ $order->wrapper->wrapper_color ?? '-' }}</li>
            </ul>

            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex items-center gap-3">
                @csrf
                @method('PATCH')
                <select name="status" class="rounded-lg border border-blush-light px-3 py-2 text-sm bg-cream/60">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Diproses</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="px-4 py-2 rounded-full bg-blush-dark text-white text-xs uppercase tracking-wide hover:bg-plum transition-colors">
                    Update Status
                </button>
            </form>
        </div>
    @empty
        <p class="text-center text-plum/50 py-10">Belum ada pesanan masuk.</p>
    @endforelse
</div>

<div class="mt-6">{{ $orders->links() }}</div>
@endsection