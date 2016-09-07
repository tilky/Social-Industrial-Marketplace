<?php

namespace App\Http\Controllers;

use App\Diversity;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class DiversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating deversity
        $diversities = Diversity::paginate(15);
        $previousPageUrl = $diversities->previousPageUrl();//previous page url
        $nextPageUrl = $diversities->nextPageUrl();//next page url
        $lastPage = $diversities->lastPage(); //Gives last page number
        $total = $diversities->total();
        return view('admin.Diversity.index')->with(['diversities'=>$diversities,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view.
        return view('admin.Diversity.create');
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
        Diversity::create($input);
        return Redirect::to('diversity')->with('message', 'Your entry has been added.');
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
        $diversity = Diversity::findOrFail($id);
        return view('admin.Diversity.edit')->with('diversity', $diversity);
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
        //Updating Diversity
        $diversity = Diversity::findOrFail($id);

        //Validations
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        if(!isset($input['is_active'])){
            $input['is_active'] = 0;
        }
        $diversity->fill($input)->save();

        // redirect to index page
        return Redirect::to('diversity')->with('message', 'The selected entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Diversity
        $diversity = Diversity::find($id);
        $diversity->delete();

        // redirect to index page
        return Redirect::to('diversity')->with('message', 'The selected entry has been deleted.');
    }
}
