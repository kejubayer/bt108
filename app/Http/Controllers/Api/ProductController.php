<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::orderBy('id', 'desc')->get();
            return response()->json([
                'success' => true,
                'message' => "All products list!",
                'data' => $products
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 404);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::where('id', $id)->first();
            return response()->json([
                'success' => true,
                'message' => "Single product!",
                'data' => $product
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {
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
                return response()->json([
                    'success' => false,
                    'message' => $validator->getMessageBag()
                ]);
            }

            $inputs = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'desc' => $request->input('description'),
            ];
            $newName = 'product_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('uploads/products/', $newName);
            $inputs['photo'] = $newName;
           $product = Product::create($inputs);
            return response()->json([
                'success' => true,
                'message' => "Product Created!",
                'data' => $product
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 404);
        }
    }

    public function update(Request $request,$id)
    {
        try {
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
                return response()->json([
                    'success' => false,
                    'message' => $validator->getMessageBag()
                ]);
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
            return response()->json([
                'success' => true,
                'message' => "Product Updated!",
                'data' => $product
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 404);
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            if (file_exists('uploads/products/' . $product->photo)) {
                unlink('uploads/products/' . $product->photo);
            }
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => "Product Deleted!",
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
