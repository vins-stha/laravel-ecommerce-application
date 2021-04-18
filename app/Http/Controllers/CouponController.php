<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $this->coupons = Coupon::all();
        return view('Coupon.coupons', ['coupons' => $this->coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCoupon(Request $request)
    {
        if ($request->getMethod() === "GET") {
            return view('coupon.addCoupon');
        }
        if ($request->getMethod() === "POST") {
            $request->validate([
                'coupon_name' => 'unique:coupons',
                'coupon_code' => 'unique:coupons',

            ]);

            if (isset($request['coupon_name']) && !empty($request['coupon_name'])) {
                $new_Coupon = new Coupon();

                $new_Coupon->coupon_name = $request['coupon_name'];
                $new_Coupon->coupon_code = !empty($request['coupon_code']) ? strtoupper($request['coupon_code']) : strtoupper($new_Coupon->coupon_name);
                $new_Coupon->coupon_value = $request['coupon_value'];
                $new_Coupon->valid_from = $request['valid_from'];
                $new_Coupon->valid_till = $request['valid_till'];

                if ($new_Coupon->save()) {
                    $request->session()->flash('message', 'New product Coupon successfully added');
                    return redirect('admin/coupon');
                }

            }
        }

    }

    /**
     * @param Request $request
     * @param $id
     *
     */
    public function editCoupon(Request $request, $id = "")
    {
        if ($request->getMethod() === "GET") {
            $this->Coupon = Coupon::find($id);
            return view('Coupon.editCoupon', ['coupon' => $this->Coupon]);
        }

        if ($request->getMethod() === "POST") {
            $this->Coupon = Coupon::find($request->post('coupon_id'));

            $this->Coupon->coupon_name = $request->post('coupon_name');
            $this->Coupon->coupon_code = $request->post('coupon_code');
            $this->Coupon->coupon_value = $request['coupon_value'];
            $this->Coupon->valid_from = $request['valid_from'];
            $this->Coupon->valid_till = $request['valid_till'];

            if ($this->Coupon->save()) {
                $request->session()->flash('message', 'Coupon updated');
            } else {
                $request->session()->flash('error', 'Something went wrong');
            }

            return redirect('admin/coupon');
        }

    }

    public function deleteCoupon(Request $request, $id)
    {
        $this->Coupon = Coupon::find($id);
        if (!empty($this->Coupon)) {
            $this->Coupon->delete();
            $request->session()->flash('message', 'Coupon deleted successfully');
        } else {
            $request->session()->flash('error', 'Coupon does not exist');
        }

        return redirect('admin/coupon');
    }
}
