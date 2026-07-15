<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlowerController extends Controller
{
    public function index()
    {
        $flowers = Flower::orderBy('flower_name')->paginate(10);

        return view('admin.flowers.index', compact('flowers'));
    }

    public function create()
    {
        return view('admin.flowers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'flower_name'    => ['required', 'string', 'max:255'],
            'price_per_stem' => ['required', 'numeric', 'min:0'],
            'image'          => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = '/storage/' . $request->file('image')->store('flowers', 'public');
        }

        Flower::create($validated);

        return redirect()->route('admin.flowers.index')->with('success', 'Bunga baru berhasil ditambahkan.');
    }

    public function edit(Flower $flower)
    {
        return view('admin.flowers.edit', compact('flower'));
    }

    public function update(Request $request, Flower $flower)
    {
        $validated = $request->validate([
            'flower_name'    => ['required', 'string', 'max:255'],
            'price_per_stem' => ['required', 'numeric', 'min:0'],
            'image'          => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($flower->image && str_starts_with($flower->image, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $flower->image));
            }

            $validated['image'] = '/storage/' . $request->file('image')->store('flowers', 'public');
        }

        $flower->update($validated);

        return redirect()->route('admin.flowers.index')->with('success', 'Data bunga berhasil diperbarui.');
    }

    public function destroy(Flower $flower)
    {
        if ($flower->orderDetails()->exists()) {
            return redirect()->route('admin.flowers.index')
                ->with('error', 'Bunga ini tidak bisa dihapus karena sudah pernah dipesan.');
        }

        if ($flower->image && str_starts_with($flower->image, '/storage/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $flower->image));
        }

        $flower->delete();

        return redirect()->route('admin.flowers.index')->with('success', 'Bunga berhasil dihapus.');
    }
}