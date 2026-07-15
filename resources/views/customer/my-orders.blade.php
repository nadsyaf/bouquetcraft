@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Pesanan Saya</h2>
        <p class="text-sm text-gray-500">Pantau status rangkaian buket bunga pesananmu di sini.</p>
    </div>
    
    @if($orders->isEmpty())
        <div class="bg-white border rounded-xl p-8 text-center shadow-sm">
            <p class="text-gray-500">Kamu belum memiliki riwayat pesanan.</p>
        </div>
    @else
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID Pesanan</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Detail Bunga</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $order->id }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($order->orderDetails as $detail)
                                        <li>
                                            <span class="font-medium text-gray-800">{{ $detail->flower->name ?? 'Bunga' }}</span> 
                                            <span class="text-gray-400 text-xs">({{ $detail->qty ?? 1 }}x)</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if(strtolower($order->status ?? 'pending') === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-amber-50 text-amber-800 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-green-50 text-green-800 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Menampilkan navigasi halaman/pagination --}}
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection