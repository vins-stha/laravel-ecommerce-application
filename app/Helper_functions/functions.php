<?php
use Illuminate\Support\Facades\DB;
function getUserTempId()
{
    //check if user has already some id
    if(session()->has('USER_TEMP_ID') == null)
    {
       return session()->put('USER_TEMP_ID', rand(101,99999));
    }
    else
    {
        return session()->get('USER_TEMP_ID');
    }

}


function populateCartItems()
{
    $user_id = getUserTempId();
    $allCartItems =  DB::table('cart')
        ->leftJoin('products', 'products.id','=','cart.product_id')
        ->where(['user_id' => $user_id])
        ->select('cart.product_quantity','cart.product_id', 'products.name', 'products.category_id', 'products.price', 'products.image')
        ->get();

    return $allCartItems;

}
