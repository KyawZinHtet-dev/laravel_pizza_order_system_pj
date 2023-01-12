<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    // show category list page
    public function showCategoryList()
    {
        $categories = Category::when(request('searchKey'), function ($data, $searchKey) {
            $data->where('name', 'like', '%' . $searchKey . '%');
        })
            ->orderBy('category_id', 'desc')
            ->paginate(4);

        $categories->appends(request()->query());
        Session::put('prevUrl', request()->fullUrl());

        return view('admin.category.categoryListPage', compact('categories'));
    }

    // show category create page
    public function showCategoryCreatePage()
    {
        return view('admin.category.categoryCreatePage');
    }

    // store new category
    public function storeCategory(Request $request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name'
        ], [])->validate();

        Category::create(['name' => $request->categoryName]);
        return redirect()->route('category#list')->with(['createMsg' => 'New Category Creating Success.']);
    }

    // delete category
    public function deleteCategory($id)
    {
        Category::where('category_id', $id)->delete();
        return redirect()->route('category#list')->with(['deleteMsg' => 'Category deleting success.']);
    }

    // show edit category page
    public function showEditPage($id)
    {
        $category = Category::where('category_id', $id)->first();
        return view('admin.category.categoryEditPage', compact('category'));
        Session::put('prevUrl', request()->fullUrl());
    }

    // update category
    public function updateCategory($id, Request $request)
    {
        Validator::make($request->all(), [
            'categoryName' => "required|unique:categories,name,$id,category_id"
        ], [])->validate();

        $newCategory = ['name' => $request->categoryName];
        Category::where('category_id', $id)->update($newCategory);
        return redirect(Session::get('prevUrl'))->with(['updateMsg' => 'Category Name Updating Success.']);
    }
}
