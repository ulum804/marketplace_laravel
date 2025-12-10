<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = ProdukModel::all();

        // Always return JSON for API routes or AJAX requests
        if (request()->is('api/*') || request()->ajax()) {
            return response()->json($produk);
        }

        return view('market.menu', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'harga' => 'required|integer|min:0',
            'gambar' => 'required|string', // Base64 image data
        ]);

        // Decode base64 image and save to storage
        $imageData = $validated['gambar'];
        if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $matches)) {
            $imageType = $matches[1];
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
            $imageData = base64_decode($imageData);

            // Generate unique filename
            $filename = 'produk_' . time() . '_' . uniqid() . '.' . $imageType;

            // Save to storage/app/public/produk
            Storage::disk('public')->put('produk/' . $filename, $imageData);

            // Update validated data with filename
            $validated['gambar'] = 'storage/produk/' . $filename;
        }

        ProdukModel::create($validated);

        return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = ProdukModel::findOrFail($id);
        return response()->json($produk);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produk = ProdukModel::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'harga' => 'required|integer|min:0',
            'gambar' => 'nullable|string',
        ]);

        // Handle image update if provided
        if (isset($validated['gambar']) && $validated['gambar']) {
            $imageData = $validated['gambar'];
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $matches)) {
                // New image uploaded (base64 data)
                $imageType = $matches[1];
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $imageData = base64_decode($imageData);

                // Generate unique filename
                $filename = 'produk_' . time() . '_' . uniqid() . '.' . $imageType;

                // Save to storage/app/public/produk
                Storage::disk('public')->put('produk/' . $filename, $imageData);

                // Update validated data with filename
                $validated['gambar'] = 'storage/produk/' . $filename;

                // Delete old image if exists
                if ($produk->gambar && file_exists(public_path($produk->gambar))) {
                    unlink(public_path($produk->gambar));
                }
            } else {
                // No new image uploaded, keep existing image
                unset($validated['gambar']);
            }
        }

        $produk->update($validated);

        return response()->json(['success' => true, 'message' => 'Produk berhasil diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = ProdukModel::findOrFail($id);

        // Delete image file if exists
        if ($produk->gambar && file_exists(public_path($produk->gambar))) {
            unlink(public_path($produk->gambar));
        }

        $produk->delete();

        return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus.']);
    }
}
