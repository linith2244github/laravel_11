<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request){
        if($request->get("search") != ''){
            $products = Product::orderBy("id", "DESC")->where("name", "LIKE", "%". $request->get('search') . "%")->paginate(8);
        }else{
            $products = Product::orderBy('id', 'DESC')->paginate(8);
        }
        return view("product", [
            "products"=> $products
        ]);
    }

    public function create(){
        return view("create");
    }

    public function edit(string $id){
        $product = Product::find($id);
        return view("edit", ["product" => $product]);
    }

    public function update(Request $request, string $id){
        $product = Product::find($id);
        $validator = Validator::make($request->all(),[
            "name"=> "required|min:4",
            "price"=> "required",
            "qty"=> "required",
        ]);
        if($product == null){
            return redirect()->back()->with("error", "Product not found with id $id");
        }
        if($validator->passes()){
            $product->name = $request->name;
            $product->description = $request->desc;
            $product->price = $request->price;
            $product->qty = $request->qty;

            if($request->hasFile("image")){
                $file = $request->file("image");
                $imageName = rand(0, 99999999) . ".". $file->getClientOriginalExtension();
                $file->move(public_path("uploads"), $imageName);
                if($request->old_image != null){
                    $image_path = public_path("uploads/". $request->old_image);
                    if(file_exists($image_path)){
                        File::delete($image_path);
                    }
                }
            }else{
                $imageName = $request->old_image;
            }
            $product->image = $imageName;

            $product->save();
            // Session::flash("success", "Product updated successfull");
            return redirect()->route("product.list")->with("success","Product updated successfull");
        }else{
            return back()->withInput()->withErrors($validator);
        }
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
    public function delete(string $id){
        $product = Product::find($id);
        if($product == null){
            return redirect()->back();
        }
        //delete image
        if($product->image != null){
            $image_path = public_path("uploads/".$product->image);
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            }
        $product->delete();
        //redirect to view
        return redirect()->back()->with("success","Product delete success!");
    }
    public function deleteSelect(Request $request){
        $productIds = $request->ids;
        //convert to array
        $ids = explode(",", $productIds);
        foreach($ids as $id){
            $product = Product::find($id);
            if($product->image != null){
                $image_path = public_path("uploads/".$product->image);
                if(File::exists($image_path)){
                    File::delete($image_path);
                }
            }
            $product->delete();
        }
        Session::flash("success","Product deleted Successfully!");
        return response([
            "status"=> 200,
            "message"=> "Product deleted successfully!",
        ]);
    }
}
