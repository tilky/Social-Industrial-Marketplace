<?php

namespace App\Http\Controllers;

use App\Accreditation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class AccreditationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating accrediations
        $accrediations = Accreditation::paginate(15);
        $previousPageUrl = $accrediations->previousPageUrl();//previous page url
        $nextPageUrl = $accrediations->nextPageUrl();//next page url
        $lastPage = $accrediations->lastPage(); //Gives last page number
        $total = $accrediations->total();
        return view('admin.Accreditations.index')->with(['accrediations'=>$accrediations,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view.
        return view('admin.Accreditations.create');
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
        Accreditation::create($input);
        return Redirect::to('accreditations')->with('message', 'Your account details have been changed.');
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
        $accreditation = Accreditation::findOrFail($id);
        return view('admin.Accreditations.edit')->with('accreditation', $accreditation);
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
        //Updating Accreditation
        $accreditation = Accreditation::findOrFail($id);

        //Validations
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        if(!isset($input['is_active'])){
            $input['is_active'] = 0;
        }
        $accreditation->fill($input)->save();

        // redirect to index page
        return Redirect::to('accreditations')->with('message', 'Your account details have been changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Accreditation
        $accreditation = Accreditation::find($id);
        $accreditation->delete();

        // redirect to index page
        return Redirect::to('accreditations')->with('message', 'Your account details have been changed.');
    }
}
