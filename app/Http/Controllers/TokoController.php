<?php

namespace App\Http\Controllers;

use App\Models\TokoModel;
use App\Models\ProdukModel;
use App\Models\VoucherModel;
use Illuminate\Http\Request;
use Exception;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toko = TokoModel::all();
        // print_r($toko);
        if (request()->ajax()) {
            return response()->json($toko);
        }
        $vouchers = VoucherModel::orderBy('created_at', 'desc')->get();
        return view('admin.admin', compact('toko','vouchers'));
        // $buku = Buku::all();
        // print_r($buku);
        // return view('buku.index', compact('buku'))
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'produk' => 'required|string|max:255',
            'catatan' => 'nullable|string|max:255',
            'total' => 'required|numeric|min:0',
        ]);

            TokoModel::create($validated);
            return response()->json(['success' => true]);


        // try {
        //     TokoModel::create($validatedData);
        //     return response()->json(['success' => true, 'message' => 'Pesanan berhasil disimpan.']);
        // } catch (Exception $e) {
        //     return response()->json(['success' => false, 'message' => 'Gagal menyimpan pesanan: ' . $e->getMessage()], 500);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $toko = TokoModel::findOrFail($id);
        $toko->delete();

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil dihapus.']);
    }
}
