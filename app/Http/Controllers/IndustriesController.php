<?php

namespace App\Http\Controllers;

use App\Industry;
use App\MarketplaceProductIndustries;
use App\QuoteIndustries;
use App\User;
use App\UserDetails;
use App\UserAdditionalIndustries;
use App\Quotes;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class IndustriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating industries
        $industries = Industry::paginate(15);
        $previousPageUrl = $industries->previousPageUrl();//previous page url
        $nextPageUrl = $industries->nextPageUrl();//next page url
        $lastPage = $industries->lastPage(); //Gives last page number
        $total = $industries->total();
        return view('admin.Industries.index')->with(['industries'=>$industries,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view.
        return view('admin.Industries.create');
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
        Industry::create($input);
        return Redirect::to('industries')->with('message', 'Your entry has been added.');
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
        $industry = Industry::findOrFail($id);
        return view('admin.Industries.edit')->with('industry', $industry);
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
        //Updating Industries
        $industry = Industry::findOrFail($id);

        //Validations
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        if(!isset($input['is_active'])){
            $input['is_active'] = 0;
        }
        $industry->fill($input)->save();

        // redirect to index page
        return Redirect::to('industries')->with('message', 'Selected entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Industry
        $industry = Industry::find($id);
        $industry->delete();

        // redirect to index page
        return Redirect::to('industries')->with('message', 'Selected entry has been updated.');
    }

    public function viewIndustries()
    {
        //Paginating industries
        $industries = Industry::paginate(15);
        $previousPageUrl = $industries->previousPageUrl();//previous page url
        $nextPageUrl = $industries->nextPageUrl();//next page url
        $lastPage = $industries->lastPage(); //Gives last page number
        $total = $industries->total();
        return view('admin.Industries.viewIndustries')->with(['industries'=>$industries,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    public function userIndustries()
    {
        $users = User::orderBy('id','desc')->get();
        $finalArray = array();
        foreach($users as $user){
            $industryArray = array();
            $user_id = $user->id;
            $industryArray['user_name'] = $user->name;
            $userData = UserDetails::where('user_id',$user_id)->first();
            if($userData->industry_id != '' || $userData->industry_id != NULL)

            {

                $userIndustry = Industry::find($userData->industry_id);

                $industryArray['industry_name'] = $userIndustry->name;

            }

            else

            {

                $industryArray['industry_name'] = '';

            }

            $additionalIndustries = UserAdditionalIndustries::where('user_id',$user_id)->get();
            if(!empty($additionalIndustries)){
                foreach($additionalIndustries as $additional){
                    $additionalIndustryArray = array();
                    $userIndustry = Industry::find($additional->industry_id);

                    $additionalIndustryArray['additional'] = $userIndustry->name;

                    $industryArray['additional_industry'][] = $additionalIndustryArray;
                }
            }else{
                $additionalIndustryArray['additional'] = '';

                $industryArray['additional_industry'][] = $additionalIndustryArray;
            }

            $finalArray[] = $industryArray;
        }

        return view('admin.Industries.userIndustries')->with(['finalArray'=>$finalArray]);
    }

    public function productIndustries()
    {
        //Paginating industries
        $industries = Industry::paginate(15);
        foreach($industries as $industry){
            $industry->countOfproducts = MarketplaceProductIndustries::where('industry_id',$industry->id)->count();
        }

        $previousPageUrl = $industries->previousPageUrl();//previous page url
        $nextPageUrl = $industries->nextPageUrl();//next page url
        $lastPage = $industries->lastPage(); //Gives last page number
        $total = $industries->total();
        return view('admin.Industries.productIndustries')->with(['industries'=>$industries,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    public function quoteIndustries()
    {
        $industries = Industry::paginate(15);
        $quotesArray = array();
        foreach($industries as $industry){
            $industryArray = array();
            $industryArray['industry_name'] = $industry->name;
            $quoteIndustry = QuoteIndustries::where('industry_id',$industry->id)->get()->toArray();
            if(!empty($quoteIndustry))
            {
                foreach($quoteIndustry as $quote){
                    $dataArray = array();
                    $dataArray['quote_name'] = Quotes::find($quote['quote_id'])->title;

                    $industryArray['quoteIndustry'][] = $dataArray;
                }
            }else{
                $industryArray['quoteIndustry'] = '';
            }
            $quotesArray[] = $industryArray;
        }

        $previousPageUrl = $industries->previousPageUrl();//previous page url
        $nextPageUrl = $industries->nextPageUrl();//next page url
        $lastPage = $industries->lastPage(); //Gives last page number
        $total = $industries->total();
        return view('admin.Industries.quoteIndustries')->with(['industries'=>$industries,'quotesArray'=>$quotesArray,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

}
