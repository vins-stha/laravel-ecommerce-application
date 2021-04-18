<?php

namespace App\Http\Controllers;

use App\Product_brand;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->brands = Product_brand::all();

        return view('brands.brands',['brands' => $this->brands]);
    }

    public function  addBrand(Request $request)
    {
        if($request->getMethod() == "POST")
        {
            if(isset($request['brand_name']) && !empty($request['brand_name']))
            {
                $request->validate([
                    'brand_name' =>'required',

                ]);
                $this->brand = new Product_brand();
                $this->brand->name = $request['brand_name'];
                var_dump( $request->hasFile('brand_logo'));
                if( $request->hasFile('brand_logo'))
                {
                    $image = $request->file('brand_logo');
                    $name = time().'.'.$image->extension();
                    $image->storeAs('/public/images/brands/',$this->brand->name);
                    $this->brand->brand_logo = $name;
                    var_dump($this->brand);

                }


                if ($this->brand->save())
                {
                    $request->session()->flash('message', 'new Brand successfully added');
                    return redirect('admin/brands');
                }
                else
                {
                    $request->session()->flash('error', 'Something went wrong');
                    return redirect('admin/brands');
                }
            }
        }
        else
        {   $this->brands = Product_brand::all();

            return view('brands.addBrands',['brands' => $this->brands]);
        }
    }

    public function  editBrand(Request $request,$id='')
    {
        if($request->getMethod() == "POST")
        { var_dump($request->post());
            if(isset($request['brand_name']) && !empty($request['brand_name']))
            {
                $request->validate([
                    'brand_name' =>'required',
                ]);

                $this->brand = Product_brand::find($request['id']);
                $this->brand->name = $request['brand_name'];

                var_dump( $request->file('brand_logo'));
               // dd($request->hasFile('brand_logo'));
                if( $request->hasFile('brand_logo'))
                {
                    $image = $request->file('brand_logo');
                    $name = time().'.'.$image->extension(); var_dump($name);
                    $image->storeAs('/public/images/brands/',$this->brand->name);
                    $this->brand->brand_logo = $name;

                }


                if ($this->brand->save())
                {
                    $request->session()->flash('message', ' brand successfully updated');
                    return redirect('admin/brands');
                }
                else
                {
                    $request->session()->flash('error', 'Something went wrong');
                    return redirect('admin/brands');
                }
            }
        }
        else
        {
            $this->brand = Product_brand::find($id);
            if( $this->brand != null)
            {
                return view('brands.editBrand',['brand' => $this->brand]);
            }
            else
            {
                $request->session()->flash('error', 'Item not found ');
                return redirect('admin/brands');
            }

        }
    }

    public function deleteBrand(Request $request, $id)
    {
        $this->brand = Product_brand::find($id);
        if (!empty($this->brand)) {
            $this->brand->delete();
            $request->session()->flash('message', 'brand deleted successfully');
        } else {
            $request->session()->flash('error', 'brand does not exist');
        }

        return redirect('admin/brands');
    }
}
