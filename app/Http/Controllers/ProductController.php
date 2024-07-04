<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //this method will show  product page
    public function index()
    {
        $products = Product::orderBy('created_at', 'ASC')->get();
        return view('products.list', ['products' => $products]);
    }
    //this method will show create product page
    public function create()
    {
        return view('products.create');
    }
    //this method will store product page
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];
        if ($request->image != '') {
            $rules['image'] = 'image';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }
        //store in db
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        //image store in DB
        if ($request->image != '') {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;  //unique image name

            //save image to uploads/products
            $image->move(public_path('upload/products'), $imageName);

            $product->image = $imageName;
            $product->save();
        }
        return redirect()->route('products.index')->with('success', 'Products added successfully');
    }
    //this method will show edit product page
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }
    //this method will update product page
    public function update($id, Request $request)
    {

        $product = Product::findOrFail($id);


        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];
        if ($request->image != '') {
            $rules['image'] = 'image';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }
        //update in db
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        //image store in DB
        if ($request->image != '') {
            //delete old image
            File::delete(public_path('upload/products/' . $product->image));
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;  //unique image name

            //save image to uploads/products
            $image->move(public_path('upload/products'), $imageName);

            $product->image = $imageName;
            $product->save();
        }
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    //this method will delete products
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        File::delete(public_path('upload/products/' . $product->image));
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
