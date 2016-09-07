<?php

namespace App\Http\Controllers;

use App\QualityStandards;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class QualityStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating quality standards.
        $qualityStandards = QualityStandards::paginate(15);
        $previousPageUrl = $qualityStandards->previousPageUrl();//previous page url
        $nextPageUrl = $qualityStandards->nextPageUrl();//next page url
        $lastPage = $qualityStandards->lastPage(); //Gives last page number
        $total = $qualityStandards->total();
        return view('admin.QualityStandards.index')->with(['qualityStandards'=>$qualityStandards,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view
        return view('admin.QualityStandards.create');
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

        //Creating quality standard and go back to index.
        $input = $request->all();
        QualityStandards::create($input);
        return Redirect::to('quality-standards')->with('message', 'Your details have been added.');
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
        $qualityStandard = QualityStandards::findOrFail($id);
        return view('admin.QualityStandards.edit')->with('qualityStandard', $qualityStandard);
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
        //Updating quality standards.
        $qualityStandard = QualityStandards::findOrFail($id);

        //Validations
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        if(!isset($input['is_active'])){
            $input['is_active'] = 0;
        }
        $qualityStandard->fill($input)->save();

        // redirect to index page
        return Redirect::to('quality-standards')->with('message', 'Your details have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete quality standard
        $qualityStandard = QualityStandards::find($id);
        $qualityStandard->delete();

        // redirect to index page
        return Redirect::to('quality-standards')->with('message', 'Your details have been deleted.');
    }
}
