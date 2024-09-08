<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryBarang;

class CategoryBarangController extends Controller
{
    public function getAll(){
        $categoryBarangs = CategoryBarang::all();
        if ($categoryBarangs->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Category Barang not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $categoryBarangs,
        ], 200);
    }

    public function getById($id){
        $categoryBarang = CategoryBarang::find($id);
        if ($categoryBarang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Category Barang not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $categoryBarang,
        ], 200);
    }

    public function create(Request $request){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        $categoryBarang = CategoryBarang::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $categoryBarang,
        ], 201);
    }

    public function update(Request $request, $id){
        $categoryBarang = CategoryBarang::find($id);
        if ($categoryBarang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Category Barang not found',
            ], 404);
        }

        $categoryBarang->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $categoryBarang,
        ], 200);
    }

    public function delete($id){
        $categoryBarang = CategoryBarang::find($id);
        if ($categoryBarang->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Category Barang not found',
            ], 404);
        }
        $categoryBarang->delete();
        return response()->json([
            'success' => true,
            'data' => $categoryBarang,
        ], 200);
    }
}
