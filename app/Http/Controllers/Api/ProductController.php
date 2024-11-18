<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //get all products
    public function index(){
        $products = Product::all();
        return response()->json($products);
    }   

    //get single product by id
    public function show($id)
    {
        
    $product = Product::find($id);
    
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }
    
        return response()->json($product, 200);
    }

    //create a new product
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'regular_price' => 'required|numeric',
            'SKU' => 'required|string|unique:products',
            'stock_status' => 'required|in:instock,outofstock',
            'quantity' => 'required|integer',
            'image' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    //update a product
    public function update(Request $request, $id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'slug' => 'string|max:255|unique:products,slug,'.$id,
           'short_description' =>'string',
            'description' =>'string',
           'regular_price' => 'numeric',
            'SKU' =>'string|unique:products,SKU,'.$id,
           'stock_status' => 'in:instock,outofstock',
            'quantity' => 'integer',
            'image' =>'string',
            'category_id' => 'exists:categories,id',
            'brand_id' => 'exists:brands,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $product->update($request->all());
        return response()->json($product, 200);
    }

    //delete a product
    public function destroy($id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted'], 200);
    }
}
