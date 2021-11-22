<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
        }
        $crads = $request->except('_token');

//        Auth::attempt($crads)
//        \auth()->attempt($crads)
        if (\auth()->attempt($crads)) {
            if (auth()->user()->role == 'admin'){
                return redirect()->route('dashboard');
            }
            return redirect()->route('home');
        }
        return redirect()->back();
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
