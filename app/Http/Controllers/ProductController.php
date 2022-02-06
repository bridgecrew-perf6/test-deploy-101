<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
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

        $pro = product::all();
        foreach ($pro as $p) {
            $this->fixImage($p);
        }
        return view('home_product', [
            'pro' => $pro,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $proT = category::all();
        return view('product_create', [
            'proT' => $proT
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
        $request->validate([
            'name' => 'required',
            'Stock' => 'required',
            'Price' => 'required',
            'prot' => 'required'
        ], [
            'name.required' => 'Name Empty!',
            'Stock.required' => 'Stock Empty!',
            'Price.required' => 'Price Empty!',
            'prot.required' => 'ProductType not Selected!'
        ]);

        $product = new product();
        $product->fill([
            'name' => $request->input('name'),
            'info' => $request->input('info'),
            'Stock' => $request->input('Stock'),
            'Price' => $request->input('Price'),
            'image' => '',
            'Category_Id' => $request->input('prot')
        ]);
        $product->save();
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('images/sp/' . $product->id, 'public');
        }
        $product->save();
        return Redirect::route('product.show', ['product' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
        $this->fixImage($product);
        return view('product_show', ['pro' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        // Gate::authorize('update-product');
        //
        $this->fixImage($product);
        $proT = category::all();
        return view('product_edit', [
            'pro' => $product,
            'proT' => $proT
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        // $response = Gate::inspect('update-product');   // cách này dùng chung cho route-group
        // if ($response->allowed()) {
        //     if ($request->hasFile('image')) {
        //         $product->image = $request->file('image')->store('images/sp/' . $product->id, 'public');
        //     }

        //     $product->fill([
        //         'name' => $request->input('name'),
        //         'info' => $request->input('info'),
        //         'Stock' => $request->input('Stock'),
        //         'Price' => $request->input('Price'),
        //         'Category_Id' => $request->input('prot')
        //     ]);

        //     $product->save();
        //     return Redirect::route('product.show', ['product' => $product]);
        // } else {
        //     echo $response->message();
        // }
        //
        if ($request->user()->cannot('update', $product)) {  //policy dùng cho từng route cụ thể
            echo '<script> alert("Errors") </script>';
        } else {
            if ($request->hasFile('image')) {
                $product->image = $request->file('image')->store('images/sp/' . $product->id, 'public');
            }

            $product->fill([
                'name' => $request->input('name'),
                'info' => $request->input('info'),
                'Stock' => $request->input('Stock'),
                'Price' => $request->input('Price'),
                'Category_Id' => $request->input('prot')
            ]);

            $product->save();
            return Redirect::route('product.show', ['product' => $product]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
        $product->delete();
        return Redirect::route('product.index');
    }
}
