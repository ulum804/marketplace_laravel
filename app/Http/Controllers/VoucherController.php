<?php

namespace App\Http\Controllers;

use App\Models\VoucherModel;
use Illuminate\Http\Request;


class VoucherController extends Controller

{
    public function index(Request $request)
    {
    //    $vouchers = VoucherModel::orderBy('created_at', 'desc')->get();
        // return view('admin.dashboard', compact('vouchers'));
         if ($request->expectsJson()) {
        return VoucherModel::orderBy('created_at', 'desc')->get();
    }

    abort(404);
    }
     public function store(Request $request)
    {
        $validated = $request->validate([
            'code'          => 'required|string|unique:vouchers,code',
            'type'          => 'required|in:fixed,percent,freeShipping',
            'value'         => 'required|integer|min:0',
            'min_purchase'  => 'nullable|integer|min:0',
            'description'   => 'nullable|string',
            'expired_at'    => 'nullable|date',
        ]);

        VoucherModel::create($validated);

        return response()->json([
            'message' => 'Voucher berhasil ditambahkan'
        ]);
    }

    /* ================= DELETE ================= */
    public function destroy(VoucherModel $voucher)
    {
        $voucher->delete();

        return response()->json([
            'message' => 'Voucher berhasil dihapus'
        ]);
    }

    public function update(Request $request, VoucherModel $voucher)
    {
        $validated = $request->validate([
            'code'          => 'required|string|unique:vouchers,code,' . $voucher->id,
            'type'          => 'required|in:fixed,percent,freeShipping',
            'value'         => 'required|integer|min:0',
            'min_purchase'  => 'nullable|integer|min:0',
            'description'   => 'nullable|string',
            'expired_at'    => 'nullable|date',
        ]);

        $voucher->update($validated);

        return response()->json([
            'message' => 'Voucher berhasil diperbarui'
        ]);
    }
 

    /* ================= TOGGLE ================= */
    public function toggle(VoucherModel $voucher)
    {
        $voucher->update([
            'is_active' => !$voucher->is_active
        ]);

        return response()->json([
            'message' => 'Status voucher diubah'
        ]);
    }
}
