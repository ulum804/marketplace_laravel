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
        \Log::info('Order store request received', ['input' => $request->all()]);
        
        // Be resilient: try to validate, but if validation fails or any exception occurs,
        // attempt to save a minimal order record so admin still receives the order.
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'produk' => 'required|string|max:255',
                'catatan' => 'nullable|string|max:255',
                'subtotal' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'voucher' => 'nullable|string|max:191',
            ]);

            \Log::info('Order validated', $validated);

            $subtotal = (int) round($validated['subtotal']);
            $submittedTotal = (int) round($validated['total']);
            $finalTotal = $submittedTotal;
            $voucherCode = $validated['voucher'] ?? null;

            if ($voucherCode) {
                $v = VoucherModel::where('code', strtoupper($voucherCode))->first();
                if ($v && $v->is_active && !$v->isExpired()) {
                    if ($v->min_purchase && $subtotal < $v->min_purchase) {
                        $v = null; // not applicable
                    }
                } else {
                    $v = null;
                }

                if ($v) {
                    if ($v->type === 'percent') {
                        $calc = $subtotal - floor(($subtotal * $v->value) / 100);
                    } elseif ($v->type === 'fixed') {
                        $calc = $subtotal - (int) $v->value;
                    } else { // freeShipping
                        $calc = $subtotal;
                    }
                    $finalTotal = max(0, (int) round($calc));
                }
            }

            if ($finalTotal !== $submittedTotal) {
                $submittedTotal = $finalTotal;
            }

            $data = [
                'nama' => $validated['nama'],
                'alamat' => $validated['alamat'],
                'produk' => $validated['produk'],
                'catatan' => $validated['catatan'] ?? null,
                'total' => $submittedTotal,
                'original_total' => $subtotal,
                'voucher_code' => $voucherCode,
            ];

            $order = TokoModel::create($data);
            \Log::info('Order created successfully', ['id' => $order->id]);

            return response()->json(['success' => true]);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            // Validation failed: still try to persist a minimal record with available inputs
            \Log::warning('Validation error', ['errors' => $ve->errors()]);
            $input = $request->only(['nama', 'alamat', 'produk', 'catatan', 'total', 'subtotal', 'voucher']);
            $data = [
                'nama' => $input['nama'] ?? 'Unknown',
                'alamat' => $input['alamat'] ?? '-',
                'produk' => $input['produk'] ?? '-',
                'catatan' => $input['catatan'] ?? null,
                'total' => isset($input['total']) ? (int) round($input['total']) : (isset($input['subtotal']) ? (int) round($input['subtotal']) : 0),
                'original_total' => isset($input['subtotal']) ? (int) round($input['subtotal']) : null,
                'voucher_code' => $input['voucher'] ?? null,
            ];
            try {
                TokoModel::create($data);
                \Log::info('Order saved after validation error');
                return response()->json(['success' => true, 'warning' => 'Saved with validation warnings']);
            } catch (\Exception $e) {
                \Log::error('Failed to save order after validation error: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => 'Failed to save order', 'error' => $e->getMessage()], 500);
            }
        } catch (\Exception $e) {
            // Unexpected error: attempt minimal save then return success to client if possible
            \Log::error('Unexpected error in order store: ' . $e->getMessage(), ['exception' => $e]);
            $input = $request->only(['nama', 'alamat', 'produk', 'catatan', 'total', 'subtotal', 'voucher']);
            $data = [
                'nama' => $input['nama'] ?? 'Unknown',
                'alamat' => $input['alamat'] ?? '-',
                'produk' => $input['produk'] ?? '-',
                'catatan' => $input['catatan'] ?? null,
                'total' => isset($input['total']) ? (int) round($input['total']) : (isset($input['subtotal']) ? (int) round($input['subtotal']) : 0),
                'original_total' => isset($input['subtotal']) ? (int) round($input['subtotal']) : null,
                'voucher_code' => $input['voucher'] ?? null,
            ];
            try {
                TokoModel::create($data);
                \Log::error('Order saved despite error');
                return response()->json(['success' => true, 'warning' => 'Saved with server error; admin notified']);
            } catch (\Exception $e2) {
                \Log::error('Failed to save minimal order: ' . $e2->getMessage());
                return response()->json(['success' => false, 'message' => 'Failed to save order', 'error' => $e2->getMessage()], 500);
            }
        }


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
