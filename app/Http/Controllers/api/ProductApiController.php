<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Random;

class ProductApiController extends Controller
{
    public function fixImage(product $product)
    {
        if (Storage::disk('public')->exists($product->image)) {
            $product->image = Storage::url($product->image);
        } else {
            $product->image = '/img/no_image_placeholder.png';
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pro = Product::all();
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

    public function search(request $request)
    {
        if ($request->categoryid == null || $request->categoryid == "" || $request->categoryid == 0) {
            $pro = Product::all();
        } else {
            $pro = Product::where('Category_Id', '=', $request->categoryid)->get();
        }
        foreach ($pro as $p) {
            $this->fixImage($p);
        }
        return response([
            'lstpro' => $pro
        ]);
    }


    public function addMessage(request $request)
    {
        $pro = new Product();
        $ran = rand(1, 100);
        $pro->fill([
            'name' => $request->content,
            'info' => "series" . $ran,
            'image' => "",
            'Price' => $ran,
            'Stock' => $ran,
            'Category_Id' => 1
        ]);
        $pro->save();
        $prolst = Product::all();
        return Response([
            'results' => $prolst
        ]);
    }
}
