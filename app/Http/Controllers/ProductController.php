<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating products
        $products = Product::paginate(15);
        $previousPageUrl = $products->previousPageUrl();//previous page url
        $nextPageUrl = $products->nextPageUrl();//next page url
        $lastPage = $products->lastPage(); //Gives last page number
        $total = $products->total();
        return view('admin.Products.index')->with(['products'=>$products,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view.
        return view('admin.Products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validations
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required'
        ]);

        //Creating accreditations and go back to index.
        $input = $request->all();
        Product::create($input);
        return Redirect::to('products')->with('message', 'Your market listing has posted.');
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
    public function edit($id)
    {
        //Open form in edit mode.
        $product = Product::findOrFail($id);
        return view('admin.Products.edit')->with('product', $product);
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
        //Updating Products
        $product = Product::findOrFail($id);

        //Validations
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required'
        ]);

        $input = $request->all();
        if(!isset($input['is_active'])){
            $input['is_active'] = 0;
        }
        $product->fill($input)->save();

        // redirect to index page
        return Redirect::to('products')->with('message', 'Your market listing details have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Products
        $product = Product::find($id);
        $product->delete();

        // redirect to index page
        return Redirect::to('products')->with('message', 'Your market listing has been deleted.');
    }


    public function viewProducts()
    {
        //Paginating products
        $products = Product::paginate(15);
        $previousPageUrl = $products->previousPageUrl();//previous page url
        $nextPageUrl = $products->nextPageUrl();//next page url
        $lastPage = $products->lastPage(); //Gives last page number
        $total = $products->total();
        return view('admin.Products.viewProducts')->with(['products'=>$products,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }
}
