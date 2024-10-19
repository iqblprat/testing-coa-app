<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartOfAccountController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $kategoris = Kategori::where('status', 1)->get();

        $query = ChartOfAccount::with('kategori')->where('status', 1);

        if ($keyword) {
            $query->where('nama', 'like', "%{$keyword}%");
        }

        $coa = $query->paginate(6);

        return view('coa.index', compact('coa', 'kategoris', 'keyword'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('coa.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'kategori_id' => 'required',
        ]);

        $data = $request->all();

        $data['status'] = 1;

        ChartOfAccount::create($data);

        return redirect()->route('chart-of-account.index')->with('success_store', 'Data COA berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $coa = ChartOfAccount::findOrFail($id);

        $kategoris = Kategori::all();

        $selectedKategori = $coa->kategori_id;

        return view('coa.edit', compact('coa', 'kategoris', 'selectedKategori'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'kategori_id' => 'required',
        ]);

        $coa = ChartOfAccount::find($id);
        $coa->update($request->all());

        return redirect()->route('chart-of-account.index')->with('success_update', 'Data COA berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kategori = ChartOfAccount::findOrFail($id);

        $kategori->update([
            'status' => 0,
            'deleted_at' => now()
        ]);

        return redirect()->route('chart-of-account.index')->with('success_destroy', 'Data COA berhasil dihapus.');
    }
}
