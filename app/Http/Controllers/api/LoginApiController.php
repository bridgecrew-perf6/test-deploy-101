<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pro = User::all();
        return Response([
            'results' => $pro
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function login(request $request)
    {
        // $check = $request -> validate([
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response([
                'sucess' => 'true',
                'result' => Auth::user()
            ]);
        } else {
            return response([
                'sucess' => 'false'
            ]);
        }
    }

    public function register(request $request)
    {
        $pro = new User();
        $password = bcrypt($request->password);
        $request->merge(['password' => $password]);
        $pro->fill([
            'name' => $request->fullname,
            'email' => $request->username,
            'password' => $request->password
        ]);
        $pro->save();
        return response([
            'sucess' => 'true'
        ]);
    }
}
