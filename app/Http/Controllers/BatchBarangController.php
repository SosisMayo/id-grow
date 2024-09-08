<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchBarang;
class BatchBarangController extends Controller
{

    public function getAll(){
        $batchBarangs = BatchBarang::all();
        if ($batchBarangs->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Batch Barang not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $batchBarangs,
        ], 200);
    }

    public function getById($id){
        $batchBarang = BatchBarang::find($id);
        if ($batchBarang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Batch Barang not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $batchBarang,
        ], 200);
    }

    public function create(Request $request){
        $request->validate([
            'id_barang' => 'required',
            'kode_batch' => 'required',
            'tanggal_produksi' => 'required',
            'tanggal_kadaluarsa' => 'required',
            'kuantitas' => 'required',
        ]);
        $batchBarang = BatchBarang::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $batchBarang,
        ], 201);
    }

    public function update(Request $request, $id){
        $batchBarang = BatchBarang::find($id);
        if ($batchBarang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Batch Barang not found',
            ], 404);
        }

        $batchBarang->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $batchBarang,
        ], 200);
    }

    public function delete($id){
        $batchBarang = BatchBarang::find($id);
        if ($batchBarang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Batch Barang not found',
            ], 404);
        }
        $batchBarang->delete();
        return response()->json([
            'success' => true,
            'data' => $batchBarang,
        ], 200);
    }

    public function cekKadaluarsa(){
        $batchBarangs = BatchBarang::where('tanggal_kadaluarsa', '<', date('Y-m-d'))->get();
        if ($batchBarangs->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Batch Barang not found',
            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'data' => $batchBarangs,
            ], 200);
        }
    }
}
