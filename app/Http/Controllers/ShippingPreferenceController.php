<?php

namespace App\Http\Controllers;

use App\ShippingPreference;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class ShippingPreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating shipping preferences
        $shippingPreferences = ShippingPreference::paginate(15);
        $previousPageUrl = $shippingPreferences->previousPageUrl();//previous page url
        $nextPageUrl = $shippingPreferences->nextPageUrl();//next page url
        $lastPage = $shippingPreferences->lastPage(); //Gives last page number
        $total = $shippingPreferences->total();
        return view('admin.ShippingPreferences.index')->with(['shippingPreferences'=>$shippingPreferences,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view
        return view('admin.ShippingPreferences.create');
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
            'name' => 'required'
        ]);

        //Creating shipping preferences and go back to index.
        $input = $request->all();
        ShippingPreference::create($input);
        return Redirect::to('shipping-preferences')->with('message', 'Your details have been added.');
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
        $shippingPreference = ShippingPreference::findOrFail($id);
        return view('admin.ShippingPreferences.edit')->with('shippingPreference', $shippingPreference);
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
        //Updating shipping preference.
        $shippingPreference = ShippingPreference::findOrFail($id);

        //Validations
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        if(!isset($input['is_active'])){
            $input['is_active'] = 0;
        }
        $shippingPreference->fill($input)->save();

        // redirect to index page
        return Redirect::to('shipping-preferences')->with('message', 'Your details have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete shipping preference
        $shippingPreference = ShippingPreference::find($id);
        $shippingPreference->delete();

        // redirect to index page
        return Redirect::to('shipping-preferences')->with('message', 'Your details have been updated.');
    }
}
