<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getAll(){
        $users = User::all();
        if ($users->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $users,
        ], 200);
    }

    public function getById($id){
        $user = User::find($id);
        if ($user->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);
    }

    public function create(Request $request){
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $user,
        ], 201);
    }

    public function updateById($id, Request $request){
        $user = User::findOrfail($id);
        if ($user->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        $user->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200); 
    }

    public function deleteById($id){
        $user = User::findOrfail($id);
        if ($user->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);
    }
}
