<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('id', 'DESC')->paginate(8);
        return view("product", [
            "products"=> $products
        ]);
    }

    public function create(){
        return view("create");
    }

    public function edit(){
        return view("edit");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=> "required|min:4",
            "price"=> "required",
            "qty"=> "required",
        ]);
        if($validator->passes()){
            $product = new Product();
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->qty = $request->input('qty');
            $product->save();
            return response()->json([
                'status' => 200,
                'message'=> 'Product created successfully'
            ], 201);
        }else{
            return response()->json([
                'status'=> 500,
                'message'=> "Please config errors",
                "errors" => $validator->errors()
            ], 500);
        }
    }
}
