<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // show admin home page
    public function showProductPage()
    {
        $products = Product::select('products.*', 'categories.name as category_name')
            ->join('categories', 'products.category_id', 'categories.category_id')
            ->when(request()->searchKey, function ($data, $searchKey) {
                $data->orwhere('products.name', 'like', '%' . $searchKey . '%')->orwhere('categories.name', 'like', '%' . $searchKey . '%');
            })
            ->orderBy('products.created_at', 'desc')
            ->paginate(5);

        // $products->append(request()->query());

        Session::put('prevUrl', request()->fullUrl());

        return view('admin.product.productList', compact('products'));
    }

    // show product create page
    public function showCreatepage()
    {
        $categories = Category::select('category_id', 'name')->get();
        return view('admin/product/productCreate', compact('categories'));
    }


    // product create
    public function createProduct(Request $request)
    {
        // check validation
        $this->checkValidatioForProduct($request);

        // get product data
        $productData = $this->getDataForProduct($request);

        // bind image name with unique id and store image under public/product_images
        $pizzaImageName = uniqid() . '_' . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public/product_images/', $pizzaImageName);

        // store product data to db
        $productData['image'] = $pizzaImageName;
        Product::create($productData);
        return redirect()->route('admin#home')->with(['createMsg' => 'Product creating success.']);
    }

    // show about about page
    public function showAboutProduct($id)
    {
        $product = Product::select('products.*', 'categories.name as category_name')
            ->join('categories', 'products.category_id', 'categories.category_id')
            ->where('products.product_id', $id)
            ->first();
        return view('admin/product/productAbout', compact('product'));
    }

    // show edit page
    public function showEditPage($id)
    {
        $product = Product::where('product_id', $id)->first();
        $categories = Category::select('category_id', 'name')->get();
        return view('admin/product/productEdit', compact('product', 'categories'));
    }

    // store edit data
    public function storeEditData(Request $request, $id)
    {
        // validation for edit product
        $this->checkValidatioForEditProduct($request, $id);

        // get new data from edit
        $newData = $this->getDataForEditProduct($request);

        // store new data to db
        Product::where('product_id', $id)->update($newData);

        return redirect()->route('admin#home')->with(['updateMsg' => 'Product updating success.']);
    }

    // show product image change page
    public function showImageChange($id)
    {
        $product = Product::select('image', 'product_id')->where('product_id', $id)->first();
        return view('admin/product/productImageChange', compact('product'));
    }

    // change product image
    public function changeImage($id)
    {
        // image validation
        Validator::make(request()->file(), [
            'productImage' => 'required|mimes:jpg,png,jpeg,webp',
        ])->validate();

        // delete old image
        $oldImageName = Product::select('image')->where('product_id', $id)->first()->image;
        if ($oldImageName != null) {
            Storage::delete('public/product_images/' . $oldImageName);
        }

        // store new image to public/storage/product_images and store name to db
        $newImageName = uniqid() . '_' . request()->file('productImage')->getClientOriginalName();
        request()->file('productImage')->storeAs('public/product_images/', $newImageName);
        Product::where('product_id', $id)->update(['image' => $newImageName]);

        return redirect()->route('product#edit', $id)->with(['imgChangeMsg' => 'Product image updating success.']);
    }

    // delete product
    public function deleteProduct($id)
    {
        Product::where('product_id', $id)->delete();
        return redirect()->route('admin#home')->with(['deleteMsg' => 'Product deleting success.']);
    }




    // get data for product
    protected function getDataForProduct($request)
    {
        return $data = [
            'name' => $request->pizzaName,
            'description' => $request->pizzaDesc,
            'category_id' => $request->category_id,
            'price' => $request->pizzaPrice,
            'image' => $request->image,
        ];
    }

    // validation for product
    protected function checkValidatioForProduct($request)
    {
        Validator::make($request->all(), [
            'pizzaName' => 'required|unique:products,name|min:5',
            'pizzaDesc' => 'required|min:10',
            'category_id' => 'required',
            'pizzaPrice' => 'required',
            'pizzaImage' => 'required|mimes:jpg,png,jpeg,webp',
        ], [])->validate();
    }


    // get data for edit product
    protected function getDataForEditProduct($request)
    {
        return $data = [
            'name' => $request->productName,
            'description' => $request->productDesc,
            'category_id' => $request->productCategory,
            'price' => $request->productPrice,
        ];
    }

    // validation for edit product
    protected function checkValidatioForEditProduct($request, $id)
    {
        Validator::make($request->all(), [
            'productName' => 'required|min:5|unique:products,name,' . $id . ',product_id',
            'productDesc' => 'required|min:10',
            'productCategory' => 'required',
            'productPrice' => 'required',
        ], [])->validate();
    }
}
