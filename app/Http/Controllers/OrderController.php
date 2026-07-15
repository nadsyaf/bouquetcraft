<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Wrapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Simpan pesanan baru (dari form Custom Bouquet Planner) ke database.
     */
    public function store(Request $request)
    {
        // 1. Decode payload order_details (dikirim sebagai JSON string dari Alpine.js)
        $orderDetails = json_decode($request->input('order_details', '[]'), true) ?? [];

        // 2. Validasi input
        $validator = Validator::make(
            array_merge($request->all(), ['order_details' => $orderDetails]),
            [
                'wrapper_id'                => ['required', 'integer', 'exists:wrappers,id'],
                'greeting_card_text'        => ['nullable', 'string', 'max:500'],
                'total_price'               => ['required', 'numeric', 'min:0'],
                'order_details'             => ['required', 'array', 'min:1'],
                'order_details.*.flower_id' => ['required', 'integer', 'exists:flowers,id'],
                'order_details.*.quantity'  => ['required', 'integer', 'min:1'],
            ],
            [
                'wrapper_id.required'    => 'Pilih dulu warna kertas pembungkusnya ya.',
                'order_details.required' => 'Pilih minimal satu bunga sebelum membuat pesanan.',
                'order_details.min'      => 'Pilih minimal satu bunga sebelum membuat pesanan.',
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        // 3. Hitung ulang total harga di server (jangan percaya total dari client mentah-mentah),
        //    supaya harga tidak bisa dimanipulasi lewat DevTools/Postman.
        $wrapper = Wrapper::findOrFail($validated['wrapper_id']);

        $flowerIds = collect($validated['order_details'])->pluck('flower_id')->unique();
        $flowers   = Flower::whereIn('id', $flowerIds)->get()->keyBy('id');

        $recalculatedTotal = (float) $wrapper->price;

        foreach ($validated['order_details'] as $detail) {
            $flower = $flowers->get($detail['flower_id']);

            if (! $flower) {
                return redirect()
                    ->back()
                    ->withErrors(['order_details' => 'Salah satu bunga yang dipilih tidak ditemukan.'])
                    ->withInput();
            }

            $recalculatedTotal += (float) $flower->price_per_stem * (int) $detail['quantity'];
        }

        // 4. Simpan Order + OrderDetail dalam satu transaksi database,
        //    supaya kalau ada error di tengah jalan, tidak ada data setengah jadi.
        try {
            $order = DB::transaction(function () use ($validated, $recalculatedTotal) {
                $order = Order::create([
                    'user_id'            => Auth::id(), // null jika belum login (fitur login belum dibangun)
                    'wrapper_id'         => $validated['wrapper_id'],
                    'greeting_card_text' => $validated['greeting_card_text'] ?? null,
                    'total_price'        => $recalculatedTotal,
                    'status'             => 'pending',
                ]);

                foreach ($validated['order_details'] as $detail) {
                    OrderDetail::create([
                        'order_id'  => $order->id,
                        'flower_id' => $detail['flower_id'],
                        'quantity'  => $detail['quantity'],
                    ]);
                }

                return $order;
            });
        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->back()
                ->withErrors(['general' => 'Terjadi kesalahan saat menyimpan pesanan. Silakan coba lagi.'])
                ->withInput();
        }

        return redirect()
            ->route('planner')
            ->with('order_success', [
                'order_id'     => $order->id,
                'total_price'  => $order->total_price,
                'item_count'   => count($validated['order_details']),
            ]);
    }
}