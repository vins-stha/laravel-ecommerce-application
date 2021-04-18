<?php

namespace App\Http\Controllers;


use App\Product;
use App\Product_brand;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        $this->products = Product::all();

        $string = file_get_contents('ico_rating_social_activity.json');
        $datas = json_decode($string, true);

        return view('product.products', ['products' => $this->products, 'icos' => $datas]);
    }

/*    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response


    public function addOrEdit(Request $request, $id='')
    {
        $this->categories = ProductCategory::all('category_name')->toArray();
        if ($request->getMethod() === "GET")
        {
            if ($request->route('id')  == null)  {
                return view('product.addProduct',['categories' =>$this->categories]);

             }
            else
            {

            }

        }
    }*/
    public function addProduct(Request $request)
    {
        $this->categories = ProductCategory::all('category_name')->toArray();
        $this->brands = Product_brand::all('name')->toArray();
        // $this->brands = ProductBrandsController::all('name')->toArray();var_dump($this->brands);
        if ($request->getMethod() === "GET") {
            return view('product.addProduct',[
                'categories' => $this->categories,
                'brands' => $this->brands
            ]);
        }
        if ($request->getMethod() === "POST") {

            if (isset($request['product_name']) && !empty($request['product_name'])) {
                $new_Product = new Product();

                $new_Product->name = $request['product_name'];
                $brand_id = Product_brand::select('id')->where('name',$request['product_brand'])->get();
                $new_Product->brand_id = $brand_id[0]['id'];

                $category = $request['product_category'];
                $category_id= ProductCategory::select('id')->where('category_name',$request['product_category'])->get();
                $new_Product->category_id = $category_id[0]['id'];

                $new_Product->price = $request['product_price'];
                $new_Product->color = $request['product_color'];
                $new_Product->description = $request['product_description'];
                $new_Product->extra = $request['product_extra'];
                $new_Product->sub_category_id = $request['product_sub_category'];
                //dd($request->post());

                if( $request->hasFile('product_image'))
                {
                    $image = $request->file('product_image');
                    $name = time().'.'.$image->extension();
                    $image->storeAs('/public/images/product/cat_'.$new_Product->category_id .'/',$name);
                    $new_Product->image = $name;

                }

                if ($new_Product->save()) {
                    $request->session()->flash('message', 'New product Product successfully added');
                    return redirect('admin/product');
                }
                else
                {
                    $request->session()->flash('error', 'Something went wrong');
                    return redirect('admin/product');
                }

            }
        }

    }

    /**
     * @param Request $request
     * @param $id
     *
     */
    public function editProduct(Request $request, $id = "")
    {
        $this->categories = ProductCategory::all('category_name')->toArray();
        $this->brands = Product_brand::all('name')->toArray();

        if ($request->getMethod() === "GET") {
            $this->product = Product::find($id);
            if ($this->product == null)
            {
                $request->session()->flash('error', 'Product not found ');
                return redirect('admin/product');
            }
            else
            {
                $category_name= ProductCategory::select('category_name')->where('id',$this->product['category_id'])->get()->toArray();
                $this->category= $category_name[0]['category_name']; //var_dump($this->category);

                $brand_array = Product_brand::select('name')->where('id', $this->product['brand_id'])->get()->toArray();
                $this->brand = $brand_array[0]['name'];


                return view('product.editProduct', ['product' => $this->product,
                    'categories' => $this->categories,
                    'product_category' => $this->category,
                    'product_brand' => $this->brand,
                    'brands' => $this->brands

                ]);
            }

        }

        if ($request->getMethod() === "POST") {

            $this->product = Product::find($request->post('id'));

            $this->product->name = $request['product_name'];
            $brand_id = Product_brand::select('id')->where('name',$request['product_brand'])->get();
            $this->product->brand_id = $brand_id[0]['id'];
            $this->product->price = $request['product_price'];
            $this->product->color = $request['product_color'];
            $this->product->description = $request['product_description'];
            $this->product->extra = $request['product_extra'];
            $this->product->sub_category_id = $request['product_sub_category'];

            $category_id= ProductCategory::select('id')->where('category_name',$request['product_category'])->get();
            $this->product->category_id = $category_id[0]['id'];

            if( $request->hasFile('product_image'))
            {
//                $request->validate([
//                    'product_image' =>'required|mimes:jpg, jpeg, png'
//                ]);

                $image = $request->file('product_image');
                if (in_array($image->extension(), ['jpg','jpeg','png','gif']))
                {
                    $name = time().'.'.$image->extension();
                    $image->storeAs('/public/images/product/cat_'.$this->product->category_id.'/',$name);
                    $this->product->image = $name;
                }
                else
                {
                    $request->session()->flash('product_image', 'Image format not supported');

                }

            }

            if ( $this->product->save()) {
                $request->session()->flash('message', 'Product updated');
            } else {
                $request->session()->flash('error', 'Something went wrong');
            }

            return redirect('admin/product');
        }

    }

    public function deleteProduct(Request $request, $id)
    {
        $this->Product = Product::find($id);
        if (!empty($this->Product)) {
            $this->Product->delete();
            $request->session()->flash('message', 'Product deleted successfully');
        } else {
            $request->session()->flash('error', 'Product does not exist');
        }

        return redirect('admin/product');
    }
}
