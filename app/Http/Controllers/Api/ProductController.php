<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Storage;

class ProductController extends Controller
{
    public function Index()
    {
        $products = Product::with('productAttrs', 'productImages')->get();
        if ($products->count() > 0) {
            // return ProductResource::collection($products);

            return response()->json($products);
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

    public function Product()
    {
        return view('Product.Products');
    }
    public function ManageProduct(Request $request, $id = '')
    {
        if ($id) {
            $arr = Product::where(['id' => $id])->get();
            $result['category'] = $arr['0']->category;
            $result['name'] = $arr['0']->name;
            $result['image'] = $arr['0']->image;
            $result['slug'] = $arr['0']->slug;
            $result['brand'] = $arr['0']->brand;
            $result['model'] = $arr['0']->model;
            $result['short_desc'] = $arr['0']->short_desc;
            $result['desc'] = $arr['0']->desc;
            $result['keywords'] = $arr['0']->keywords;
            $result['technical_specification'] = $arr['0']->technical_specification;
            $result['uses'] = $arr['0']->uses;
            $result['warranty'] = $arr['0']->warranty;
            $result['lead_time'] = $arr['0']->lead_time;
            $result['tax'] = $arr['0']->tax;
            $result['is_promo'] = $arr['0']->is_promo;
            $result['is_featured'] = $arr['0']->is_featured;
            $result['is_discounted'] = $arr['0']->is_discounted;
            $result['is_tranding'] = $arr['0']->is_tranding;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;

            $result['productAttrArr'] = DB::table('product_attrs')->where(['products_id' => $id])->get();

            $productImagesArr = DB::table('product_images')->where(['products_id' => $id])->get();
            if (!isset($productImagesArr[0])) {
                $result['productImagesArr']['0']['id'] = '';
                $result['productImagesArr']['0']['images'] = '';
            } else {
                $result['productImagesArr'] = $productImagesArr;
            }
        } else {
            $result['category'] = '';
            $result['name'] = '';
            $result['slug'] = '';
            $result['image'] = '';
            $result['brand'] = '';
            $result['model'] = '';
            $result['short_desc'] = '';
            $result['desc'] = '';
            $result['keywords'] = '';
            $result['technical_specification'] = '';
            $result['uses'] = '';
            $result['warranty'] = '';
            $result['lead_time'] = '';
            $result['tax'] = '';
            $result['is_promo'] = '';
            $result['is_featured'] = '';
            $result['is_discounted'] = '';
            $result['is_tranding'] = '';
            $result['status'] = '';
            $result['id'] = 0;

            $result['productAttrArr'][0]['id'] = '';
            $result['productAttrArr'][0]['products_id'] = '';
            $result['productAttrArr'][0]['sku'] = '';
            $result['productAttrArr'][0]['attr_image'] = '';
            $result['productAttrArr'][0]['mrp'] = '';
            $result['productAttrArr'][0]['price'] = '';
            $result['productAttrArr'][0]['qty'] = '';
            $result['productAttrArr'][0]['size'] = '';
            $result['productAttrArr'][0]['color'] = '';

            $result['productImagesArr']['0']['id'] = '';
            $result['productImagesArr']['0']['images'] = '';
        }
        return view('Product.ManageProduct', $result);
    }

    public function store(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'image' => "required",
                'slug' => 'required|unique:products,slug,' . $request->post('id'),
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        } else {

            // product default image 
            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $ext = $image->extension();
                $image_name = time() . '.' . $ext;
                $image->storeAs('/public/media', $image_name);

            }

            $product = Product::create([
                'category' => $request->category,
                'name' => $request->name,
                'image' => $image_name,
                'slug' => $request->slug,
                'brand' => $request->brand,
                'model' => $request->model,
                'short_desc' => $request->short_desc,
                'desc' => $request->desc,
                'keywords' => $request->keywords,
                'technical_specification' => $request->technical_specification,
                'uses' => $request->uses,
                'lead_time' => $request->lead_time,
                'tax' => $request->tax,
                'is_promo' => $request->is_promo,
                'is_featured' => $request->is_featured,
                'is_tranding' => $request->is_tranding,
                'is_discounted' => $request->is_discounted,
                'status' => 1,
            ]);


        }
        return response()->json([
            'message' => 'Product Created Successfully',
            'data' => new ProductResource($product)
        ]);
        // return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show($product)
    {
        $pro = Product::with('productAttrs', 'productImages')->find($product);
        if ($pro) {
            return response()->json([
                'status' => 200,
                'products' => $pro
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Such Product Found'
            ], 404);
        }
    }
    public function update(Request $request, $product)
    {
        if ($product > 0) {
            $image_validation = "mimes:jpeg,jpg,png";
        }
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        } else {


            // product default image 
            if ($request->hasFile('image')) {
                if ($request->id > 0) {
                    $arrImage = DB::table('products')->where(['id' => $request->id])->get();
                    if (Storage::exists('/public/media/' . $arrImage[0]->image)) {
                        Storage::delete('/public/media/' . $arrImage[0]->image);
                    }
                }
                $image = $request->file('image');
                $ext = $image->extension();
                $image_name = time() . '.' . $ext;
                $image->storeAs('/public/media', $image_name);
                $pro = Product::find($product);
                $pro->update([
                    'category' => $request->category,
                    'name' => $request->name,
                    'image' => $image_name,
                    'slug' => $request->slug,
                    'brand' => $request->brand,
                    'model' => $request->model,
                    'short_desc' => $request->short_desc,
                    'desc' => $request->desc,
                    'keywords' => $request->keywords,
                    'technical_specification' => $request->technical_specification,
                    'uses' => $request->uses,
                    'lead_time' => $request->lead_time,
                    'tax' => $request->tax,
                    'is_promo' => $request->is_promo,
                    'is_featured' => $request->is_featured,
                    'is_tranding' => $request->is_tranding,
                    'is_discounted' => $request->is_discounted,
                    'status' => 1,
                ]);

            } else {
                $pro = Product::find($product);
                $pro->update([
                    'category' => $request->category,
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'brand' => $request->brand,
                    'model' => $request->model,
                    'short_desc' => $request->short_desc,
                    'desc' => $request->desc,
                    'keywords' => $request->keywords,
                    'technical_specification' => $request->technical_specification,
                    'uses' => $request->uses,
                    'lead_time' => $request->lead_time,
                    'tax' => $request->tax,
                    'is_promo' => $request->is_promo,
                    'is_featured' => $request->is_featured,
                    'is_tranding' => $request->is_tranding,
                    'is_discounted' => $request->is_discounted,
                    'status' => 1,
                ]);
            }
        }
        return response()->json([
            'status' => 'Success',
            'message' => 'Product  Updated Successfully',
            'data' => $pro
        ]);
    }


    public function destroy($product)
    {
        ProductAttr::where('products_id', $product)->delete();
        ProductImages::where('products_id', $product)->delete();
        Product::destroy($product);
        // return view('Product.Products');
        return response()->json([

            'message' => "Product Deleted Successfully",
            'status' => 'Success',
        ], 200);
        // return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function ProductView($id)
    {
        $result = Product::with('productAttrs', 'productImages')->find($id);
        if (!$result) {
            return view('Product.ProductView', ['error' => 'Product not found']);
        }

        return view('Product.ProductView', ['result' => $result]);

    }
}