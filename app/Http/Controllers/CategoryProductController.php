<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{

    //Mengambil semua data kategori produk
    public function index(){
        $categories = CategoryProduct::with('products')->get();
        return response()->json($categories);
    }

    //Mengambil data kategori produk berdasarkan id
    public function show($id){
        $categoryProduct = CategoryProduct::find($id);

        if(!$categoryProduct){
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($categoryProduct);
    }

    //Membuat kategori produk baru
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $categoryProduct = CategoryProduct::create([
            'name' => $request->name
        ]);

        return response()->json($categoryProduct, 201);
    }

    //Mengupdate Kategori Produk Berdasarkan ID
    public function update(Request $request, $id){
        $categoryProduct = CategoryProduct::find($id);

        if(!$categoryProduct){
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $categoryProduct->update([
            'name' => $request->name
        ]);

        return response()->json($categoryProduct);
    }

    //Menghapus Kategori Produk Berdasarkan ID
    public function destroy($id){
        $categoryProduct = CategoryProduct::find($id);

        if(!$categoryProduct){
            return response()->json(['message' => 'Category not found'], 404);
        }

        $categoryProduct->delete();

        return response()->json(['message' => 'Category deleted']);
    }   
}
