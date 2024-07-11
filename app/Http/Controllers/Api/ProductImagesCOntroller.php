<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductImagesCOntroller extends Controller
{
    public function ProductImages($pro_id)
    {

        $productImages = ProductImages::where(["products_id" => $pro_id])->get();
        if ($productImages->count() > 0) {
            // return ProductResource::collection($products);
            return response()->json($productImages);
        } else {
            return response()->json(
                [
                    "status" => 404,
                    "message" => 'No record available.'
                ],
                404
            );
        }
    }

    public function ManageProductImages($pro_id)
    {
        $pid = $pro_id;
        return view('Product.ManageProductImages', compact('pid'));
    }

    public function productImagesStore(Request $request, $pro_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'images' => "required",
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        } else {
            // product default image 
            if ($request->hasFile('images')) {

                $image = $request->file('images');
                $ext = $image->getClientOriginalExtension();
                $image_name = time() . '.' . $ext;
                $image->storeAs('/public/media', $image_name);

            }

            $product = ProductImages::create([
                'products_id' => $pro_id,
                'images' => $image_name
            ]);
            return response()->json([
                'status' => 'Success',
                'message' => 'Product Created Successfully',
                'data' => $product
            ]);
            // return redirect()->route('ManageProductImages.Index', ['pro_id' => $request->pid])->with('message', 'Product Image created successfully');
        }
    }


    public function productImagesShow($pro_id, $id)
    {
        $pro = ProductImages::where(["products_id" => $pro_id, 'id' => $id])->get();
        if ($pro->count() > 0) {
            return response()->json([
                'status' => 200,
                'products' => $pro
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Such Product Found',
                'pro_id' => $pro_id,
                'id' => $id
            ], 404);
        }
    }
    public function productImagesDestroy($id)
    {
        $pro_images = ProductImages::where(['id' => $id])->delete();
        return response()->json([
            'status' => 'Success',
            'message' => 'Product Deleted Successfully',
        ]);

    }
}
