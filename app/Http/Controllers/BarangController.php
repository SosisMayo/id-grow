<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function getAll(){
        $barangs = Barang::all();
        if ($barangs->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $barangs,
        ], 200);
    }

    public function getById($id){
        $barang = Barang::find($id);
        if ($barang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $barang,
        ], 200);
    }

    public function getByKodeBarang($kode){
        $barang = Barang::where('kode_barang', $kode)->first();
        if ($barang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $barang,
        ]);
    }

    public function create(Request $request){
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'category_id' => 'required',
            'lokasi_id' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ]);

        $barang = Barang::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $barang,
        ], 201);
    }

    public function updateById($id, Request $request){
        $barang = Barang::findOrfail($id);
        if ($barang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }
        $barang->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $barang,
        ], 200);
    }

    public function deleteById($id){
        $barang = Barang::findOrfail($id);
        if ($barang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }
        $barang->delete();
        return response()->json([
            'success' => true,
            'data' => $barang,
        ], 200);
    }
}
