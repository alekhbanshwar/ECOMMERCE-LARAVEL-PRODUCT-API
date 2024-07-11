<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductAttr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flasher\Toastr\Prime\ToastrInterface;
use Storage;

class ProductAttrController extends Controller
{
    public function productAttrIndex($pro_id)
    {

        $productAttr = ProductAttr::where(["products_id" => $pro_id])->get();
        if ($productAttr->count() > 0) {
            // return ProductResource::collection($products);
            return response()->json($productAttr);
        } else {
            return response()->json(
                [
                    "status" => 404,
                    "message" => 'No record available.',
                    'pro_id'=>$pro_id
                ],
                404
            );
        }
    }

    public function ManageProductAttr($pro_id, $id = "")
    {
        if ($id) {
            $arr = ProductAttr::where(['id' => $id, 'products_id' => $pro_id])->get();
            $result['id'] = $arr['0']->id;
            $result['products_id'] = $pro_id;
            $result['sku'] = $arr['0']->sku;
            $result['attr_image'] = $arr['0']->attr_image;
            $result['mrp'] = $arr['0']->mrp;
            $result['price'] = $arr['0']->price;
            $result['qty'] = $arr['0']->qty;
            $result['size'] = $arr['0']->size;
            $result['color'] = $arr['0']->color;
        } else {
            $result['id'] = '';
            $result['products_id'] = $pro_id;
            $result['sku'] = '';
            $result['attr_image'] = '';
            $result['mrp'] = '';
            $result['price'] = '';
            $result['qty'] = '';
            $result['size'] = '';
            $result['color'] = '';
        }
        return view('Product.ManageProductAttr', $result);
    }

    public function productAttrStore(Request $request, $pro_id)
    {

        $request->validate([
            'sku' => 'required|unique:product_attrs,sku,' . $request->id,
            'attr_image' => 'mimes:jpg,jpeg,png',
        ]);

        // product default image 
        if ($request->hasFile('attr_image')) {

            $image = $request->file('attr_image');
            $ext = $image->getClientOriginalExtension();
            $image_name = time() . '.' . $ext;
            $image->storeAs('/public/media', $image_name);
        }
        $productAttr = ProductAttr::create([
            'products_id' => $pro_id,
            'sku' => $request->sku,
            'attr_image' => $image_name,
            'mrp' => $request->mrp,
            'price' => $request->price,
            'qty' => $request->qty,
            'size' => $request->size,
            'color' => $request->color
        ]);
        return response()->json([
            'message' => "Product Attributes created Successfully",
            'status' => 'Success',
        ], 200);
        // return redirect()->route('ManageProductAttr.Index', ['pro_id' => $request->pid])->with('success', 'Product Attributes  successfully');

    }

    public function productAttrShow($pro_id, $id)
    {
        $pro = ProductAttr::where(["products_id" => $pro_id, 'id' => $id])->get();
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

    public function productAttrUpdate($pro_id, $id, Request $request)
    {
        $request->validate([
            'sku' => 'required|unique:product_attrs,sku,' . $request->id,
            'attr_image' => 'mimes:jpg,jpeg,png',
        ]);
        if ($request->hasFile('attr_image')) {
            if ($request->id > 0) {
                $arrImage = DB::table('product_attrs')->where(['id' => $request->id])->get();
                if (Storage::exists('/public/media/' . $arrImage[0]->attr_image)) {
                    Storage::delete('/public/media/' . $arrImage[0]->attr_image);
                }
            }
            $image = $request->file('attr_image');
            $ext = $image->getClientOriginalExtension();
            $image_name = time() . '.' . $ext;
            $image->storeAs('/public/media', $image_name);

            $productAttr = ProductAttr::find($request->id);
            $productAttr->update([
                'sku' => $request->sku,
                'attr_image' => $image_name,
                'mrp' => $request->mrp,
                'price' => $request->price,
                'qty' => $request->qty,
                'size' => $request->size,
                'color' => $request->color
            ]);
        } else {
            $productAttr = ProductAttr::find($request->id);
            $productAttr->update([
                'sku' => $request->sku,
                'mrp' => $request->mrp,
                'price' => $request->price,
                'qty' => $request->qty,
                'size' => $request->size,
                'color' => $request->color
            ]);
        }
        return response()->json([

            'message' => "Product Attributes Updated Successfully",
            'status' => 'Success',
        ], 200);
        // return redirect()->route('ManageProductAttr.Index', ['pro_id' => $request->pid])->with('success', 'Product Attributes Updated successfully');

    }

    public function productAttrDestroy($id)
    {
        ProductAttr::where(['id' => $id])->delete();
        return response()->json([

            'message' => "Product Attributes Deleted Successfully",
            'status' => 'Success',
        ], 200);
        // return back()->with('success', 'Product Attributes Deleted successfully');
    }
}
