<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wrapper;
use Illuminate\Http\Request;

class WrapperController extends Controller
{
    public function index()
    {
        $wrappers = Wrapper::orderBy('wrapper_color')->paginate(10);

        return view('admin.wrappers.index', compact('wrappers'));
    }

    public function create()
    {
        return view('admin.wrappers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'wrapper_color' => ['required', 'string', 'max:255'],
            'price'         => ['required', 'numeric', 'min:0'],
        ]);

        Wrapper::create($validated);

        return redirect()->route('admin.wrappers.index')->with('success', 'Wrapper baru berhasil ditambahkan.');
    }

    public function edit(Wrapper $wrapper)
    {
        return view('admin.wrappers.edit', compact('wrapper'));
    }

    public function update(Request $request, Wrapper $wrapper)
    {
        $validated = $request->validate([
            'wrapper_color' => ['required', 'string', 'max:255'],
            'price'         => ['required', 'numeric', 'min:0'],
        ]);

        $wrapper->update($validated);

        return redirect()->route('admin.wrappers.index')->with('success', 'Data wrapper berhasil diperbarui.');
    }

    public function destroy(Wrapper $wrapper)
    {
        if ($wrapper->orders()->exists()) {
            return redirect()->route('admin.wrappers.index')
                ->with('error', 'Wrapper ini tidak bisa dihapus karena sudah dipakai di pesanan.');
        }

        $wrapper->delete();

        return redirect()->route('admin.wrappers.index')->with('success', 'Wrapper berhasil dihapus.');
    }
}