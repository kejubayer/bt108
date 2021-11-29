<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        /*$request->validate([
            'name'=>'required|min:3',
            'price'=>'required',
            'description'=>'required',
            'photo'=>'required|image',
        ],
        [
            'photo.required'=>'Please upload a photo',
            'photo.image'=>'must be an image (jpg, jpeg, png, bmp, gif, svg, or webp)',
        ]
        );*/

        $validator =  Validator::make($request->all(),[
                'name'=>'required|min:3',
                'price'=>'required',
                'description'=>'required',
                'photo'=>'required|image',
            ],
            [
                'photo.required'=>'Please upload a photo',
                'photo.image'=>'must be an image (jpg, jpeg, png, bmp, gif, svg, or webp)',
            ]
        );
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
        }

        $inputs = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'desc' => $request->input('description'),
        ];
        $newName = 'product_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/products/', $newName);
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
        $validator =  Validator::make($request->all(),[
            'name'=>'required|min:3',
            'price'=>'required',
            'description'=>'required',
            'photo'=>'image|max:1024',
        ],
            [
                'photo.image'=>'must be an image (jpg, jpeg, png, bmp, gif, svg, or webp)',
                'photo.max'=>'The photo must not be greater than 1 mb.',
            ]
        );
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
        }
        $product = Product::find($id);
        $inputs = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'desc' => $request->input('description'),
        ];
        if (file_exists($request->file('photo'))) {
            if (file_exists('uploads/products/' . $product->photo)) {
                unlink('uploads/products/' . $product->photo);
            }
            $newName = 'product_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('uploads/products/', $newName);
            $inputs['photo'] = $newName;
        }
        $product->update($inputs);
        return redirect()->route('admin.product');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (file_exists('uploads/products/' . $product->photo)) {
            unlink('uploads/products/' . $product->photo);
        }
        $product->delete();
        return redirect()->back();
    }
}
