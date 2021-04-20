<?php

namespace App\Http\Controllers;

use App\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas ['categories'] = DB::table('product_categories')->get();

        foreach ($datas['categories'] as $category)
        {
            $category->products = DB::table('products')
                                                    ->where(['category_id' => $category->id] )
                                                    ->get();
        }
        $datas['brands'] = DB::table('product_brands')->get();

        return view('frontend.index',['datas' => $datas]);
    }

    public function productView(Request $request, $id)
    {
        $datas ['categories'] = DB::table('product_categories')->get();
        $datas['product'] = DB::table('products')
            ->where(['id' => $id])
            ->get();
        $this->category_id = $datas['product'][0]->category_id;

        $datas['related_products'] = DB::table('products')
            ->where(['category_id'=>$this->category_id])
            ->where('id','!=',$id)
            ->get();

        $datas['brands'] = DB::table('product_brands')->get();

        return view('frontend.single-product', ['datas' => $datas]);
    }

    public function addToCart(Request $request)
    {// dd($request->post());
        if($request->session()->has('LOGGED_IN') == true)
        {
            $user_id = $request->session()->get('USER_ID');
            $registered = 1;
        }
        else
        {
            $registered = 0;
            $user_id = getUserTempId();
        }

        //check if datas exist or not
        $result = DB::table('cart')
            ->where(['user_id' => $user_id ])
            ->where(['product_id' => $request->post('product_id') ])
            ->get();

        if($request->post('product_quantity') == 0 )
        {
            $res = DB::table('cart')
                ->where(['user_id' => $user_id])
                ->where([ 'product_id' => $request->post('product_id')])

                ->delete();
            $success = $res == 1 ? "Deleted successfully" : "Something went wrong could not delete the item";
        }
        else
        {
            //if item does not exist
            if (isset($result) && count($result) > 0)
            {
                $res = DB::table('cart')
                    ->where(['id' => $result[0]->id])
                    ->update([
                        'product_quantity' => $request->post('product_quantity')
                    ]);
                $success = $res == 1 ? "Updated successfully" : "The item already exists";
            }
            else
            {
                $id = DB::table('cart')->insertGetId([
                    'user_id' => $user_id,
                    'registered' => $registered,
                    'product_id' => $request->post('product_id'),
                    'product_quantity' => $request->post('product_quantity'),
                    'added_on' => date('Y-m-d h:i:s'),
                ]);
                $success = $id == null ? "Something went wrong 234" : "Added successfully";
            }
        }
        $allCartItems = populateCartItems();
        echo json_encode($success) ;
        //return json_encode($allCartItems);
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function myCart(Request $request)
    {
        $datas['brands'] = DB::table('product_brands')->get();
        $datas ['categories'] = DB::table('product_categories')->get();
        if($request->session()->has('LOGGED_IN') == true)
        {
            $user_id = $request->session()->get('USER_ID');
        }
        else
        {
            $user_id = getUserTempId();
        }

        $cartItems = DB::table('cart')
            ->leftJoin('products', 'products.id','=','cart.product_id')
            ->where(['user_id' => $user_id])
            ->select('cart.product_quantity','cart.product_id', 'products.name', 'products.category_id', 'products.price', 'products.image')
            ->get();

        return view('frontend.cart', [
            'datas' => $datas,
            'cart_items' => $cartItems
            ]);
    }

    public function categoryView(Request $request, $id)
    {   var_dump($id);
        $datas['filterOption'] = "";

        $categoryView = DB::table('products');

        $categoryView= $categoryView->where(['category_id' => $id]);
        if ($request->get('sortOrder') !== null)
        {
            $filterBy = $request->get('sortOrder');
            switch ($filterBy)
            {
                case 'price_ascending': $categoryView =  $categoryView->orderBy('products.price','asc');
                                        $datas['filterOption'] = 'Price Ascending';
                    break;
                case 'price_descending':  $categoryView =  $categoryView->orderBy('products.price','desc');
                                $datas['filterOption'] = 'Price Descending';
                    break;
                case 'name':  $categoryView =  $categoryView->orderBy('products.name','desc');
                                $datas['filterOption'] = 'Name';
                    break;
                case 'date':  $categoryView =  $categoryView->orderBy('products.created_at','asc');
                                $datas['filterOption'] = 'Date';
                    break;
                default:
                    break;
            }
            $datas['filterOrder'] = $filterBy;
        }
        $categoryView = $categoryView->get();
        $datas['brands'] = DB::table('product_brands')->get();
        $datas ['categories'] = DB::table('product_categories')->get();



       // dd($categoryView);
        return view('frontend.categoryView',[
            'datas' => $datas,
            'categoryProducts' => $categoryView
        ]);
    }

    public function search(Request $request)
    {
        var_dump($request->post('sortSearchResultsBy'));
        $datas['brands'] = DB::table('product_brands')->get();
        $datas ['categories'] = DB::table('product_categories')->get();
        $datas['searchResults'] = '';
        $datas['filterOption'] = '';
        $searchTerm = '';

        if($request->get('searchTerm') !== null)
        {
            $searchTerm =  $request->get('searchTerm');

            $searchItems = DB::table('products');
            $searchItems = $searchItems->where('name', 'LIKE', "%$searchTerm%");
            $searchItems = $searchItems->orwhere('description', 'LIKE', "%$searchTerm%");

            if ($request->post('sortSearchResultsBy') !== null)
            {
                $filterBy = $request->post('sortSearchResultsBy');
                switch ($filterBy)
                {
                    case 'price_ascending': $categoryView =  $searchItems->orderBy('products.price','asc');
                        $datas['filterOption'] = 'Price Ascending';
                        break;
                    case 'price_descending':  $categoryView =  $searchItems->orderBy('products.price','desc');
                        $datas['filterOption'] = 'Price Descending';
                        break;
                    case 'name':  $categoryView =  $searchItems->orderBy('products.name','desc');
                        $datas['filterOption'] = 'Name';
                        break;
                    case 'date':  $categoryView =  $searchItems->orderBy('products.created_at','asc');
                        $datas['filterOption'] = 'Date';
                        break;
                    default:
                        break;
                }

            }

            $searchItems = $searchItems->get();

            if ($searchItems !== null)
            {
                $datas['searchResults'] = $searchItems;
            }
            else
            {
                $datas['searchResults'] = '';
            }
        }
        else
        {
            $searchItems = DB::table('products');
            //->select('select name, image, price, description')

            if ($request->post('sortSearchResultsBy') !== null) {
                $filterBy = $request->post('sortSearchResultsBy');
                switch ($filterBy) {
                    case 'price_ascending':
                        $categoryView = $searchItems->orderBy('products.price', 'asc');
                        $datas['filterOption'] = 'Price Ascending';
                        break;
                    case 'price_descending':
                        $categoryView = $searchItems->orderBy('products.price', 'desc');
                        $datas['filterOption'] = 'Price Descending';
                        break;
                    case 'name':
                        $categoryView = $searchItems->orderBy('products.name', 'desc');
                        $datas['filterOption'] = 'Name';
                        break;
                    case 'date':
                        $categoryView = $searchItems->orderBy('products.created_at', 'asc');
                        $datas['filterOption'] = 'Date';
                        break;
                    default:
                        break;
                }
            }

            $searchItems = $searchItems->get();
            $datas['searchResults'] = $searchItems;

        }
        $datas['searchTerm'] = $searchTerm;


        return view('frontend.searchResults',[
            'datas' => $datas,

        ]);



    }

}
