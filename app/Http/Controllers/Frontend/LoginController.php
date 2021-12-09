<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'name'=>'required|min:3',
            'phone'=>'required|min:11',
            'address'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|confirmed',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
        }
        $inputs = [
          'name'=>$request->input('name'),
          'email'=>$request->input('email'),
          'address'=>$request->input('address'),
          'phone'=>$request->input('phone'),
          'password'=>Hash::make($request->input('password')),
        ];
        User::create($inputs);
        Session::flash('message','Registration Successful!');
        Session::flash('alert','success');
        return redirect()->route('login');
    }

    public function profile()
    {
        return view('frontend.profile');
    }

    public function updateProfile(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'name'=>'required|min:3',
            'phone'=>'required|min:11',
            'address'=>'required',
            'photo'=>'image',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
        }
        $user = auth()->user();
        $inputs = [
            'name'=>$request->input('name'),
            'address'=>$request->input('address'),
            'phone'=>$request->input('phone'),
        ];
        if (file_exists($request->file('photo'))) {
            if (file_exists('uploads/users/' . $user->photo)) {
                unlink('uploads/users/' . $user->photo);
            }
            $newName = 'user_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('uploads/users/', $newName);
            $inputs['photo'] = $newName;
        }
        $user->update($inputs);
        return redirect()->back();
    }

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
            Session::flash('message','Login Successful!');
            Session::flash('alert','success');
            return redirect()->route('home');
        }
        Session::flash('message','Wrong password!');
        Session::flash('alert','danger');
        return redirect()->back();
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
