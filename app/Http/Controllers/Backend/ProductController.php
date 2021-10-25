<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        return view('backend.products.create');
    }

    public function store(Request $request)
    {
        $inputs = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'desc' => $request->input('description'),
        ];
        $newName = 'product_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/products/',$newName);
        $inputs['photo'] = $newName;

        Product::create($inputs);
        return redirect()->route('admin.product');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('backend.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $inputs =[
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'desc' => $request->input('description'),
        ];
        if (file_exists($request->file('photo'))){

            $newName = 'product_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('uploads/products/',$newName);
            $inputs['photo'] = $newName;
        }
        $product->update($inputs);
        return redirect()->route('admin.product');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (file_exists('uploads/products/'.$product->photo)){
            unlink('uploads/products/'.$product->photo);
        }
        $product->delete();
        return redirect()->back();
    }
}
