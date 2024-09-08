<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutasi;
use App\Models\BatchBarang;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class MutasiController extends Controller
{
    public function getAll(){
        $mutasis = Mutasi::all();
        if ($mutasis->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Mutasi not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $mutasis,
        ], 200);
    }

    public function getById($id){
        $mutasi = Mutasi::find($id);
        if ($mutasi->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Mutasi not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $mutasi,
        ], 200);
    }

    public function getByUser($userId){
        $mutasis = Mutasi::where('id_user', $userId)->get();
        if ($mutasis->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Mutasi not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $mutasis,
        ], 200);
    }

    public function getByBarang($barangId){
        $kodeBatch = BatchBarang::where('id_barang', $barangId)->pluck('id')->toArray();

        // make $mutasis to select data from Mutasi where the id_batch is appear on $kodeBatch

        $mutasis = Mutasi::whereIn('id_batch', $kodeBatch)->get();
       
        if ($mutasis->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Mutasi not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $mutasis,
        ], 200);
    }

    public function create(Request $request){

        $request['id_user'] = Auth::user()->id;

        $request->validate([
            'id_batch' => 'required',
            'jenis_mutasi' => 'required',
            'jumlah' => 'required',
        ]);

        $batch = BatchBarang::find($request->input('id_batch'));

        if (!$batch) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }

        $barang = Barang::find($batch->id_barang);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found',
            ], 404);
        }

        if ($request->input('jenis_mutasi') == 'Masuk') {
            $batch->kuantitas += $request->input('jumlah');
            $batch->save();
            $barang->stok += $request->input('jumlah');
            $barang->save();
        }

        if ($request->input('jenis_mutasi') == 'Keluar') {
            if ($request->input('jumlah') > $batch->kuantitas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi',
                ], 400);
            }

            $batch->kuantitas -= $request->input('jumlah');
            $batch->save();
            $barang->stok -= $request->input('jumlah');
            $barang->save();
        }

        $mutasi = Mutasi::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $mutasi,
        ], 201);
    }

    public function updateById($id, Request $request){
        $mutasi = Mutasi::findOrfail($id);
        if ($mutasi->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Mutasi not found',
            ], 404);
        }
        $mutasi->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $mutasi,
        ], 200);
    }

    public function deleteById($id){
        $mutasi = Mutasi::findOrfail($id);
        if ($mutasi->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Mutasi not found',
            ], 404);
        }
        $mutasi->delete();
        return response()->json([
            'success' => true,
            'data' => $mutasi,
        ], 200);
    }
}
