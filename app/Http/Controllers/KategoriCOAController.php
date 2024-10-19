<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriCOAController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $query = Kategori::where('status', 1);

        if ($keyword) {
            $query->where('nama', 'like', "%{$keyword}%");
        }

        $kategori = $query->paginate(10);

        return view('kategori.index', compact('kategori', 'keyword'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $data = $request->all();

        $data['status'] = 1;

        Kategori::create($data);

        return redirect()->route('kategori-coa.index')->with('success_store', 'Data Kategori berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->nama = $request->nama;
        $kategori->save();

        return redirect()->route('kategori-coa.index')->with('success_update', 'Data Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'status' => 0,
            'deleted_at' => now()
        ]);

        return redirect()->route('kategori-coa.index')->with('success_destroy', 'Data Kategori berhasil dihapus.');
    }

}
