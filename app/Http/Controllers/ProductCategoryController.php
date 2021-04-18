<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->categories = ProductCategory::all();

        return view('productCategory.category', ['categories' => $this->categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Request $request)
    {
        if ($request->getMethod() === "GET") {
            return view('productCategory.addCategory');
        }
        if ($request->getMethod() === "POST") {
            $request->validate([
                'category_name' => 'unique:product_categories',
                'category_slug' => 'unique:product_categories'
            ]);

            if (isset($request['category_name']) && !empty($request['category_name'])) {

                $new_category = new ProductCategory();
                $new_category->category_name = $request['category_name'];

                $new_category->category_slug = !empty($request['category_slug']) ? strtolower($request['category_slug']) : strtolower($new_category->category_name);

                if( $request->hasFile('category_image'))
                {
                    $image = $request->file('category_image');
                    $name = $new_category->category_name.'.'.$image->extension();
                    $image->storeAs('/public/images/product_category/',  $new_category->category_name);
                    $new_category->image = $name;
                }

                if ($new_category->save()) {
                    $request->session()->flash('message', 'New product category successfully added');
                    return redirect('admin/product-category');
                }
            }
        }
    }

    /**
     * @param Request $request
     * @param $id
     *
     */
    public function editCategory(Request $request, $id = "")
    {
        if ($request->getMethod() === "GET") {
            $this->category = ProductCategory::find($id);

            return view('productCategory.editCategory', ['category' => $this->category]);
        }

        if ($request->getMethod() === "POST") {
            $this->category = ProductCategory::find($request->post('category_id'));

            $this->category->category_name = $request->post('category_name');
            $this->category->category_slug = $request->post('category_slug');

            if( $request->hasFile('category_image'))
            {
                $image = $request->file('category_image');
                $name =  $this->category->category_name.'.'.$image->extension();
                $image->storeAs('/public/images/product_category/',   $this->category->category_name);
                $this->category->image = $name;
            }

            if ($this->category->save()) {
                $request->session()->flash('message', 'Category updated');
            } else {
                $request->session()->flash('error', 'Something went wrong');
            }

            return redirect('admin/product-category');
        }

    }

    public function deleteCategory(Request $request, $id)
    {
        $this->category = ProductCategory::find($id);
        if (!empty($this->category)) {
            $this->category->delete();
            $request->session()->flash('message', 'Category deleted successfully');
        } else {
            $request->session()->flash('error', 'Category does not exist');
        }

        return redirect('admin/product-category');
    }


}
