<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //
    public function login(request $request)
    {
        return view('login');
    }

    public function login_post(request $request)
    {
        $check = $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);

        // $check = $request -> validate([
        if (Auth::attempt($check, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('product');
        }
        return back()->withErrors([
            'email' => 'Lỗi',
        ]);
    }

    public function logout(request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    public function testquantity()
    {
        $cart = Cart::all();
        return view('test', [
            'cart' => $cart
        ]);
    }

    public function testquantity_post(request $request)
    {
        $cart = Cart::all();

        for ($i = 0; $i < count($cart); $i++) {
            $cart[$i]->fill([
                'quantity' => $request->quantity[$i]
            ]);
            $cart[$i]->save();
        }
        return redirect()->route('test');
    }
}
