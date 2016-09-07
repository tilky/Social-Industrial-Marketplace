<?php

namespace App\Http\Controllers;

use App\TechService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class TechServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating tech services.
        $techServices = TechService::paginate(15);
        $previousPageUrl = $techServices->previousPageUrl();//previous page url
        $nextPageUrl = $techServices->nextPageUrl();//next page url
        $lastPage = $techServices->lastPage(); //Gives last page number
        $total = $techServices->total();
        return view('admin.TechService.index')->with(['techServices'=>$techServices,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view.
        return view('admin.TechService.create');
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

        //Creating tech service and go back to index.
        $input = $request->all();
        TechService::create($input);
        return Redirect::to('tech-service')->with('message', 'The industrial service has been added.');
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
        $techService = TechService::findOrFail($id);
        return view('admin.TechService.edit')->with('techService', $techService);
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
        //Updating tech services.
        $techService = TechService::findOrFail($id);

        //Validations
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        if(!isset($input['is_active'])){
            $input['is_active'] = 0;
        }
        $techService->fill($input)->save();

        // redirect to index page
        return Redirect::to('tech-service')->with('message', 'The selected industrial service has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete tech service
        $techService = TechService::find($id);
        $techService->delete();

        // redirect to index page
        return Redirect::to('tech-service')->with('message', 'The selected industrial service has been deleted.');
    }
}
