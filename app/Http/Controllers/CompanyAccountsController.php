<?php

namespace App\Http\Controllers;

use App\CompanyAccount;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class CompanyAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating company accounts
        $accounts = CompanyAccount::paginate(15);
        $previousPageUrl = $accounts->previousPageUrl();//previous page url
        $nextPageUrl = $accounts->nextPageUrl();//next page url
        $lastPage = $accounts->lastPage(); //Gives last page number
        $total = $accounts->total();
        return view('admin.CompanyAccounts.index')->with(['accounts'=>$accounts,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view.
        return view('admin.CompanyAccounts.create');
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
            'number_of_licenses_allowed' => 'required',
            'photos_allowed' => 'required'
        ]);

        //Creating accreditations and go back to index.
        $input = $request->all();
        CompanyAccount::create($input);
        return Redirect::to('company-packages')->with('message', 'Your account status has changed.');
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
        $companyAccount = CompanyAccount::findOrFail($id);
        return view('admin.CompanyAccounts.edit')->with('companyAccount', $companyAccount);
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
        //Updating Company account
        $companyAccount = CompanyAccount::findOrFail($id);

        //Validations
        $this->validate($request, [
            'name' => 'required',
            'number_of_licenses_allowed' => 'required',
            'photos_allowed' => 'required'
        ]);

        $input = $request->all();
        $companyAccount->fill($input)->save();

        // redirect to index page
        return Redirect::to('company-packages')->with('message', 'Your account status has changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Company Accounts
        $companyAccount = CompanyAccount::find($id);
        $companyAccount->delete();

        // redirect to index page
        return Redirect::to('company-packages')->with('message', 'Your account status has changed.');
    }
}
