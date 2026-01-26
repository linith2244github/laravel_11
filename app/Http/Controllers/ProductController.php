<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


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
        return response()->json([
            'status' => 200,
            'message'=> 'Product created successfully'
        ], 201);
    }
}
