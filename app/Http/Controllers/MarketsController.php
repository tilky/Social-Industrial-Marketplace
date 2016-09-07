<?php

namespace App\Http\Controllers;

use App\Markets;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class MarketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating markets
        $markets = Markets::paginate(15);
        $previousPageUrl = $markets->previousPageUrl();//previous page url
        $nextPageUrl = $markets->nextPageUrl();//next page url
        $lastPage = $markets->lastPage(); //Gives last page number
        $total = $markets->total();
        return view('admin.Markets.index')->with(['markets'=>$markets,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view.
        return view('admin.Markets.create');
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

        //Creating accreditations and go back to index.
        $input = $request->all();
        Markets::create($input);
        return Redirect::to('markets')->with('message', 'Your market listing has posted.');
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
        $market = Markets::findOrFail($id);
        return view('admin.Markets.edit')->with('market', $market);
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
        //Updating Markets
        $market = Markets::findOrFail($id);

        //Validations
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        if(!isset($input['is_active'])){
            $input['is_active'] = 0;
        }
        $market->fill($input)->save();

        // redirect to index page
        return Redirect::to('markets')->with('message', 'Your market listing has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Markets
        $market = Markets::find($id);
        $market->delete();

        // redirect to index page
        return Redirect::to('markets')->with('message', 'Your market listing has been deleted.');
    }
}
