<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\ChartOfAccount;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $charts = ChartOfAccount::all();

        $query = Transaksi::where('status', 1);

        if ($keyword) {
            $query->where('deskripsi', 'like', "%{$keyword}%");
        }

        $transaksis = $query->paginate(10);

        return view('transaksi.index', compact('transaksis', 'keyword', 'charts'));
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'coa_id' => 'required|exists:tb_chart_of_account,id',
            'deskripsi' => 'required|string|max:255',
            'debit' => 'nullable|numeric',
            'credit' => 'nullable|numeric',
        ]);

        // Pastikan user sedang login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melakukan transaksi.');
        }

        // Mengambil data input dan menambahkan user_id dari session
        $data = $request->except('_token');  // Mengambil data kecuali _token
        $data['status'] = 1;
        $data['user_id'] = Auth::id();

        // Buat transaksi baru
        Transaksi::create($data);

        // Redirect setelah transaksi berhasil
        return redirect()->route('transaksi.index')
                        ->with('success_store', 'Data Transaksi berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'coa_id' => 'required|exists:tb_chart_of_account,id',
            'deskripsi' => 'required|string|max:255',
            'debit' => 'nullable|numeric',
            'credit' => 'nullable|numeric',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')
                        ->with('success_update', 'Data Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => 0,
            'deleted_at' => now()
        ]);

        return redirect()->route('transaksi.index')
                        ->with('success_destroy', 'Data Transaksi berhasil dihapus.');
    }
}
