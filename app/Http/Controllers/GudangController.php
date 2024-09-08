<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;

class GudangController extends Controller
{

    public function getAll(){
        $gudangs = Gudang::all();
        if ($gudangs->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gudang not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $gudangs,
        ], 200);
    }

    public function getById($id){
        $gudang = Gudang::find($id);
        if ($gudang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gudang not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $gudang,
        ], 200);
    }

    public function create(Request $request){
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
        ]);
        $gudang = Gudang::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $gudang,
        ], 201);
    }

    public function update(Request $request, $id){
        $gudang = Gudang::find($id);
        if ($gudang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gudang not found',
            ], 404);
        }

        $gudang->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $gudang,
        ], 200);
    }

    public function delete($id){
        $gudang = Gudang::find($id);
        if ($gudang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gudang not found',
            ], 404);
        }
        $gudang->delete();
        return response()->json([
            'success' => true,
            'data' => $gudang,
        ], 200);
    }
}
