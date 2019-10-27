<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\CreateProductsRequest;
use App\Http\Requests\Products\UpdateProductsRequest;
use App\Product;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index')->with('products', Product::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductsRequest $request)
    {
        //Upload the image to storage
        $image = $request->file('image');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('uploads/products'), $imageName);

        //Insert the product
        $product = Product::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'image'         => 'uploads/products/'.$imageName,
            'price'         => $request->price,
        ]);

        //Flash message
        session()->flash('success', 'Product added successfully');

        //redirect user
        return redirect(route('products.index'));
        
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.create', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, Product $product)
    {
        //check if has new image
        if ($request->hasFile('image')) {
            //Delete old one
            $product->deleteImage();
            $image = $request->file('image');
            $imageName = time().$image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $product->update([
                'image'          => 'uploads/products/'.$imageName,
            ]);
        }

        //Insert the product
        $product->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
        ]);

        //Flash message
        session()->flash('success', 'Product Updated successfully');

        //redirect user
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->deleteImage();
        $product->delete();

        session()->flash('success','Product Deleted Successfully');

        return redirect(route('products.index'));
    }
}
