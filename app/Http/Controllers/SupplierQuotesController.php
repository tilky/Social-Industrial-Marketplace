<?php

namespace App\Http\Controllers;

use App\Quotes;
use App\SupplierQuotes;
use App\SupplierQuoteItems;
use App\UserDetails;
use App\Endorsements;
use App\Reviews;
use App\Company;
use App\User;
use App\SupplierIgnoreQuotes;
use App\SupplierLeads;
use App\SupplierLeadIndustries;
use App\SupplierLeadCategories;
use App\QuoteIndustries;
use App\QuoteCategories;
use App\SubscriptionPlans;
use App\SupplierDumpItems;
use App\SupplierQuoteUnique;
use App\Subscriptions;
use App\BuyerIgnoreQuotes;
use App\Category;
use App\TechnicalSpecificationOptions;
use App\UsersActivity;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Input;
use Auth;
use Response;
use Session;
use Mail;

class SupplierQuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $user_access_level = Auth::user()->access_level;

        $userQuotes = Quotes::where('created_by',$user_id)->get();

        $BuyerIgnoreQuotes = BuyerIgnoreQuotes::where('buyer_id',$user_id)->get();
        $result = array();
        foreach($BuyerIgnoreQuotes as $ignoreQoute)
        {
            $result[] = $ignoreQoute['supplier_quote_id'];
        }
        $current_quote_id = '';
        if(isset($_GET['quote_id']))
        {
            $quote_id = $_GET['quote_id'];
            $current_quote_id = $quote_id;
            $SupplierQuotes = SupplierQuotes::whereNotIn('id',$result)->whereRaw('buyer_id = ? AND preview = ?',array($user_id,0))->where('buyer_quote_id',$quote_id)->orderBy('id', 'desc')->paginate(15);
        }
        else
        {
            $SupplierQuotes = SupplierQuotes::whereNotIn('id',$result)->whereRaw('buyer_id = ? AND preview = ?',array($user_id,0))->orderBy('id', 'desc')->paginate(15);
        }

        foreach($SupplierQuotes as $SupplierQuote)
        {
            $supplier_id = $SupplierQuote->supplier_id;
            $SupplierQuote->supplierUser = UserDetails::where('user_id',$supplier_id)->first();
            $SupplierQuote->supplier = User::find($supplier_id);
            if($SupplierQuote->supplierUser->company_id != '')
            {
                $SupplierQuote->supplierCompany = Company::find($SupplierQuote->supplierUser->company_id);
            }
            else
            {
                $SupplierQuote->supplierCompany = '';
            }
            if($SupplierQuote->supplierUser->account_member == 'gold')
            {
                $SupplierQuote->star = 'gold';
            }
            elseif($SupplierQuote->supplierUser->account_member == 'silver')
            {
                $SupplierQuote->star = 'silver';
            }
            else
            {
                $SupplierQuote->star = 'none';
            }

            /// Buy request data
            $buyRequest = $SupplierQuote->buyer_quote_id;
            $SupplierQuote->buy_request = Quotes::find($buyRequest);

            /// Endorsement Count
            $SupplierQuote->endorsement = count(Endorsements::where('receiver_id',$supplier_id)->get());

            /// Review Count
            $reviewCount = count(Reviews::where('receiver_id',$supplier_id)->get());
            $totalStarts = Reviews::where('receiver_id',$supplier_id)->sum('stars');
            if($reviewCount > 0)
            {
                $SupplierQuote->reviews = ($totalStarts/$reviewCount);
            }
            else
            {
                $SupplierQuote->reviews = 0;
            }
            $subtotal = 0;
            foreach($SupplierQuote->SupplierQuoteItems as $item)
            {
                $subtotal += $item->price*$item->qty;
            }
            $SupplierQuote->price = $subtotal;
        }


        $previousPageUrl = $SupplierQuotes->previousPageUrl();//previous page url
        $nextPageUrl = $SupplierQuotes->nextPageUrl();//next page url
        $lastPage = $SupplierQuotes->lastPage(); //Gives last page number
        $total = $SupplierQuotes->total();
        return view('supplierquotes.index')->with([
            'SupplierQuotes'=>$SupplierQuotes,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            "total"=>$total,
            'user_access_level'=>$user_access_level,
            'current_user_id'=>$user_id,
            'userquotes' => $userQuotes,
            'current_quote_id' => $current_quote_id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($buyer_id,$quote_id)
    {
        //Output create view.
        $quote = Quotes::find($quote_id);
        $user_id = Auth::user()->id;
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }

        $buyerData = UserDetails::where('user_id',$buyer_id)->first();
        if($buyerData == '')
        {
            $buyerData = new UserDetails();
            $buyerData->account_type = '';
            $buyerData->user_id = $buyer_id;
            $buyerData->first_name = '';
            $buyerData->last_name = '';
            $buyerData->company_id = '';
        }

        return view('supplierquotes.create')->with([
            'userData' => $userData,
            'buyerData' => $buyerData,
            'quote_id' => $quote_id,
            'quote'=>$quote
        ]);
    }

    /**
     * Supplier Quote Create
     */
    public function createQuoteSuppliear()
    {
        $user_id = Auth::user()->id;
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }

        $SupplierIgnoreQuotes = SupplierIgnoreQuotes::where('supplier_id',$user_id)->get();
        $result = array();
        $userCreatedDate = date('Y-m-d', strtotime(Auth::user()->created_at));
        $currentDate = date('Y-m-d');
        foreach($SupplierIgnoreQuotes as $ignoreQoute)
        {
            $result[] = $ignoreQoute['quote_id'];
        }

        // Seller own quote filter
        $Sellerquotes = Quotes::where('created_by',$user_id)->get();
        foreach($Sellerquotes as $sellerQt)
        {
            $result[] = $sellerQt['id'];
        }
        $result = array_unique($result);
        $supplierLeads = SupplierLeads::where('created_by',$user_id)->get();

        $supplieIndustries = array();
        $supplieCategories = array();
        foreach($supplierLeads as $supplierLead)
        {
            $leadIndustries = SupplierLeadIndustries::where('supplier_lead_id',$supplierLead->id)->get();
            foreach($leadIndustries as $leadindustry)
            {
                $supplieIndustries[] = $leadindustry->industry_id;
            }
            $leadCategories = SupplierLeadCategories::where('supplier_lead_id',$supplierLead->id)->get();
            foreach($leadCategories as $leadCategory)
            {
                $supplieCategories[] = $leadCategory->category_id;
            }
        }

        $supplieIndustries = array_unique($supplieIndustries);
        $supplieCategories = array_unique($supplieCategories);
        /// Quote By Categories
        $quoteByLeadsArray = array();
        if(!empty($supplieCategories))
        {
            foreach($supplieCategories as $category)
            {
                $quoteDatas = '';
                $quoteDatas = QuoteCategories::where('category_id',$category)->get();
                foreach($quoteDatas as $quoteData)
                {
                    $quoteByLeadsArray[] = $quoteData->quote_id;
                }
            }
        }
        if(!empty($quoteByLeadsArray))
        {

            $quoteByLeadsArray = array_unique($quoteByLeadsArray);

        }
        $finalQuotesLeadsArray = array();
        foreach($quoteByLeadsArray as $quote_id){
            $industryCount = QuoteIndustries::where('quote_id',$quote_id)->whereIn('industry_id', $supplieIndustries)->count();
            if($industryCount > 0){
                $finalQuotesLeadsArray[] = $quote_id;
            }
        }


        $quoteByLeadsArray = $finalQuotesLeadsArray;

        //echo"<pre>"; print_r($quoteByLeadsArray); exit(0);
        if(!empty($quoteByLeadsArray))
        {
            $quoteByLeadsArray = array_unique($quoteByLeadsArray);
        }
        $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->get();

        /// check for verify
        $veryfyArray = array();
        foreach($quotes as $quote)
        {
            if($quote->verified_only == 1)
            {
                $veryfyArray[] = $quote->id;
            }
        }

        if(Auth::user()->quotetek_verify != 1)
        {
            $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->whereNotIn('id',$veryfyArray)->where('created_at','>',$userCreatedDate)->get();
        }

        else{
            $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->where('created_at','>=',$userCreatedDate)->get();
        }


        $finalQuotesArray = array();
        foreach($quotes as $quote){
            if($quote->expiry_date == '0000-00-00'){
                $user_id = $quote->created_by;
                $user = User::find($user_id);
                $quote->user = $user;
                $finalQuotesArray[] = $quote;
                continue;
            }else if($quote->expiry_date >= $currentDate){
                $user_id = $quote->created_by;
                $user = User::find($user_id);
                $quote->user = $user;
                $finalQuotesArray[] = $quote;
            }
        }

        //$quotes = Quotes::where('status',1)->get();
        return view('supplierquotes.quote-create')->with(['userData' => $userData,'quotes'=>$finalQuotesArray]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Creating accreditations and go back to index.
        $input = $request->all();

        if(Input::has('sup-quote-create'))
        {
            $this->validate($request, [
                'lead' => 'required'
            ]);

            $quote_id = Input::get('lead');
            $quote = Quotes::find($quote_id);
            $input['buyer_id'] = $quote->created_by;
            $input['buyer_quote_id'] = $quote_id;
        }

        $unique = SupplierQuoteUnique::first();
        $next = $unique->number+1;
        $unique->number = $next;
        $unique->save();

        $input['quote_unique'] = 'IJQ-'.$next;
        $input['preview'] = 1;
        $SupplierQuotes = SupplierQuotes::create($input);
        $supplier_quote_id = $SupplierQuotes->id;

        // add supplier quote items
        if($input['random_quote'] != '')
        {
            $quoteItems = SupplierDumpItems::where('random_number',$input['random_quote'])->get();
            foreach($quoteItems as $quoteItem)
            {
                $SupplierQuoteItems = new SupplierQuoteItems();
                $SupplierQuoteItems->supplier_quote_id = $supplier_quote_id;
                $SupplierQuoteItems->title = $quoteItem->name;
                $SupplierQuoteItems->description = $quoteItem->description;
                $SupplierQuoteItems->qty = $quoteItem->qty;
                $SupplierQuoteItems->price = $quoteItem->price;
                $SupplierQuoteItems->item_number = $quoteItem->item_number;
                $SupplierQuoteItems->taxable = $quoteItem->taxable;
                $SupplierQuoteItems->manufacturer = $quoteItem->manufacturer;
                $SupplierQuoteItems->model = $quoteItem->model;
                $SupplierQuoteItems->year = $quoteItem->year;
                $SupplierQuoteItems->condition = $quoteItem->condition;
                $SupplierQuoteItems->categories = $quoteItem->categories;
                $SupplierQuoteItems->specification = $quoteItem->specification;
                $SupplierQuoteItems->specification_file = $quoteItem->specification_file;
                $SupplierQuoteItems->user_id = $input['supplier_id'];
                $SupplierQuoteItems->save();
            }

        }

        return Redirect::to('supplier-sent-quote/preview/'.$supplier_quote_id);


    }

    /**
     * submit quote
     */
    public function submitSupplierQuote($id)
    {
        $SupplierQuotes = SupplierQuotes::find($id);
        $supplier_quote_id = $SupplierQuotes->id;

        $SupplierQuotes->preview = 0;
        $SupplierQuotes->save();

        /// User Activity for message
        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'Send New Quote to buyer';
        $usersActivity->activity_id = $supplier_quote_id;
        $usersActivity->activity_type = 'quote_supplier';
        $usersActivity->creater_id = $SupplierQuotes->supplier_id;
        $usersActivity->receiver_id = $SupplierQuotes->buyer_id;
        $usersActivity->save();

        /* quote receive mail to receiver */
        $receiverData = UserDetails::where('user_id',$SupplierQuotes->buyer_id)->first();
        $receiver = User::find($SupplierQuotes->buyer_id);

        $senderData = UserDetails::where('user_id',$SupplierQuotes->supplier_id)->first();
        $sender = User::find($SupplierQuotes->supplier_id);
        $senderUrl = url('home/user/profile').'/'.$senderData->user_id;

        $quote_url = url('supplier-quotes').'/'.$SupplierQuotes->id;

        Input::replace(array('email' => $receiver->email,'name'=>$receiverData->first_name.' '.$receiverData->last_name));
        $data = array(
            'name'=>Input::get('name'),
            'supplier_name'=>$senderData->first_name.' '.$senderData->last_name,
            'supplier_email'=>$sender->email,
            'quote_url' => $quote_url,
            'profile_link'=>$senderUrl
        );
        Mail::send('admin.Emailtemplates.buyerReceivedQuote', $data, function($message){
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to(Input::get('email'), Input::get('name'))->subject('You have received a New Quote on Indy John.');
        });

        return Redirect::to('supplier-sent-quote')->with('message', 'Your Quote has been submitted.');
    }

    /**
     * edit supplier quote
     */
    public function editSupplierQuote($id)
    {
        $SupplierQuote = SupplierQuotes::find($id);

        //Output create view.
        $quote = Quotes::find($SupplierQuote->buyer_quote_id);
        $user_id = Auth::user()->id;
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }

        $buyerData = UserDetails::where('user_id',$SupplierQuote->buyer_id)->first();
        if($buyerData == '')
        {
            $buyerData = new UserDetails();
            $buyerData->account_type = '';
            $buyerData->user_id = $SupplierQuote->buyer_id;
            $buyerData->first_name = '';
            $buyerData->last_name = '';
            $buyerData->company_id = '';
        }

        return view('supplierquotes.edit')->with([
            'supplierQuote' => $SupplierQuote,
            'userData' => $userData,
            'buyerData' => $buyerData,
            'quote_id' => $SupplierQuote->buyer_quote_id,
            'quote'=>$quote
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show quote Information
        $SupplierQuotes = SupplierQuotes::find($id);

        // current user
        $user_id = Auth::user()->id;

        /*if($SupplierQuotes->buyer_id != $user_id)
        {
            return Redirect::to('not-authorized');
        }*/

        $user_access_level = Auth::user()->access_level;

        $SupplierQuotes->user = User::find($user_id);

        if($SupplierQuotes->user->userdetail->company_id != '')
        {
            $SupplierQuotes->company = Company::find($SupplierQuotes->user->userdetail->company_id);
        }
        else
        {
            $SupplierQuotes->company = '';
        }


        // user who create quote

        $userData = UserDetails::where('user_id',$SupplierQuotes->supplier_id)->first();
        $SupplierQuotes->sellerUser = User::find($SupplierQuotes->supplier_id);
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        if($SupplierQuotes->sellerUser->account_member == 'gold')
        {
            $SupplierQuotes->sellerUser->star = 'gold';
        }
        elseif($SupplierQuotes->sellerUser->account_member == 'silver')
        {
            $SupplierQuotes->sellerUser->star = 'silver';
        }
        else
        {
            $SupplierQuotes->sellerUser->star = 'none';
        }


        if($SupplierQuotes->sellerUser->userdetail->company_id != '')
        {
            $SupplierQuotes->sellerCompany = Company::find($SupplierQuotes->sellerUser->userdetail->company_id);
            $SupplierQuotes->companyUser = User::find($SupplierQuotes->sellerCompany->user_id);
        }
        else
        {
            $SupplierQuotes->sellerCompany = '';
            $SupplierQuotes->companyUser = '';
        }

        $SupplierQuotes->buyerQuote = Quotes::find($SupplierQuotes->buyer_quote_id);

        $subtotal = 0;
        $taxAmount = 0;
        $shippingAmount = 0;
        foreach($SupplierQuotes->SupplierQuoteItems as $item)
        {
            $itemTotal = 0;
            $subtotal += $item->price*$item->qty;
            $itemTotal = $item->price*$item->qty;
            if($SupplierQuotes->salestax == 'Fixed Amount')
            {
                $taxAmount += ($item->qty*$SupplierQuotes->salestax_amount);
            }
            elseif($SupplierQuotes->salestax == 'Percent')
            {
                if($item->taxable == 1)
                {
                    $taxAmount += (($itemTotal*$SupplierQuotes->salestax_amount)/100);
                }
            }

            if($SupplierQuotes->shipping_charge == 'Yes')
            {
                $shippingAmount = $SupplierQuotes->shipping_charge_amount;
            }
            // for categories
            if($item->categories != ''){
                if(@unserialize($item->categories))
                {
                    $item_specifics_value = unserialize($item->categories);
                    if(!empty($item_specifics_value))
                    {
                        $item->categories = $item_specifics_value;
                    }
                    else
                    {
                        $item->categories = array();
                    }
                }
                else
                {
                    $item->categories = array();
                }

            }else{
                $item->categories = array();
            }

            // for specifications
            if($item->specification != ''){
                if(@unserialize($item->specification))
                {
                    $item_specifics_value = unserialize($item->specification);
                    if(!empty($item_specifics_value))
                    {
                        $item->specification = $item_specifics_value;
                    }
                    else
                    {
                        $item->specification = array();
                    }
                }
                else
                {
                    $item->specification = array();
                }

            }else{
                $item->specification = array();
            }

        }
        $SupplierQuotes->subtotal = $subtotal;
        $SupplierQuotes->tax = $taxAmount;
        $SupplierQuotes->grandtotal = $subtotal+$taxAmount+$shippingAmount;
        return view('supplierquotes.view')->with(['quotes'=>$SupplierQuotes,'userData'=>$userData,'user_access_level'=>$user_access_level,'current_user_id'=>$user_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //Show quote Information
        $SupplierQuote = SupplierQuotes::find($id);

        $input = $request->all();
        if($input['shipping_charge'] == 'No'){
            $input['shipping_charge_amount'] = '';
        }
        //echo "<pre>"; print_r($input); exit(0);
        ///////////////
        $SupplierQuote->fill($input)->save();

        return Redirect::to('supplier-sent-quote/preview/'.$SupplierQuote->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Add product in supplier Quote
     */
    public function ajaxAddProduct($id)
    {
        $current_id = $id;
        $next_id = $id + 1;
        $html = '';
        $html .= '<div id="added_product_'.$current_id.'">
                    <div class="col-md-12">
                        <div class="portlet box yellow-crusta">
                            <div class="portlet-title">
                                <div class="caption color-black">New Product</div>
                                <div class="actions color-black">
                                    <a href="javascript:void(0)" onclick="removeProduct(id)" id="remove_'.$current_id.'" class="btn btn-default btn-sm color-black">
                                        <i class="fa fa-remove color-black"></i>  Remove </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="row">
                                    <div class="col-md-12 padding-top">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Product Title:</label>
                                                <input type="text" name="items['.$current_id.'][title]" class="form-control" required="" placeholder="Product Title" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Description:</label>
                                                <textarea name="items['.$current_id.'][description]" class="form-control" placeholder="Description" required=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Quantity:</label>
                                                <input type="number" name="items['.$current_id.'][qty]" required="" class="form-control" placeholder="Quantity" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Price:</label>
                                                <input type="number" step="any" required="" name="items['.$current_id.'][price]" class="form-control" placeholder="Price" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Total Max Quantity:</label>
                                                <input type="number" name="items['.$current_id.'][max_qty]" required="" class="form-control" placeholder="Total Max Quantity" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        $ajaxArray = array();
        $ajaxArray['success'] = true;
        $ajaxArray['html'] = $html;
        $ajaxArray['next_id'] = $next_id;
        return Response::json($ajaxArray);

    }

    /**
     * Quote accept by buyer
     */
    public function quoteAccept($id)
    {
        //Show quote Information
        $SupplierQuotes = SupplierQuotes::find($id);
        $SupplierQuotes->status = 1;
        $SupplierQuotes->save();

        $user_id = Auth::user()->id;
        $BuyerIgnoreQuotes = BuyerIgnoreQuotes::where('buyer_id',$user_id)->get();
        $result = array();
        foreach($BuyerIgnoreQuotes as $ignoreQoute)
        {
            $result[] = $ignoreQoute['supplier_quote_id'];
        }
        $SupplierQuotes = SupplierQuotes::whereNotIn('id',$result)->where('id','!=',$id)->whereRaw('buyer_id = ? AND preview = ?',array($user_id,0))->where('buyer_quote_id',$SupplierQuotes->buyer_quote_id)->get();
        foreach($SupplierQuotes as $quotes)
        {
            $quotes->status = 2;
            $quotes->save();
        }
        return Redirect::to('supplier-quotes')->with('message', 'Buyer has accepted your Quote as winner.');
    }

    /**
     * Quote Ignore by supplier
     */
    public function buyerQuoteIgnore($buyer_id,$supplier_quote_id)
    {
        $BuyerIgnoreQuotes = new BuyerIgnoreQuotes();
        $BuyerIgnoreQuotes->buyer_id = $buyer_id;
        $BuyerIgnoreQuotes->supplier_quote_id = $supplier_quote_id;
        $BuyerIgnoreQuotes->save();
        return Redirect::to('supplier-quotes')->with('message', 'Buyer has ignored your offer quote.');
    }

    /**
     * Quotes sent by supplier
     */
    public function supplierSentQuote()
    {
        $user_id = Auth::user()->id;

        $user_access_level = Auth::user()->access_level;

        $SupplierQuotes = SupplierQuotes::whereRaw('supplier_id = ? AND preview = ?',array($user_id,0))->orderBy('id', 'desc')->paginate(15);

        $previousPageUrl = $SupplierQuotes->previousPageUrl();//previous page url
        $nextPageUrl = $SupplierQuotes->nextPageUrl();//next page url
        $lastPage = $SupplierQuotes->lastPage(); //Gives last page number
        $total = $SupplierQuotes->total();
        return view('supplierquotes.sent')->with(['SupplierQuotes'=>$SupplierQuotes,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total,'user_access_level'=>$user_access_level,'current_user_id'=>$user_id]);
    }

    /**
     * View sent quote by supplier
     */
    public function supplierSentQuoteView($id)
    {

        //Show quote Information
        $SupplierQuotes = SupplierQuotes::find($id);

        // current user
        $user_id = Auth::user()->id;

        if($SupplierQuotes->supplier_id != $user_id)
        {
            return Redirect::to('not-authorized');
        }

        $user_access_level = Auth::user()->access_level;

        $SupplierQuotes->user = User::find($SupplierQuotes->buyer_id);

        if($SupplierQuotes->user->userdetail->company_id != '')
        {
            $SupplierQuotes->company = Company::find($SupplierQuotes->user->userdetail->company_id);
        }
        else
        {
            $SupplierQuotes->company = '';
        }


        // user who create quote

        $userData = UserDetails::where('user_id',$SupplierQuotes->supplier_id)->first();
        $SupplierQuotes->sellerUser = User::find($SupplierQuotes->supplier_id);
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        if($SupplierQuotes->sellerUser->account_member == 'gold')
        {
            $SupplierQuotes->sellerUser->star = 'gold';
        }
        elseif($SupplierQuotes->sellerUser->account_member == 'silver')
        {
            $SupplierQuotes->sellerUser->star = 'silver';
        }
        else
        {
            $SupplierQuotes->sellerUser->star = 'none';
        }


        if($SupplierQuotes->sellerUser->userdetail->company_id != '')
        {
            $SupplierQuotes->sellerCompany = Company::find($SupplierQuotes->sellerUser->userdetail->company_id);
            $SupplierQuotes->companyUser = User::find($SupplierQuotes->sellerCompany->user_id);
        }
        else
        {
            $SupplierQuotes->sellerCompany = '';
            $SupplierQuotes->companyUser = '';
        }

        $SupplierQuotes->buyerQuote = Quotes::find($SupplierQuotes->buyer_quote_id);

        $subtotal = 0;
        $taxAmount = 0;
        $shippingAmount = 0;
        foreach($SupplierQuotes->SupplierQuoteItems as $item)
        {
            $itemTotal = 0;
            $subtotal += $item->price*$item->qty;
            $itemTotal = $item->price*$item->qty;
            if($SupplierQuotes->salestax == 'Fixed Amount')
            {
                $taxAmount += ($item->qty*$SupplierQuotes->salestax_amount);
            }
            elseif($SupplierQuotes->salestax == 'Percent')
            {
                if($item->taxable == 1)
                {
                    $taxAmount += (($itemTotal*$SupplierQuotes->salestax_amount)/100);
                }
            }

            if($SupplierQuotes->shipping_charge == 'Yes')
            {
                $shippingAmount = $SupplierQuotes->shipping_charge_amount;
            }
            // for categories
            if($item->categories != ''){
                if(@unserialize($item->categories))
                {
                    $item_specifics_value = unserialize($item->categories);
                    if(!empty($item_specifics_value))
                    {
                        $item->categories = $item_specifics_value;
                    }
                    else
                    {
                        $item->categories = array();
                    }
                }
                else
                {
                    $item->categories = array();
                }

            }else{
                $item->categories = array();
            }

            // for specifications
            if($item->specification != ''){
                if(@unserialize($item->specification))
                {
                    $item_specifics_value = unserialize($item->specification);
                    if(!empty($item_specifics_value))
                    {
                        $item->specification = $item_specifics_value;
                    }
                    else
                    {
                        $item->specification = array();
                    }
                }
                else
                {
                    $item->specification = array();
                }

            }else{
                $item->specification = array();
            }

        }
        $SupplierQuotes->subtotal = $subtotal;
        $SupplierQuotes->tax = $taxAmount;
        $SupplierQuotes->shippingAmount = $taxAmount;
        $SupplierQuotes->grandtotal = $subtotal+$taxAmount+$shippingAmount;

        return view('supplierquotes.sent-view')->with(['quotes'=>$SupplierQuotes,'userData'=>$userData,'user_access_level'=>$user_access_level,'current_user_id'=>$user_id]);
    }

    /**
     * Preview sent quote by supplier
     */
    public function supplierSentQuotePreview($id)
    {

        //Show quote Information
        $SupplierQuotes = SupplierQuotes::find($id);
        if($SupplierQuotes->preview != 1)
        {
            return Redirect::to('not-authorized');
        }
        // current user
        $user_id = Auth::user()->id;

        if($SupplierQuotes->supplier_id != $user_id)
        {
            return Redirect::to('not-authorized');
        }

        $user_access_level = Auth::user()->access_level;

        $SupplierQuotes->user = User::find($SupplierQuotes->buyer_id);

        if($SupplierQuotes->user->userdetail->company_id != '')
        {
            $SupplierQuotes->company = Company::find($SupplierQuotes->user->userdetail->company_id);
        }
        else
        {
            $SupplierQuotes->company = '';
        }


        // user who create quote

        $userData = UserDetails::where('user_id',$SupplierQuotes->supplier_id)->first();
        $SupplierQuotes->sellerUser = User::find($SupplierQuotes->supplier_id);
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        if($SupplierQuotes->sellerUser->account_member == 'gold')
        {
            $SupplierQuotes->sellerUser->star = 'gold';
        }
        elseif($SupplierQuotes->sellerUser->account_member == 'silver')
        {
            $SupplierQuotes->sellerUser->star = 'silver';
        }
        else
        {
            $SupplierQuotes->sellerUser->star = 'none';
        }


        if($SupplierQuotes->sellerUser->userdetail->company_id != '')
        {
            $SupplierQuotes->sellerCompany = Company::find($SupplierQuotes->sellerUser->userdetail->company_id);
            $SupplierQuotes->companyUser = User::find($SupplierQuotes->sellerCompany->user_id);
        }
        else
        {
            $SupplierQuotes->sellerCompany = '';
            $SupplierQuotes->companyUser = '';
        }

        $SupplierQuotes->buyerQuote = Quotes::find($SupplierQuotes->buyer_quote_id);

        $subtotal = 0;
        $taxAmount = 0;
        $shippingAmount = 0;
        foreach($SupplierQuotes->SupplierQuoteItems as $item)
        {
            $itemTotal = 0;
            $subtotal += $item->price*$item->qty;
            $itemTotal = $item->price*$item->qty;
            if($SupplierQuotes->salestax == 'Fixed Amount')
            {
                $taxAmount += ($item->qty*$SupplierQuotes->salestax_amount);
            }
            elseif($SupplierQuotes->salestax == 'Percent')
            {
                if($item->taxable == 1)
                {
                    $taxAmount += (($itemTotal*$SupplierQuotes->salestax_amount)/100);
                }
            }

            if($SupplierQuotes->shipping_charge == 'Yes')
            {
                $shippingAmount = $SupplierQuotes->shipping_charge_amount;
            }
            // for categories
            if($item->categories != ''){
                if(@unserialize($item->categories))
                {
                    $item_specifics_value = unserialize($item->categories);
                    if(!empty($item_specifics_value))
                    {
                        $item->categories = $item_specifics_value;
                    }
                    else
                    {
                        $item->categories = array();
                    }
                }
                else
                {
                    $item->categories = array();
                }

            }else{
                $item->categories = array();
            }

            // for specifications
            if($item->specification != ''){
                if(@unserialize($item->specification))
                {
                    $item_specifics_value = unserialize($item->specification);
                    if(!empty($item_specifics_value))
                    {
                        $item->specification = $item_specifics_value;
                    }
                    else
                    {
                        $item->specification = array();
                    }
                }
                else
                {
                    $item->specification = array();
                }

            }else{
                $item->specification = array();
            }

        }
        $SupplierQuotes->subtotal = $subtotal;
        $SupplierQuotes->tax = $taxAmount;
        $SupplierQuotes->grandtotal = $subtotal+$taxAmount+$shippingAmount;

        return view('supplierquotes.preview')->with(['quotes'=>$SupplierQuotes,'userData'=>$userData,'user_access_level'=>$user_access_level,'current_user_id'=>$user_id]);
    }

    public function addQuoteItem($id)
    {

        $html = '';
        $html .= '<div class="modal-dialog" id="supplier-quote-item">
                    <style>
                    .select2-container{z-index:10052!important}
                    .main-lab{font-size: 15px!important;font-weight: bold;}
                    .select2-container{display: block!important;}
                    .ms-container{width: 90%!important;}
                    @media (min-width: 992px){
                    .col-md-2n {
                        width: 20%!important;
                    }
                    }
                    .modal-open .select2-container--bootstrap .select2-selection--multiple .select2-search--inline .select2-search__field{width:400px!important}
                    </style>
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Add Product Details to your Quote</h4>
                        </div>
                        <form id="quote-items-add" action="'.url('quote/item/save').'" method="post" class="horizontal-form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <input type="hidden" name="random_number" id="add-random-number" value="'.$id.'" />
                            <input type="hidden" name="item_id" value="" />
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-4">
                                            <label class="control-label">Manufacturer:</label>
                            				<input type="text" class="form-control" name="manufacturer" placeholder="Enter Item Manufacturer">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Item Model:</label>
                            				<input type="text" class="form-control" name="model" placeholder="Enter Item Model" required="">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Year of MFR:</label>
                            				<input type="number" min="1900" class="form-control" name="year" placeholder="Enter Year of MFR (ex. 1995)" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-4">
                                            <label class="control-label">Item Number:</label>
                            				<input type="text" class="form-control" name="item_number" placeholder="Enter Item Number">
                                        </div>
                                        <div class="col-md-8">
                                            <label class="control-label">Item Description:</label>
                            				<input type="text" class="form-control" name="name" id="item-name" placeholder="Enter Item Description" required="">
                                            <span class="font-red" id="discription-fld-req" style="display:none">Description required</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-4">
                                            <label class="control-label">Quantity:</label>
                            				<input type="number" class="form-control" name="qty" id="item-qty" placeholder="Enter Quantity" required="">
                                            <span class="font-red" id="qty-fld-req" style="display:none">Qty required</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Price:</label>
                            				<input type="number" class="form-control" name="price" id="item-price" placeholder="Enter Item Price" required="">
                                            <span class="font-red" id="price-fld-req" style="display:none">Price required</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Apply tax to this Item?:</label>
                                            <div class="col-md-12 paddin-npt">
                            				<input name="taxable" id="multi-select-items" type="checkbox" data-on-text="Yes" data-off-text="No" class="make-switch form-control" data-size="small">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-8">
                                            <label class="col-md-12 paddin-npt">Product Type or Category:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <select id="select2-button-addons-single-input-group-sm" name="product_categories[]" class="form-control col-md-12 js-data-category-ajax" multiple></select>
                                                <span class="help-block margin-top">Type and Select all that apply.</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 padding-left">
                                            <label class="col-md-12 paddin-npt">Condition of your Item:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <select name="condition" id="pro-condition" class="form-control margin-bottom" placeholder="Item Condition">
                                                    <option value="" >-- Please Select --</option>
                                                    <option value="New">New</option>
                                                    <option value="Used">Used</option>
                                                    <option value="Refurbished">Refurbished</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6">
                                            <label class="col-md-12 paddin-npt">Add Technical Specifications & Product Options:</label>
                                            <input type="text" name="specification" value="" data-role="tagsinput" id="taginputin" placeholder="Type something and hit enter" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-12">Upload an Optional Specification File: <span>(optional)</span></label>
                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">
                                                <div class="row">
                                                    <div class="input-group input-mediam">
                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>  &nbsp;
                                                            <span class="fileinput-filename"> </span>
                                                        </div>
                                                        <span class="input-group-addon btn btn-circle btn-danger btn-file" style="display:table-cell !important;">
                                                            <span class="fileinput-new"> Select file </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="specification_file"> </span>
                                                        <a href="javascript:;" class="input-group btn btn-danger bold fileinput-exists" data-dismiss="fileinput" style="width:80px!important;margin-top:-22px"> Remove </a>
                                                    </div>
                                                    </div>
                                                </div>
                                                <span class="help-block">Upload a PDF or word file about item Specification. </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn red" data-dismiss="modal">Close</button>
                                <button type="button" onclick="saveAuoteItems();" class="btn yellow-crusta color-black">Save</button>
                            </div>
                        </form>
                    </div>
                </div>';
        $ajaxDataArray = array();
        $ajaxDataArray['random'] = $id;
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }

    public function addSupplierQuoteItem($id)
    {

        $html = '';
        $html .= '<div class="modal-dialog" id="supplier-quote-item">
                    <style>
                    .select2-container{z-index:10052!important}
                    .main-lab{font-size: 15px!important;font-weight: bold;}
                    .select2-container{display: block!important;}
                    .ms-container{width: 90%!important;}
                    @media (min-width: 992px){
                    .col-md-2n {
                        width: 20%!important;
                    }
                    }
                    .modal-open .select2-container--bootstrap .select2-selection--multiple .select2-search--inline .select2-search__field{width:400px!important}
                    </style>
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Add Product Details to your Quote</h4>
                        </div>
                        <form id="quote-items-add" action="'.url('supplier-quote/item/save').'" method="post" class="horizontal-form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <input type="hidden" name="supplie_quote_id" value="'.$id.'" />
                            <input type="hidden" name="item_id" value="" />
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-4">
                                            <label class="control-label">Manufacturer:</label>
                            				<input type="text" class="form-control" name="manufacturer" placeholder="Enter Item Manufacturer">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Item Model:</label>
                            				<input type="text" class="form-control" name="model" placeholder="Enter Item Model" required="">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Year of MFR:</label>
                            				<input type="number" min="1900" class="form-control" name="year" placeholder="Enter Year of MFR (ex. 1995)" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-4">
                                            <label class="control-label">Item Number:</label>
                            				<input type="text" class="form-control" name="item_number" placeholder="Enter Item Number">
                                        </div>
                                        <div class="col-md-8">
                                            <label class="control-label">Item Description:</label>
                            				<input type="text" class="form-control" name="name" id="item-name" placeholder="Enter Item Description" required="">
                                            <span class="font-red" id="discription-fld-req" style="display:none">Description required</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-4">
                                            <label class="control-label">Quantity:</label>
                            				<input type="number" class="form-control" name="qty" id="item-qty" placeholder="Enter Quantity" required="">
                                            <span class="font-red" id="qty-fld-req" style="display:none">Qty required</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Price:</label>
                            				<input type="number" class="form-control" name="price" id="item-price" placeholder="Enter Item Price" required="">
                                            <span class="font-red" id="price-fld-req" style="display:none">Price required</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Apply tax to this Item?:</label>
                                            <div class="col-md-12 paddin-npt">
                            				<input name="taxable" id="multi-select-items" type="checkbox" data-on-text="Yes" data-off-text="No" class="make-switch form-control" data-size="small">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-8">
                                            <label class="col-md-12 paddin-npt">Product Type or Category:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <select id="select2-button-addons-single-input-group-sm" name="product_categories[]" class="form-control col-md-12 js-data-category-ajax" multiple></select>
                                                <span class="help-block margin-top">Type and Select all that apply.</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 padding-left">
                                            <label class="col-md-12 paddin-npt">Condition of your Item:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <select name="condition" id="pro-condition" class="form-control margin-bottom" placeholder="Item Condition">
                                                    <option value="" >-- Please Select --</option>
                                                    <option value="New">New</option>
                                                    <option value="Used">Used</option>
                                                    <option value="Refurbished">Refurbished</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6">
                                            <label class="col-md-12 paddin-npt">Add Technical Specifications & Product Options:</label>
                                            <input type="text" name="specification" value="" data-role="tagsinput" id="taginputin" placeholder="Type something and hit enter" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-12">Upload an Optional Specification File: <span>(optional)</span></label>
                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">
                                                <div class="row">
                                                    <div class="input-group input-mediam">
                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>  &nbsp;
                                                            <span class="fileinput-filename"> </span>
                                                        </div>
                                                        <span class="input-group-addon btn btn-circle btn-danger btn-file" style="display:table-cell !important;">
                                                            <span class="fileinput-new"> Select file </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="specification_file"> </span>
                                                        <a href="javascript:;" class="input-group btn btn-danger bold fileinput-exists" data-dismiss="fileinput" style="width:80px!important;margin-top:-22px"> Remove </a>
                                                    </div>
                                                    </div>
                                                </div>
                                                <span class="help-block">Upload a PDF or word file about item Specification. </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn red" data-dismiss="modal">Close</button>
                                <button type="button" onclick="saveAuoteItems();" class="btn yellow-crusta color-black">Save</button>
                            </div>
                        </form>
                    </div>
                </div>';
        $ajaxDataArray = array();
        $ajaxDataArray['random'] = $id;
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }

    public function editQuoteItem($id)
    {
        $item = SupplierDumpItems::find($id);
        $categories = array();
        $categories = unserialize($item->categories);

        $specification_str = '';
        $specifications = unserialize($item->specification);
        if(!empty($specifications))
        {
            foreach($specifications as $index=>$specification)
            {
                if($index == 0)
                {
                    $specification_str = $specification['keyword'];
                }
                else
                {
                    $specification_str .= ','.$specification['keyword'];
                }
            }
        }
        else
        {
            $specification_str = '';
        }

        $html = '';
        $html .= '<div class="modal-dialog" id="supplier-quote-item">
                    <style>
                    .select2-container{z-index:10052!important}
                    .main-lab{font-size: 15px!important;font-weight: bold;}
                    .select2-container{display: block!important;}
                    .ms-container{width: 90%!important;}
                    @media (min-width: 992px){
                    .col-md-2n {
                        width: 20%!important;
                    }
                    }
                    .modal-open .select2-container--bootstrap .select2-selection--multiple .select2-search--inline .select2-search__field{width:400px!important}
                    </style>
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Edit Product Details to your Quote</h4>
                        </div>
                        <form id="quote-items-add" action="'.url('quote/item/save').'" method="post" class="horizontal-form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <input type="hidden" name="random_number" id="add-random-number" value="'.$item->random_number.'" />
                            <input type="hidden" name="item_id" value="'.$id.'" />
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-4">
                                            <label class="control-label">Manufacturer:</label>
                            				<input type="text" class="form-control" name="manufacturer" value="'.$item->manufacturer.'" placeholder="Enter Item Manufacturer">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Item Model:</label>
                            				<input type="text" class="form-control" name="model" value="'.$item->model.'" placeholder="Enter Item Model" required="">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Year of MFR:</label>
                            				<input type="number" min="1900" class="form-control" name="year" value="'.$item->year.'" placeholder="Enter Year of MFR (ex. 1995)" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6">
                                            <label class="control-label">Item Number:</label>
                            				<input type="text" class="form-control" name="item_number" value="'.$item->item_number.'" placeholder="Enter Item Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Item Description:</label>
                            				<input type="text" class="form-control" name="name" id="item-name" value="'.$item->name.'" placeholder="Enter Item Description" required="">
                                            <span class="font-red" id="discription-fld-req" style="display:none">Description required</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-4">
                                            <label class="control-label">Quantity:</label>
                            				<input type="number" class="form-control" name="qty" id="item-qty" value="'.$item->qty.'" placeholder="Enter Quantity" required="">
                                            <span class="font-red" id="qty-fld-req" style="display:none">Qty required</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Price:</label>
                            				<input type="number" class="form-control" name="price" id="item-price" value="'.$item->price.'" placeholder="Enter Item Price" required="">
                                            <span class="font-red" id="price-fld-req" style="display:none">Price required</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Apply tax to this Item?:</label>
                                            <div class="col-md-12 paddin-npt">
                                            ';
        if($item->taxable == 1):
            $html .= '<input name="taxable" id="multi-select-items" type="checkbox" checked data-on-text="Yes" data-off-text="No" class="make-switch form-control" data-size="small">';
        else:
            $html .= '<input name="taxable" id="multi-select-items" type="checkbox" data-on-text="Yes" data-off-text="No" class="make-switch form-control" data-size="small">';
        endif;
        $html .= '</div></div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-8">
                                            <label class="col-md-12 paddin-npt">Product Type or Category:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <select id="select2-button-addons-single-input-group-sm" name="product_categories[]" class="form-control col-md-12 js-data-category-ajax" multiple>';
        if(!empty($categories)):
            foreach($categories as $category):
                $html .= '<option value="'.$category['id'].'" selected="selected">'.$category['name'].'</option>';
            endforeach;
        endif;
        $html .= '</select>
                                                <span class="help-block margin-top">Type and Select all that apply.</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 padding-left">
                                            <label class="col-md-12 paddin-npt">Condition of your Item:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <select name="condition" id="pro-condition" class="form-control margin-bottom" placeholder="Item Condition">
                                                    <option value="" >-- Please Select --</option>';
        if($item->condition == 'New'): $html .= '<option value="New" selected>New</option>'; else: $html .= '<option value="New">New</option>'; endif;
        if($item->condition == 'Used'): $html .= '<option value="Used" selected>Used</option>'; else: $html .= '<option value="Used">Used</option>'; endif;
        if($item->condition == 'Refurbished'): $html .= '<option value="Refurbished" selected>Refurbished</option>'; else: $html .= '<option value="Refurbished">Refurbished</option>'; endif;
        if($item->condition == 'Other'): $html .= '<option value="Other" selected>Other</option>'; else: $html .= '<option value="Other">Other</option>'; endif;
        $html .= '</select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6">
                                            <label class="col-md-12 paddin-npt">Add Technical Specifications & Product Options:</label>
                                            <input type="text" name="specification" value="'.$specification_str.'" data-role="tagsinput" id="taginputin" placeholder="Type something and hit enter" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-12">Upload an Optional Specification File: <span>(optional)</span></label>
                                            <div class="col-md-12">
                                                <br/>
                                                <a href="'.url('/').'/'.$item->specification_file.'" download style="top:-10px;padding-left:10px;position:relative" >File Download</a>
                                                <br/>
                                                <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">
                                                <div class="row">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>  &nbsp;
                                                            <span class="fileinput-filename"> </span>
                                                        </div>
                                                        <span class="input-group-addon btn btn-circle btn-danger btn-file" style="display:table-cell !important;">
                                                            <span class="fileinput-new"> Select file </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="specification_file"> </span>
                                                        <a href="javascript:;" class="input-group-addon btn btn-danger bold fileinput-exists" data-dismiss="fileinput" style="width:80px!important;margin-top:-22px"> Remove </a>
                                                    </div>
                                                    </div>
                                                </div>
                                                <span class="help-block">Upload a PDF or word file about item Specification. </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn red" data-dismiss="modal">Close</button>
                                <button type="button" onclick="saveAuoteItems();" class="btn yellow-crusta color-black">Save</button>
                            </div>
                        </form>
                    </div>
                </div>';
        $ajaxDataArray = array();
        $ajaxDataArray['random'] = $id;
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }

    public function editSupplierQuoteItem($id)
    {
        $item = SupplierQuoteItems::find($id);
        $categories = array();
        $categories = unserialize($item->categories);

        $specification_str = '';
        $specifications = unserialize($item->specification);
        if(!empty($specifications))
        {
            foreach($specifications as $index=>$specification)
            {
                if($index == 0)
                {
                    $specification_str = $specification['keyword'];
                }
                else
                {
                    $specification_str .= ','.$specification['keyword'];
                }
            }
        }
        else
        {
            $specification_str = '';
        }

        $html = '';
        $html .= '<div class="modal-dialog" id="supplier-quote-item">
                    <style>
                    .select2-container{z-index:10052!important}
                    .main-lab{font-size: 15px!important;font-weight: bold;}
                    .select2-container{display: block!important;}
                    .ms-container{width: 90%!important;}
                    @media (min-width: 992px){
                    .col-md-2n {
                        width: 20%!important;
                    }
                    }
                    .modal-open .select2-container--bootstrap .select2-selection--multiple .select2-search--inline .select2-search__field{width:400px!important}
                    </style>
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Edit Product Details to your Quote</h4>
                        </div>
                        <form id="quote-items-add" action="'.url('supplier-quote/item/save').'" method="post" class="horizontal-form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <input type="hidden" name="item_id" value="'.$id.'" />
                            <input type="hidden" name="supplie_quote_id" value="'.$item->supplier_quote_id.'" />
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-4">
                                            <label class="control-label">Manufacturer:</label>
                            				<input type="text" class="form-control" name="manufacturer" value="'.$item->manufacturer.'" placeholder="Enter Item Manufacturer">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Item Model:</label>
                            				<input type="text" class="form-control" name="model" value="'.$item->model.'" placeholder="Enter Item Model" required="">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Year of MFR:</label>
                            				<input type="number" min="1900" class="form-control" name="year" value="'.$item->year.'" placeholder="Enter Year of MFR (ex. 1995)" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6">
                                            <label class="control-label">Item Number:</label>
                            				<input type="text" class="form-control" name="item_number" value="'.$item->item_number.'" placeholder="Enter Item Number">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Item Description:</label>
                            				<input type="text" class="form-control" name="name" id="item-name" value="'.$item->title.'" placeholder="Enter Item Description" required="">
                                            <span class="font-red" id="discription-fld-req" style="display:none">Description required</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-4">
                                            <label class="control-label">Quantity:</label>
                            				<input type="number" class="form-control" name="qty" id="item-qty" value="'.$item->qty.'" placeholder="Enter Quantity" required="">
                                            <span class="font-red" id="qty-fld-req" style="display:none">Qty required</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Price:</label>
                            				<input type="number" class="form-control" name="price" id="item-price" value="'.$item->price.'" placeholder="Enter Item Price" required="">
                                            <span class="font-red" id="price-fld-req" style="display:none">Price required</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label">Apply tax to this Item?:</label>
                                            <div class="col-md-12 paddin-npt">
                                            ';
        if($item->taxable == 1):
            $html .= '<input name="taxable" id="multi-select-items" type="checkbox" checked data-on-text="Yes" data-off-text="No" class="make-switch form-control" data-size="small">';
        else:
            $html .= '<input name="taxable" id="multi-select-items" type="checkbox" data-on-text="Yes" data-off-text="No" class="make-switch form-control" data-size="small">';
        endif;
        $html .= '</div></div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-8">
                                            <label class="col-md-12 paddin-npt">Product Type or Category:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <select id="select2-button-addons-single-input-group-sm" name="product_categories[]" class="form-control col-md-12 js-data-category-ajax" multiple>';
        if(!empty($categories)):
            foreach($categories as $category):
                $html .= '<option value="'.$category['id'].'" selected="selected">'.$category['name'].'</option>';
            endforeach;
        endif;
        $html .= '</select>
                                                <span class="help-block margin-top">Type and Select all that apply.</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 padding-left">
                                            <label class="col-md-12 paddin-npt">Condition of your Item:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <select name="condition" id="pro-condition" class="form-control margin-bottom" placeholder="Item Condition">
                                                    <option value="" >-- Please Select --</option>';
        if($item->condition == 'New'): $html .= '<option value="New" selected>New</option>'; else: $html .= '<option value="New">New</option>'; endif;
        if($item->condition == 'Used'): $html .= '<option value="Used" selected>Used</option>'; else: $html .= '<option value="Used">Used</option>'; endif;
        if($item->condition == 'Refurbished'): $html .= '<option value="Refurbished" selected>Refurbished</option>'; else: $html .= '<option value="Refurbished">Refurbished</option>'; endif;
        if($item->condition == 'Other'): $html .= '<option value="Other" selected>Other</option>'; else: $html .= '<option value="Other">Other</option>'; endif;
        $html .= '</select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6">
                                            <label class="col-md-12 paddin-npt">Add Technical Specifications & Product Options:</label>
                                            <input type="text" name="specification" value="'.$specification_str.'" data-role="tagsinput" id="taginputin" placeholder="Type something and hit enter" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-12">Upload an Optional Specification File: <span>(optional)</span></label>
                                            <div class="col-md-12">
                                                <br/>
                                                <a href="'.url('/').'/'.$item->specification_file.'" download style="top:-10px;padding-left:10px;position:relative" >File Download</a>
                                                <br/>
                                                <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">
                                                <div class="row">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>  &nbsp;
                                                            <span class="fileinput-filename"> </span>
                                                        </div>
                                                        <span class="input-group-addon btn btn-circle btn-danger btn-file" style="display:table-cell !important;">
                                                            <span class="fileinput-new"> Select file </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="specification_file"> </span>
                                                        <a href="javascript:;" class="input-group-addon btn btn-danger bold fileinput-exists" data-dismiss="fileinput" style="width:80px!important;margin-top:-22px"> Remove </a>
                                                    </div>
                                                    </div>
                                                </div>
                                                <span class="help-block">Upload a PDF or word file about item Specification. </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn red" data-dismiss="modal">Close</button>
                                <button type="button" onclick="saveAuoteItems();" class="btn yellow-crusta color-black">Save</button>
                            </div>
                        </form>
                    </div>
                </div>';
        $ajaxDataArray = array();
        $ajaxDataArray['random'] = $id;
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }

    /**
     * supplier quote item add
     */
    public function saveQuoteItem(Request $request)
    {
        $input = $request->all();

        if($input['random_number'] == 0)
        {
            $random = rand(11111,99999);
            $oldItems = SupplierDumpItems::all();
            foreach($oldItems as $oldItem)
            {
                $oldItem->delete();
            }
        }
        else
        {
            $random = $input['random_number'];
        }
        $taxable = 0;
        if(Input::has('taxable'))
        {
            $taxable = 1;
        }
        if($input['item_id'] != '')
        {
            $quoteItem = SupplierDumpItems::find($input['item_id']);
        }
        else
        {
            $quoteItem = new SupplierDumpItems;
        }

        // categories
        $categoriesArray = array();
        if(Input::has('product_categories'))
        {
            foreach($input['product_categories'] as $category)
            {
                $dataArray = array();
                $categoryData = Category::find($category);
                $dataArray['id'] = $categoryData->id;
                $dataArray['name'] = $categoryData->name;
                $categoriesArray[] = $dataArray;
            }
        }

        if(!empty($categoriesArray))
        {
            $serialized_categories = serialize($categoriesArray);
        }
        else
        {
            $serialized_categories = null;
        }

        // technical specifications
        $SpecificationArray = array();

        if(!empty($input['specification']))
        {
            $allSpecifications = explode(',',$input['specification']);
            foreach($allSpecifications as $specification)
            {
                $dataArray = array();
                $opt = TechnicalSpecificationOptions::where('keyword',$specification)->first();
                if($opt)
                {
                    $dataArray['id'] = $opt->id;
                    $dataArray['keyword'] = $opt->keyword;
                }
                else
                {
                    $newOpt = new TechnicalSpecificationOptions;
                    $newOpt->keyword = $specification;
                    $newOpt->save();
                    $dataArray['id'] = $newOpt->id;
                    $dataArray['keyword'] = $newOpt->keyword;
                }
                $SpecificationArray[] = $dataArray;
            }
        }

        if(!empty($SpecificationArray))
        {
            $serialized_tec_specification = serialize($SpecificationArray);
        }
        else
        {
            $serialized_tec_specification = null;
        }



        $quoteItem->random_number = $random;
        $quoteItem->item_number = $input['item_number'];
        $quoteItem->name = $input['name'];
        $quoteItem->qty = $input['qty'];
        $quoteItem->price = $input['price'];
        $quoteItem->taxable = $taxable;
        $quoteItem->manufacturer = $input['manufacturer'];
        $quoteItem->model = $input['model'];
        $quoteItem->year = $input['year'];
        $quoteItem->condition = $input['condition'];
        $quoteItem->categories = $serialized_categories;
        $quoteItem->specification = $serialized_tec_specification;
        if(Input::file('specification_file'))
        {
            if($quoteItem && $quoteItem->specification_file)
            {
                unlink('public/'.$quoteItem->specification_file);
            }
            /// PDF file upload to public folder ///
            $destinationPath = 'public/supplier/quote'; // upload path
            $pdfName = str_replace(' ','_',$input['name']).'_'.rand(11111,99999). '.' .$request->file('specification_file')->getClientOriginalExtension();
            $request->file('specification_file')->move(
                base_path() . '/'.$destinationPath, $pdfName
            );

            $quoteItem->specification_file = 'supplier/quote/'.$pdfName;

        }
        $quoteItem->save();

        $quoteItems = SupplierDumpItems::where('random_number',$random)->get();
        $html = '';
        $html .= '<div class="paddin-bottom">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th>Item Number </th>
                                <th>Item Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Condition</th>
                                <th>Taxable</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>';
        foreach($quoteItems as $item):
            $html .= '<tr>
                                    <td>'.$item->item_number.'</td>
                                    <td>'.$item->name.'</td>
                                    <td>'.$item->qty.'</td>
                                    <td>'.$item->price.'</td>
                                    <td>'.$item->condition.'</td>
                                    <td>'; if($item->taxable == 1): $html .= 'Yes'; else: $html .= 'No'; endif; $html.= '</td>
                                    <td>
                                        <a href="javascript:void(0)" id="'.url('quote/item/edit').'/'.$item->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">
                                            <i class="fa fa-edit"></i>  Edit </a>
                                        <a href="javascript:void(0)" id="'.url('quote/item/delete').'/'.$item->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">
                                            <i class="fa fa-remove"></i>  Delete </a>
                                    </td>
                                </tr>';
        endforeach;
        $html .= '</tbody>
                        </table>
                    </div>';
        $ajaxDataArray = array();
        $ajaxDataArray['random'] = $random;
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);

    }

    public function saveSupplierQuoteItem(Request $request)
    {
        $input = $request->all();
        $suplierQuote = SupplierQuotes::find($input['supplie_quote_id']);
        $taxable = 0;
        if(Input::has('taxable'))
        {
            $taxable = 1;
        }
        if($input['item_id'] != '')
        {
            $quoteItem = SupplierQuoteItems::find($input['item_id']);
        }
        else
        {
            $quoteItem = new SupplierQuoteItems;
        }

        // categories
        $categoriesArray = array();
        if(Input::has('product_categories'))
        {
            foreach($input['product_categories'] as $category)
            {
                $dataArray = array();
                $categoryData = Category::find($category);
                $dataArray['id'] = $categoryData->id;
                $dataArray['name'] = $categoryData->name;
                $categoriesArray[] = $dataArray;
            }
        }

        if(!empty($categoriesArray))
        {
            $serialized_categories = serialize($categoriesArray);
        }
        else
        {
            $serialized_categories = null;
        }

        // technical specifications
        $SpecificationArray = array();

        if(!empty($input['specification']))
        {
            $allSpecifications = explode(',',$input['specification']);
            foreach($allSpecifications as $specification)
            {
                $dataArray = array();
                $opt = TechnicalSpecificationOptions::where('keyword',$specification)->first();
                if($opt)
                {
                    $dataArray['id'] = $opt->id;
                    $dataArray['keyword'] = $opt->keyword;
                }
                else
                {
                    $newOpt = new TechnicalSpecificationOptions;
                    $newOpt->keyword = $specification;
                    $newOpt->save();
                    $dataArray['id'] = $newOpt->id;
                    $dataArray['keyword'] = $newOpt->keyword;
                }
                $SpecificationArray[] = $dataArray;
            }
        }

        if(!empty($SpecificationArray))
        {
            $serialized_tec_specification = serialize($SpecificationArray);
        }
        else
        {
            $serialized_tec_specification = null;
        }



        $quoteItem->supplier_quote_id = $suplierQuote->id;
        $quoteItem->user_id = $suplierQuote->supplier_id;
        $quoteItem->item_number = $input['item_number'];
        $quoteItem->title = $input['name'];
        $quoteItem->qty = $input['qty'];
        $quoteItem->price = $input['price'];
        $quoteItem->taxable = $taxable;
        $quoteItem->manufacturer = $input['manufacturer'];
        $quoteItem->model = $input['model'];
        $quoteItem->year = $input['year'];
        $quoteItem->condition = $input['condition'];
        $quoteItem->categories = $serialized_categories;
        $quoteItem->specification = $serialized_tec_specification;
        if(Input::file('specification_file'))
        {
            if($quoteItem && $quoteItem->specification_file)
            {
                unlink('public/'.$quoteItem->specification_file);
            }
            /// PDF file upload to public folder ///
            $destinationPath = 'public/supplier/quote'; // upload path
            $pdfName = str_replace(' ','_',$input['name']).'_'.rand(11111,99999). '.' .$request->file('specification_file')->getClientOriginalExtension();
            $request->file('specification_file')->move(
                base_path() . '/'.$destinationPath, $pdfName
            );

            $quoteItem->specification_file = 'supplier/quote/'.$pdfName;

        }
        $quoteItem->save();

        $quoteItems = SupplierQuoteItems::where('supplier_quote_id',$suplierQuote->id)->get();
        $html = '';
        $html .= '<div class="paddin-bottom">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th>Item Number </th>
                                <th>Item Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Condition</th>
                                <th>Taxable</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>';
        foreach($quoteItems as $item):
            $html .= '<tr>
                                    <td>'.$item->item_number.'</td>
                                    <td>'.$item->title.'</td>
                                    <td>'.$item->qty.'</td>
                                    <td>'.$item->price.'</td>
                                    <td>'.$item->condition.'</td>
                                    <td>'; if($item->taxable == 1): $html .= 'Yes'; else: $html .= 'No'; endif; $html.= '</td>
                                    <td>
                                        <a href="javascript:void(0)" id="'.url('supllier-quote/item/edit').'/'.$item->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">
                                            <i class="fa fa-edit"></i>  Edit </a>
                                        <a href="javascript:void(0)" id="'.url('supllier-quote/item/delete').'/'.$item->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">
                                            <i class="fa fa-remove"></i>  Delete </a>
                                    </td>
                                </tr>';
        endforeach;
        $html .= '</tbody>
                        </table>
                    </div>';
        $ajaxDataArray = array();
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);

    }

    public function deleteQuoteItem($id)
    {
        $item = SupplierDumpItems::find($id);
        $random = $item->random_number;
        if($item->specification_file != '')
        {
            unlink('public/'.$item->specification_file);
        }
        $item->delete();

        $quoteItems = SupplierDumpItems::where('random_number',$random)->get();
        $html = '';
        $html .= '<div class="paddin-bottom">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th>Item Number </th>
                                <th>Item Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Condition</th>
                                <th>Taxable</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>';
        foreach($quoteItems as $item):
            $html .= '<tr>
                                    <td>'.$item->item_number.'</td>
                                    <td>'.$item->name.'</td>
                                    <td>'.$item->qty.'</td>
                                    <td>'.$item->price.'</td>
                                    <td>'.$item->condition.'</td>
                                    <td>'; if($item->taxable == 1): $html .= 'Yes'; else: $html .= 'No'; endif; $html.= '</td>
                                    <td>
                                        <a href="javascript:void(0)" id="'.url('quote/item/edit').'/'.$item->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">
                                            <i class="fa fa-edit"></i>  Edit </a>
                                        <a href="javascript:void(0)" id="'.url('quote/item/delete').'/'.$item->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">
                                            <i class="fa fa-remove"></i>  Delete </a>
                                    </td>
                                </tr>';
        endforeach;
        $html .= '</tbody>
                        </table>
                    </div>';
        $ajaxDataArray = array();
        $ajaxDataArray['random'] = $random;
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }

    public function deleteSupplierQuoteItem($id)
    {
        $item = SupplierQuoteItems::find($id);
        $supplierQuoteId = $item->supplier_quote_id;
        if($item->specification_file != '')
        {
            unlink('public/'.$item->specification_file);
        }
        $item->delete();

        $quoteItems = SupplierQuoteItems::where('supplier_quote_id',$supplierQuoteId)->get();
        $html = '';
        $html .= '<div class="paddin-bottom">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th>Item Number </th>
                                <th>Item Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Condition</th>
                                <th>Taxable</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>';
        foreach($quoteItems as $item):
            $html .= '<tr>
                                    <td>'.$item->item_number.'</td>
                                    <td>'.$item->title.'</td>
                                    <td>'.$item->qty.'</td>
                                    <td>'.$item->price.'</td>
                                    <td>'.$item->condition.'</td>
                                    <td>'; if($item->taxable == 1): $html .= 'Yes'; else: $html .= 'No'; endif; $html.= '</td>
                                    <td>
                                        <a href="javascript:void(0)" id="'.url('supllier-quote/item/edit').'/'.$item->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">
                                            <i class="fa fa-edit"></i>  Edit </a>
                                        <a href="javascript:void(0)" id="'.url('supllier-quote/item/delete').'/'.$item->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">
                                            <i class="fa fa-remove"></i>  Delete </a>
                                    </td>
                                </tr>';
        endforeach;
        $html .= '</tbody>
                        </table>
                    </div>';
        $ajaxDataArray = array();
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }
}
