<?php

namespace App\Http\Controllers;

use App\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        if ($request->getMethod() === "POST") {
            $email = $request->post('email');
            $password = $request->post('password');

            $user = Administrator::where(['email' => $email])->first();


            if (Hash::check($password, $user->password)) {
                var_dump($user->id);
                $request->session()->put('ADMIN_LOGGED', TRUE);
                $request->session()->put('ADMIN_ID', $user->id);

                return redirect('admin/dashboard');

            } else {
                $request->session()->flash('error', 'Please check your Username or password');
                return redirect('admin');
            }
        }
    }

    /**
     * @param Request $request
     *
     */
    public function dashboard(Request $request)
    {
        return view('admin.dashboard');
    }

    /**
     * @param Request $request
     *
     */
    public function category(Request $request)
    {
        return view('admin.category');
    }

    /**
     * @param Request $request
     *
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->flash('message', 'Logout was successful');
        return redirect('admin/');
    }

}
