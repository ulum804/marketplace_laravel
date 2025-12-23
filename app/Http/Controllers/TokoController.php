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
        $produk = ProdukModel::all();
        return view('admin.admin', compact('toko','vouchers','produk'));
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
        // VALIDASI
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'alamat'   => 'required|string|max:255',
            'produk'   => 'required|string',
            'catatan'  => 'nullable|string',
            'voucher'  => 'nullable|string|max:191',
            'total'    => 'required|numeric|min:0',
        ]);

        $total = (int) $validated['total'];
        $voucherCode = strtoupper($validated['voucher'] ?? null);

        // CEK VOUCHER (jika ada)
        if ($voucherCode) {
            $voucher = VoucherModel::where('code', $voucherCode)->first();

            if (!$voucher) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode voucher tidak valid'
                ], 400);
            }

            if ($voucher->type === 'fixed') {
                $total -= $voucher->value;
            } elseif ($voucher->type === 'percent') {
                $total -= ($voucher->value / 100) * $total;
            }

            $total = max(0, $total);
        }

        // SIMPAN PESANAN
        TokoModel::create([
            'nama'           => $validated['nama'],
            'alamat'         => $validated['alamat'],
            'produk'         => $validated['produk'],
            'catatan'        => $validated['catatan'] ?? null,
            'total'          => $validated['total'],
            'original_total' => $validated['total'], // sementara sama
            'voucher_code'   => $validated['voucher'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil disimpan'
        ]);
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
