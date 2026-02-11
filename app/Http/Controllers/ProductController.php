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
            $product->description = $request->input('desc');
            $product->price = $request->input('price');
            $product->qty = $request->input('qty');
            if($request->file('image') != null){
                $file = $request->file('image');
                //extension image
                //phone1.jpg
                $ext = $file->getClientOriginalExtension();
                //set image name 
                //0-.9, 1->8
                $imageName = rand(0, 99999999).'.'.$ext; //2343243.jpg
                //move to directory
                // $file->move(public_path('uploads/$imageName'));
                $file->move(public_path('uploads'), $imageName);
                //move image name ot table feild
                $product->image = $imageName;
            }
            //with session
            session()->flash('success', "Product created successfully!");
            $product->save();
            return response()->json([
                'status' => 200,
                'message'=> 'Product created successfully'
            ]);
        }else{
            return response()->json([
                'status'=> 500,
                'message'=> "Please config errors",
                "errors" => $validator->errors()
            ]);
        }
    }
}
