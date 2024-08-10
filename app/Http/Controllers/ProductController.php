<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    //Mengambil semua data produk
    public function index(){
        $products = Product::all();
        return response()->json($products);
    }

    //Mengambil data produk berdasarkan id
    public function show($id){
        $product = Product::find($id);

        if(!$product){
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    //Membuat produk baru
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'category_product_id' => 'required|exists:category_products,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $product = Product::create([
            'category_product_id' => $request->category_product_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image
        ]);

        return response()->json($product, 201);
    }

    //Menupdate Produk Berdasarkan ID
    public function update(Request $request, $id){
        $product = Product::find($id);

        if(!$product){
            return response()->json(['message'=> 'Product not found'],404);
        }

        $validator = Validator::make($request->all(),[
            'category_product_id' => 'required|exists:category_products,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $product->update([
            'category_product_id' => $request->category_product_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image
        ]);

        return response()->json($product);
    }

    //Menghapus Produk Berdasarkan ID
    public function destroy($id){
        $product = Product::find($id);

        if(!$product){
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
