<?php

namespace App\Http\Controllers;

use App\MarketplaceProducts;
use App\UserDetails;
use App\User;
use App\Company;
use App\Category;
use App\Industry;
use App\MarketplaceProductCategories;
use App\MarketplaceProductIndustries;
use App\MarketplaceProductGallery;
use App\MarketplaceDefaultSettings;
use App\Subscriptions;
use App\ProductUnique;
use App\TechnicalSpecificationOptions;
use App\UsersActivity;
use App\QuoteUnique;
use Carbon\Carbon;
use App\Message;
use App\Participant;
use App\Thread;
use App\Quotes;
use App\QuoteProducts;
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


class MarketplaceProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        if(Session::get('mp_order_name') != '')
        {
            if(isset($_REQUEST['mp_order_name']))
            {
                $order_name = $_REQUEST['mp_order_name'];
                $order_by = $_REQUEST['mp_order_by'];
                $hidden_val = $order_by;
                Session::put('mp_order_name', $order_name);
                Session::put('mp_order_by', $order_by);
                Session::put('mp_hidden_val', $hidden_val);
                Session::put('mp_hidden_name', $order_name);
            }
        }
        else
        {
            $order_name = 'created_at';
            $order_by = 'desc';
            $hidden_val = 'desc';
            $hidden_name = 'created_at';
            Session::put('mp_order_name', $order_name);
            Session::put('mp_order_by', $order_by);
            Session::put('mp_hidden_val', $hidden_val);
            Session::put('mp_hidden_name', $hidden_name);
        }

        $order_name = Session::get('mp_order_name');
        $order_by = Session::get('mp_order_by');
        $hidden_val = Session::get('mp_hidden_val');
        $hidden_name = Session::get('mp_hidden_name');
        //Paginating products
        $products = MarketplaceProducts::whereRaw('user_id = ?',array($user_id))->orderBy($order_name, $order_by)->paginate(15);
        foreach($products as $product)
        {
            $imageObj = MarketplaceProductGallery::whereRaw('product_id = ? AND image_type = ?',array($product->id,'base'))->first();
            if($imageObj)
            {
                $product->image = $imageObj->path;
            }
            else
            {
                $product->image = 'placeholder_png.jpg';
            }
        }
        $previousPageUrl = $products->previousPageUrl();//previous page url
        $nextPageUrl = $products->nextPageUrl();//next page url
        $lastPage = $products->lastPage(); //Gives last page number
        $total = $products->total();
        return view('marketplace.Products.index')->with([
            'products'=>$products,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            "total"=>$total,
            'mp_hidden_val' => $hidden_val,
            'mp_hidden_name' => $hidden_name
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view.
        $user_id = Auth::user()->id;
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }

        $defaultSettings = MarketplaceDefaultSettings::where('user_id',$user_id)->first();

        if($defaultSettings)
        {
            $defaultSettings->payment_accepted = explode(',',$defaultSettings->payment_accepted);
        }
        else{
            $defaultSettings = new MarketplaceDefaultSettings;
            $defaultSettings->shipping_terms = '';
            $defaultSettings->return_policy = '';
            $defaultSettings->payment_terms = '';
            $defaultSettings->payment_accepted = array();
        }

        $industries = Industry::all();
        return view('marketplace.Products.create')->with(['userData'=>$userData,'industries'=>$industries,'default'=>$defaultSettings]);
    }

    /**
     * for set seo friendly url
     */
    public function seo_friendly_url($string){
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
        return strtolower(trim($string, '-'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
        //Validations
        $this->validate($request, [
            'post_title' => 'required'
        ]);

        $input['name'] = $input['post_title'];
        $input['brand_name'] = $input['manufacturer_name'];

        //Creating accreditations and go back to index.

        $SpecificationArray = array();

        if(!empty($input['specification']))
        {
            $allSpecifications = explode(',',$input['specification']);
            foreach($allSpecifications as $specification)
            {
                if($specification != '')
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
        }
        if(Input::has('free_shipping'))
        {
            $input['free_shipping'] = 1;
        }
        else
        {
            $input['free_shipping'] = 0;
        }


        // for payment accepted
        if(Input::has('payment_accepted'))
        {
            $apyment_cnt = 0;
            $payment_str = '';
            foreach(Input::get('payment_accepted') as $payment)
            {
                $apyment_cnt++;
                if($apyment_cnt ==1)
                {
                    $payment_str .= $payment;
                }
                else
                {
                    $payment_str .= ",".$payment;
                }
            }
            $input['payment_accepted'] = $payment_str;
        }
        /// for free shipping counties
        if(Input::has('free_shipping_continents'))
        {
            $cntry_cnt = 0;
            $cntry_str = '';
            foreach(Input::get('free_shipping_continents') as $country)
            {
                $cntry_cnt++;
                if($cntry_cnt ==1)
                {
                    $cntry_str .= $country;
                }
                else
                {
                    $cntry_str .= ",".$country;
                }
            }
            $input['free_shipping_continents'] = $cntry_str;
        }
        if(Input::file('attachment_path'))
        {
            /// PDF file upload to public folder ///
            $destinationPath = 'public/marketplace/pdf'; // upload path
            $pdfName = str_replace(' ','_',$input['name']).'_'.rand(11111,99999). '.' .$request->file('attachment_path')->getClientOriginalExtension();
            $request->file('attachment_path')->move(
                base_path() . '/'.$destinationPath, $pdfName
            );

            $input['attachment_path'] = 'marketplace/pdf/'.$pdfName;
        }


        if(!empty($SpecificationArray))
        {
            $serialized_array=serialize($SpecificationArray);
        }
        else
        {
            $serialized_array=null;
        }
        $input['item_specifics_value'] = $serialized_array;

        /// For marketplace product location

        $input['location_city'] = $input['product_location'];

        if($input['company_id'] == '')
        {
            $input['company_id'] = null;
        }

        $input['is_active'] = 1;

        if(Input::has('multi_select_items'))
        {
            $input['multi_select'] = 1;
        }
        else
        {
            $input['multi_select'] = 0;
        }

        $unique = ProductUnique::first();
        $next = $unique->number+1;
        $unique->number = $next;
        $unique->save();

        $unique_number = 'IJP-'.$next;

        $input['unique_number'] = $unique_number;

        $input['external_url'] = $this->seo_friendly_url($input['name']).'-'.$unique_number;

        $marketplace_product = MarketplaceProducts::create($input);

        /// marketplace product categories
        $marketplaceproduct = MarketplaceProducts::find($marketplace_product->id);

        if(Input::has('product_categories'))
        {
            //first of all delete existing rows and create new one.
            MarketplaceProductCategories::whereRaw("product_id = ? ",array($marketplaceproduct->id))->delete();

            foreach(Input::get('product_categories') as $acc){
                $productCat = new MarketplaceProductCategories();
                $productCat->product_id = $marketplaceproduct->id;
                $productCat->category_id = $acc;
                $productCat->save();
            }
        }

        if(Input::has('product_industries'))
        {
            /// marketplcae product industries
            $marketplaceproduct = MarketplaceProducts::find($marketplace_product->id);

            //first of all delete existing rows and create new one.
            MarketplaceProductIndustries::whereRaw("product_id = ? ",array($marketplaceproduct->id))->delete();

            foreach(Input::get('product_industries') as $acc){
                if($acc != 'all')
                {
                    $industry = new MarketplaceProductIndustries();
                    $industry->product_id = $marketplaceproduct->id;
                    $industry->industry_id = $acc;
                    $industry->save();
                }
            }
        }


        if($input['logo'] != '')
        {
            $galleryImage = new MarketplaceProductGallery();
            $galleryImage->product_id = $marketplaceproduct->id;
            $galleryImage->path = $input['logo'];
            $galleryImage->save();
        }

        /// User Activity for message
        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'You posted '.$marketplaceproduct->name.' in the Market.';
        $usersActivity->activity_id = $marketplaceproduct->id;
        $usersActivity->activity_type = 'product';
        $usersActivity->creater_id = $user_id;
        $usersActivity->receiver_id = null;
        $usersActivity->save();

        $senderData = UserDetails::where('user_id',$user_id)->first();
        $sender = User::find($user_id);
        $product_title = $input['name'];
        $link = url('marketplaceproducts').'/'.$marketplace_product->id;
        Input::replace(array('email' => $sender->email,'name'=>$senderData->first_name.' '.$senderData->last_name));
        $data = array('name'=>Input::get('name'),'product_title'=>$product_title,'link'=>$link);
        Mail::send('admin.Emailtemplates.sellerNewProductListedMarketplace', $data, function($message){
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to(Input::get('email'), Input::get('name'))->subject('Your listed has been added to Indy John Market.');
        });

        return Redirect::to('marketplaceproducts/gallery/add/'.$marketplace_product->id)->with('message', 'Your Listing has been added to the Indy John Market.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show product Information
        $marketplaceproduct = MarketplaceProducts::find($id);

        // for set unique number
        if($marketplaceproduct->unique_number == '')
        {
            // for user unique number
            $unique = ProductUnique::first();
            $next = $unique->number+1;
            $unique->number = $next;
            $unique->save();

            $unique_number = 'IJP-'.$next;

            $marketplaceproduct->unique_number = $unique_number;
            $marketplaceproduct->save();

        }

        // for set external url if blank
        if($marketplaceproduct->external_link == '')
        {
            $marketplaceproduct->external_url = $this->seo_friendly_url($marketplaceproduct->name).'-'.$marketplaceproduct->unique_number;
            $marketplaceproduct->save();
        }

        $payment_accepted = $marketplaceproduct->payment_accepted;
        $marketplaceproduct->payment_accepted = explode(',',$payment_accepted);

        $free_shipping_continents = $marketplaceproduct->free_shipping_continents;
        $marketplaceproduct->free_shipping_continents = explode(',',$free_shipping_continents);

        if($marketplaceproduct->item_specifics_value != ''){
            if(@unserialize($marketplaceproduct->item_specifics_value))
            {
                $item_specifics_value = unserialize($marketplaceproduct->item_specifics_value);
                if(!empty($item_specifics_value))
                {
                    $marketplaceproduct->specification = $item_specifics_value;
                    $marketplaceproduct->options_count = count($marketplaceproduct->specification);

                }
                else
                {
                    $marketplaceproduct->specification = array();
                    $marketplaceproduct->options_count = 1;
                }
            }
            else
            {
                $marketplaceproduct->specification = array();
                $marketplaceproduct->options_count = 1;
            }

        }else{
            $marketplaceproduct->specification = array();
            $marketplaceproduct->options_count = 1;
        }

        $seller_user_id = $marketplaceproduct->user_id;
        $sellerUser = User::find($seller_user_id);
        if($sellerUser->account_member == 'gold')
        {
            $sellerUser->star = 'gold';
        }
        elseif($sellerUser->account_member == 'silver')
        {
            $sellerUser->star = 'silver';
        }
        else
        {
            $sellerUser->star = 'none';
        }
        $sellerUser->review_count = count($sellerUser->reviews);
        $sellerUser->endorse_count = count($sellerUser->endorsements);
        $sellerUser->message_count = count($sellerUser->messages);
        $SellerUserData = UserDetails::where('user_id',$seller_user_id)->first();
        $sellerUser->products = MarketplaceProducts::whereRaw('user_id = ? AND is_active = ?',array($seller_user_id,1))->paginate(10);
        $company_id = $SellerUserData->company_id;
        if($company_id != '')
        {
            $company = Company::find($company_id);
            $company->user = User::find($company->user_id);
            if($company->user->account_member == 'gold')
            {
                $company->star = 'gold';
            }
            elseif($company->user->account_member == 'silver')
            {
                $company->star = 'silver';
            }
            else
            {
                $company->star = 'none';
            }
            $sellerUser->company = $company;
        }
        else
        {
            $company = new Company;
            $company->star = 'none';
            $sellerUser->company = $company;
            $coworkers = array();
        }

        $marketplaceproduct->totalProducts = MarketplaceProducts::where('user_id',$sellerUser->id)->count();
        $marketplaceproduct->price = (float)$marketplaceproduct->price;
        if(!is_float($marketplaceproduct->price)){
            $marketplaceproduct->price = 0.00;
        }


        return view('marketplace.Products.view')->with(['product'=>$marketplaceproduct,'sellerUser'=>$sellerUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit marketplace product information.
        $marketplaceproduct = MarketplaceProducts::find($id);
        $free_shipping_continents = $marketplaceproduct->free_shipping_continents;
        $marketplaceproduct->free_shipping_continents = explode(',',$free_shipping_continents);

        $payment_accepted = $marketplaceproduct->payment_accepted;
        $marketplaceproduct->payment_accepted = explode(',',$payment_accepted);

        if($marketplaceproduct->item_specifics_value != ''){
            if(@unserialize($marketplaceproduct->item_specifics_value))
            {
                $item_specifics_value = unserialize($marketplaceproduct->item_specifics_value);
                if(!empty($item_specifics_value))
                {
                    $marketplaceproduct->specification = $item_specifics_value;
                    $marketplaceproduct->options_count = count($marketplaceproduct->specification);

                }
                else
                {
                    $marketplaceproduct->specification = array();
                    $marketplaceproduct->options_count = 1;
                }
            }
            else
            {
                $marketplaceproduct->specification = array();
                $marketplaceproduct->options_count = 1;
            }
        }else{
            $marketplaceproduct->specification = array();
            $marketplaceproduct->options_count = 1;
        }

        $industries = Industry::all();
        $selecteIndustrie = array();
        foreach($marketplaceproduct->industries as $industry)
        {
            $selecteIndustrie[] = $industry->industry->id;
        }

        $user_id = Auth::user()->id;
        $userData = UserDetails::where('user_id',$user_id)->first();
        return view('marketplace.Products.edit')->with(['product'=>$marketplaceproduct,'userData'=>$userData,'industries'=>$industries,'selecteIndustrie'=>$selecteIndustrie]);
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
        // update marketplace product
        $marketplaceproduct = MarketplaceProducts::find($id);

        //Validations
        $this->validate($request, [
            'post_title' => 'required',
            'manufacturer_name' => 'required',
            'account_type' => 'required',
            'price' => 'required|integer',
            'shipping_fee' => 'numeric',
            'user_id' => 'required',
        ]);
        if(Input::file('attachment_path'))
        {
            $this->validate($request, [
                'attachment_path'  => 'required|required_if:requestType,sick|mimes:pdf,jpg,png,gif,jpeg,doc,docx',
            ]);
        }
        $input = $request->all();

        $input['name'] = $input['post_title'];
        $input['brand_name'] = $input['manufacturer_name'];

        if(Input::has('free_shipping'))
        {
            $input['free_shipping'] = 1;
        }
        else
        {
            $input['free_shipping'] = 0;
        }

        // for payment accepted
        if(Input::has('payment_accepted'))
        {
            $apyment_cnt = 0;
            $payment_str = '';
            foreach(Input::get('payment_accepted') as $payment)
            {
                $apyment_cnt++;
                if($apyment_cnt ==1)
                {
                    $payment_str .= $payment;
                }
                else
                {
                    $payment_str .= ",".$payment;
                }
            }
            $input['payment_accepted'] = $payment_str;
        }

        if(Input::get('free_shipping_continents'))
        {
            $cntry_cnt = 0;
            $cntry_str = '';
            foreach(Input::get('free_shipping_continents') as $country)
            {
                $cntry_cnt++;
                if($cntry_cnt ==1)
                {
                    $cntry_str .= $country;
                }
                else
                {
                    $cntry_str .= ",".$country;
                }
            }
            $input['free_shipping_continents'] = $cntry_str;
        }
        if($input['company_id'] == '')
        {
            $input['company_id'] = null;
        }
        $SpecificationArray = array();

        if(!empty($input['item']))
        {
            foreach($input['item'] as $item)
            {
                if($item['lable'] != '')
                {
                    if(!empty($item['option']))
                    {

                        foreach($item['option'] as $opt)
                        {
                            if($opt != '')
                            {
                                $SpecificationArray[$item['lable']][] = $opt;
                            }
                        }
                    }
                }

            }
        }

        if(Input::file('attachment_path'))
        {
            $old_file = $marketplaceproduct->attachment_path;
            //echo $old_file; exit(0);
            if($old_file != '')
            {
                unlink('public/'.$old_file);
            }

            /// PDF file upload to public folder ///
            $destinationPath = 'public/marketplace/pdf'; // upload path
            $pdfName = str_replace(' ','_',$input['name']).'_'.rand(11111,99999). '.' .$request->file('attachment_path')->getClientOriginalExtension();
            $request->file('attachment_path')->move(
                base_path() . '/'.$destinationPath, $pdfName
            );
            $input['attachment_path'] = 'marketplace/pdf/'.$pdfName;
        }

        if(!empty($SpecificationArray))
        {
            $serialized_array=serialize($SpecificationArray);
        }
        else
        {
            $serialized_array=null;
        }

        $input['item_specifics_value'] = $serialized_array;
        $input['is_active'] = 1;

        /// For marketplace product location
        //$input['location_city'] = $input['product_location'];

        if($input['company_id'] == '')
        {
            $input['company_id'] = null;
        }

        ///////////////
        $marketplaceproduct->fill($input)->save();

        /// marketplace product categories
        $marketplace_product = MarketplaceProducts::find($marketplaceproduct->id);

        //first of all delete existing rows and create new one.
        MarketplaceProductCategories::whereRaw("product_id = ? ",array($marketplace_product->id))->delete();

        foreach(Input::get('product_categories') as $acc){
            $productCat = new MarketplaceProductCategories();
            $productCat->product_id = $marketplace_product->id;
            $productCat->category_id = $acc;
            $productCat->save();
        }

        /// marketplcae product industries
        $marketplace_product = MarketplaceProducts::find($marketplaceproduct->id);

        //first of all delete existing rows and create new one.
        MarketplaceProductIndustries::whereRaw("product_id = ? ",array($marketplace_product->id))->delete();

        foreach(Input::get('product_industries') as $acc){
            $industry = new MarketplaceProductIndustries();
            $industry->product_id = $marketplace_product->id;
            $industry->industry_id = $acc;
            $industry->save();
        }

        // redirect to index page
        return Redirect::to('marketplace/mylistings')->with('message', 'Your market listing details have been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Product
        $marketplaceproduct = MarketplaceProducts::find($id);
        $old_file = $marketplaceproduct->attachment_path;
        if($old_file != '')
        {
            unlink('public/'.$old_file);
        }

        $image_path = 'public/marketplace/product/images/';
        $galleryImages = MarketplaceProductGallery::where('product_id',$id)->get();
        foreach($galleryImages as $image)
        {
            $full_path = '';
            $full_path = $image_path.$image->path;
            if($full_path != '')
            {
                unlink($full_path);
            }
        }

        /// User Activity for message
        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'You deleted '.$marketplaceproduct->name.' from the market.';
        $usersActivity->activity_id = $marketplaceproduct->id;
        $usersActivity->activity_type = 'product_delete';
        $usersActivity->creater_id = $marketplaceproduct->user_id;
        $usersActivity->receiver_id = null;
        $usersActivity->save();

        $marketplaceproduct->delete();
        return Redirect::to('marketplace/mylistings')->with('message', 'Your market listing has been deleted.');
    }

    /**
     * Marketplace Product Search View
     */
    public function productSearchView()
    {
        $user_id = Auth::user()->id;
        $userData = UserDetails::where('user_id',$user_id)->first();
        if(isset($_REQUEST['search']))
        {
            $search = str_replace('+',' ',$_REQUEST['search']);
            $marketplaceProducts = MarketplaceProducts::whereRaw("(name LIKE '%$search%' OR brand_name LIKE '%$search%') AND is_active = 1 ")->get()->toArray();

        }
        else
        {
            $search = '';
            $marketplaceProducts = array();
        }
        return view('marketplace.search')->with(['userData'=>$userData,'products'=>$marketplaceProducts,'search'=>$search]);
    }

    public function productSearchResult()
    {
        $user_id = Auth::user()->id;
        $userData = UserDetails::where('user_id',$user_id)->first();
        if(isset($_REQUEST['search']))
        {
            $search = str_replace('+',' ',$_REQUEST['search']);
            $marketplaceProducts = MarketplaceProducts::whereRaw("(name LIKE '%$search%' OR brand_name LIKE '%$search%') AND is_active = 1 ")->paginate(12);

            foreach($marketplaceProducts as $product)
            {
                $imageObj = MarketplaceProductGallery::where('product_id',$product->id)->first();
                if($imageObj)
                {
                    $product->image = $imageObj->path;
                }
                else
                {
                    $product->image = 'placeholder_png.jpg';
                }

                $product->user = User::find($product->user_id);
                $subscription = Subscriptions::where('user_id',$product->user_id)->orderBy('id','desc')->first();
                if($subscription)
                {
                    if($subscription->name == 'Buyer Plus Package' || $subscription->name == 'Supplier Gold Package')
                    {
                        $product->star = 'gold';
                    }
                    elseif($subscription->name == 'Supplier Silver Package')
                    {
                        $product->star = 'silver';
                    }
                    else
                    {
                        $product->star = 'none';
                    }
                }
                else
                {
                    $product->star = 'none';
                }
            }

            $previousPageUrl = $marketplaceProducts->previousPageUrl();
            if($previousPageUrl != '')
            {
                $previousPageUrl = $marketplaceProducts->previousPageUrl().'&search='.$_REQUEST['search'];//previous page url
            }

            $nextPageUrl = $marketplaceProducts->nextPageUrl();//next page url
            if($nextPageUrl != '')
            {
                $nextPageUrl = $marketplaceProducts->nextPageUrl().'&search='.$_REQUEST['search'];//next page url
            }


            $lastPage = $marketplaceProducts->lastPage(); //Gives last page number
            $total = $marketplaceProducts->total();
        }
        else
        {
            $search = '';
            $marketplaceProducts = new MarketplaceProducts;

            $previousPageUrl = '';//previous page url
            $nextPageUrl = '';//next page url
            $lastPage = ''; //Gives last page number
            $total = '';
        }



        return view('marketplace.searchResult')->with([
            'userData'=>$userData,
            'products'=>$marketplaceProducts,
            'search'=>$search,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            "total"=>$total,
        ]);
    }

    /**
     * search products
     *
     * @return \Illuminate\Http\Response
     */
    public function searchMarketplaceProducts(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
        ]);

        $search = str_replace(' ',"+",Input::get('search'));
        return Redirect::to('product/search?query='.$search);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productAdditionalInfo($id){

        $product = MarketplaceProducts::find($id);
        return view('marketplace.Products.AdditionalInfo.index')->with(['product'=>$product]);
    }

    /**
     * Get category tree in form of JsTree
     *
     * @param  int  $id
     * @return JSON response
     */
    public function getCategoryTree($id){
        $marketplaceproduct = MarketplaceProducts::find($id);
        $current = $marketplaceproduct->categories()->get(array('category_id'))->toArray();

        $result = array();
        foreach($current as $value){
            $result[] = $value["category_id"];
        }
        $rootCategories = Category::whereRaw("parent_id IS NULL")->get();
        $resultArray = array();
        foreach($rootCategories as $rootCategory){
            $subCategories = $this->getSubCategories($rootCategory->id,$id);
            $selected = false;
            if(in_array($rootCategory->id,$result)){
                $selected = true;
            }
            $resultArray[] = array("text"=>$rootCategory->name,"state"=>array("selected"=>$selected),"data"=>$rootCategory->id,"is_active"=>$rootCategory->is_active,"parent_id"=>null,"children"=>$subCategories);
        }
        return $resultArray;
    }

    /**
     * Get sub category of specific category
     *
     * @param  int  $catId
     * @param  int  $currentCategoryId
     * @return JSON response
     */
    public function getSubCategories($catId,$currentCategoryId){
        $marketplaceproduct = MarketplaceProducts::find($currentCategoryId);
        $current = $marketplaceproduct->categories()->get(array('category_id'))->toArray();

        $result = array();
        foreach($current as $value){
            $result[] = $value["category_id"];
        }
        $categories = Category::where("parent_id","=",$catId)->get();
        if(count($categories) == 0){
            return array();
        }else{
            $resultArray = array();
            foreach($categories as $category){
                $subCategories = $this->getSubCategories($category->id, $currentCategoryId);
                $selected = false;
                if(in_array($category->id,$result)){
                    $selected = true;
                }
                $resultArray[] = array("text"=>$category->name,"state"=>array("selected"=>$selected),"data"=>$category->id,"is_active"=>$category->is_active,"parent_id"=>$catId,"children"=>$subCategories);
            }
            return $resultArray;
        }
    }

    /**
     * Add more product categories
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addProductCategory($id){
        $marketplaceproduct = MarketplaceProducts::find($id);

        $categories = array();
        return view('marketplace.Products.AdditionalInfo.Category.create')->with(['product'=>$marketplaceproduct,'categories'=>$categories]);
    }

    /**
     * Search Category for add in marketplace product
     */
    public function searchCategories()
    {
        if(isset($_GET['q']))
        {
            $search = $_GET['q'];
            $categories = Category::whereRaw("(name LIKE '%$search%') AND is_active = 1 ")->get();
            $categoryArray = array();
            foreach($categories as $category)
            {
                $dataArray = array();
                $dataArray['id'] = $category->id;
                $dataArray['full_name'] = $category->name;
                $categoryArray[] = $dataArray;
            }
        }
        else
        {
            $categoryArray = array();
        }

        $ajaxArray = array();
        $ajaxArray['incomplete_results'] = false;
        $ajaxArray['items'] = $categoryArray;
        return Response::json($ajaxArray);
    }

    /**
     * Save more product categories
     *
     * @return \Illuminate\Http\Response
     */
    public function saveProductCategory(){

        try{

            $marketplaceproduct = MarketplaceProducts::find(Input::get('product_id'));

            //first of all delete existing rows and create new one.
            MarketplaceProductCategories::whereRaw("product_id = ? ",array($marketplaceproduct->id))->delete();

            foreach(Input::get('product_categories') as $acc){
                $productCat = new MarketplaceProductCategories();
                $productCat->product_id = $marketplaceproduct->id;
                $productCat->category_id = $acc;
                $productCat->save();
            }
            $ajaxDataArray = array();
            $ajaxDataArray['success'] = 1;
            $ajaxDataArray['url'] = 'marketplaceproducts/info/'.$marketplaceproduct->id;
            Session::flash('message','Your market listing has posted.');
            //return Response::json($ajaxDataArray);
        }
        catch (\Exception $e) {
            //echo '<pre>';print_r($e);
            //exit(0);
            Session::flash('error','Faild to save data');
            $ajaxDataArray = array();
            $ajaxDataArray['success'] = 0;
            $ajaxDataArray['url'] = 'marketplaceproducts/info/categories/'.$marketplaceproduct->id;
            Session::flash('message','Your market listing has posted.');
            //return Response::json($ajaxDataArray);
        }

        return Redirect::to('marketplaceproducts/info/'.$marketplaceproduct->id)->with('message', 'Your market listing product category has been added.');
    }

    /**
     * Add more product industry
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Search industries for add in marketplace product
     */
    public function searchIndustry()
    {
        if(isset($_GET['q']))
        {
            $search = $_GET['q'];
            $industries = Industry::whereRaw("(name LIKE '%$search%') AND is_active = 1 ")->get();
            $industryArray = array();
            foreach($industries as $industry)
            {
                $dataArray = array();
                $dataArray['id'] = $industry->id;
                $dataArray['full_name'] = $industry->name;
                $industryArray[] = $dataArray;
            }
        }
        else
        {
            $industryArray = array();
        }

        $ajaxArray = array();
        $ajaxArray['incomplete_results'] = false;
        $ajaxArray['items'] = $industryArray;
        return Response::json($ajaxArray);
    }

    public function addProductIndustries($id){
        $marketplaceproduct = MarketplaceProducts::find($id);
        $current = $marketplaceproduct->industries()->get(array('industry_id'))->toArray();
        $result = array();
        foreach($current as $value){
            $result[] = $value["industry_id"];
        }
        $industries = Industry::whereNotIn("id",$result)->get();
        return view('marketplace.Products.AdditionalInfo.Industry.create')->with(['product'=>$marketplaceproduct,'industries'=>$industries]);
    }

    /**
     * Save more product industries
     *
     * @return \Illuminate\Http\Response
     */
    public function saveProductIndustries(){
        $marketplaceproduct = MarketplaceProducts::find(Input::get('product_id'));

        //first of all delete existing rows and create new one.
        MarketplaceProductIndustries::whereRaw("product_id = ? ",array($marketplaceproduct->id))->delete();

        foreach(Input::get('product_industries') as $acc){
            $industry = new MarketplaceProductIndustries();
            $industry->product_id = $marketplaceproduct->id;
            $industry->industry_id = $acc;
            $industry->save();
        }
        return Redirect::to('marketplaceproducts/info/'.$marketplaceproduct->id)->with('message', 'Your market listing has posted.');
    }

    /**
     * View product gallery
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productGallery($id){
        $marketplaceproduct = MarketplaceProducts::find($id);
        return view('marketplace.Products.Gallery.index')->with(['product'=>$marketplaceproduct]);
    }

    /**
     * View product gallery
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addImagesToProductGallery($id){
        $marketplaceproduct = MarketplaceProducts::find($id);
        return view('marketplace.Products.Gallery.add')->with(['product'=>$marketplaceproduct]);
    }

    public function addNewOption($id)
    {
        $current_id = $id;
        $next_id = $id + 1;
        $html = '';
        $html .= '<div id="optionsmain_'.$current_id.'" class="col-md-12 paddin-npt padding-top">
                    <div class="col-md-6">
                        <input class="col-md-9 form-control option-inputs" name="item['.$current_id.'][lable]" placeholder="Enter the Field Label" />
                        <a href="javascript:void(0)" id="removemain_'.$current_id.'" style="float: left;" onclick="removeMainOption(id)"><i class="fa fa-remove font-red"></i>  </a>
                    </div>
                    <div class="col-md-6">
                        <div id="option_'.$current_id.'_1" class="paddin-bottom option-div">
                            <input name="item['.$current_id.'][option][1]" class="col-md-9 form-control option-inputs" placeholder="Enter the Value" />
                            <a href="javascript:void(0)" id="addsub_'.$current_id.'_2" onclick="addSubOption(id)" style="float: left;"><i class="fa fa-plus-circle"></i>  </a>
                        </div>
                        <div id="suboption_'.$current_id.'">
                        </div>
                    </div>
                </div>';
        $ajaxArray = array();
        $ajaxArray['success'] = true;
        $ajaxArray['html'] = $html;
        $ajaxArray['next_id'] = $next_id;
        return Response::json($ajaxArray);
    }

    public function addNewSubOption($main_id,$id)
    {
        $current_id = $id;
        $next_id = $id + 1;
        $html = '';
        $html .= '<div id="option_'.$main_id.'_'.$current_id.'" class="paddin-bottom option-div">
                    <input name="item['.$main_id.'][option]['.$current_id.']" class="col-md-9 form-control option-inputs" placeholder="Option Value" />
                    <a href="javascript:void(0)" style="float: left;" id="remove_'.$main_id.'_'.$current_id.'" onclick="removeSubOption(id)"><i class="fa fa-remove font-red"></i>  </a>
                </div>';
        $ajaxArray = array();
        $ajaxArray['success'] = true;
        $ajaxArray['html'] = $html;
        $ajaxArray['next_id'] = $next_id;
        return Response::json($ajaxArray);
    }

    /**
     * Inactive market place product
     */
    public function incativeProduct($id)
    {
        $marketplaceproduct = MarketplaceProducts::find($id);
        $marketplaceproduct->is_active = 0;
        $marketplaceproduct->save();
        return Redirect::to('marketplace/mylistings')->with('message', 'Selected market listing has been disabled.');
    }

    /**
     * Active market place product
     */
    public function activeProduct($id)
    {
        $marketplaceproduct = MarketplaceProducts::find($id);
        $marketplaceproduct->is_active = 1;
        $marketplaceproduct->save();
        return Redirect::to('marketplace/mylistings')->with('message', 'Selected market listing has been activated.');
    }

    /**
     * marketplace default settings
     */
    public function addDefaultSettings()
    {
        $user_id = Auth::user()->id;
        $defaultSettings = MarketplaceDefaultSettings::where('user_id',$user_id)->first();

        if($defaultSettings)
        {
            $defaultSettings->payment_accepted = explode(',',$defaultSettings->payment_accepted);
        }
        else{
            $defaultSettings = new MarketplaceDefaultSettings;
            $defaultSettings->shipping_terms = '';
            $defaultSettings->return_policy = '';
            $defaultSettings->payment_terms = '';
            $defaultSettings->payment_accepted = array();
        }
        return view('marketplace.defaultsettings')->with(['default' => $defaultSettings,'user_id' => $user_id]);
    }

    /**
     * marketplace default settings save
     */
    public function saveDefaultSettings()
    {
        $user_id = Input::get('user_id');
        $input = Input::all();
        $defaultSettings = MarketplaceDefaultSettings::where('user_id',$user_id)->first();

        if(Input::has('payment_accepted'))
        {
            $cntry_cnt = 0;
            $cntry_str = '';
            foreach(Input::get('payment_accepted') as $payment)
            {
                $cntry_cnt++;
                if($payment ==1)
                {
                    $cntry_str .= $payment;
                }
                else
                {
                    $cntry_str .= ",".$payment;
                }
            }
            $input['payment_accepted'] = $cntry_str;
        }
        if($defaultSettings)
        {
            $defaultSettings->fill($input)->save();
        }
        else{
            MarketplaceDefaultSettings::create($input);
        }

        return Redirect::to('marketplaceproducts/product/defaultsettings')->with('message', 'Your settings have been saved.');
    }

    /**
     * marketplace product front view
     */
    public function marketplaceFrontProductView($id)
    {
        //Show product Information
        $marketplaceproduct = MarketplaceProducts::find($id);

        $payment_accepted = $marketplaceproduct->payment_accepted;
        $marketplaceproduct->payment_accepted = explode(',',$payment_accepted);

        $free_shipping_continents = $marketplaceproduct->free_shipping_continents;
        $marketplaceproduct->free_shipping_continents = explode(',',$free_shipping_continents);

        if($marketplaceproduct->item_specifics_value != ''){
            $item_specifics_value = unserialize($marketplaceproduct->item_specifics_value);
            if(!empty($item_specifics_value))
            {
                $marketplaceproduct->specification = $item_specifics_value;
                $marketplaceproduct->options_count = count($marketplaceproduct->specification);

            }
            else
            {
                $marketplaceproduct->specification = array();
                $marketplaceproduct->options_count = 1;
            }
        }else{
            $marketplaceproduct->specification = array();
            $marketplaceproduct->options_count = 1;
        }
        return view('marketplace.front.view')->with(['product'=>$marketplaceproduct]);
    }

    public function techSpecificationOptions()
    {
        $allTechSpecificationOpt = TechnicalSpecificationOptions::all();
        $ajaxArray = array();
        foreach($allTechSpecificationOpt as $opt)
        {
            $ajaxArray[] = $opt->keyword;
        }
        return Response::json($ajaxArray);
    }

    public function sendMessage(){
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        $thread= new Thread();
        $thread->subject = Input::get('subject');
        $thread->save();
        // Message
        $message= new Message();
        $message->thread_id = $thread->id;
        $message->user_id = $user_id;
        $message->body = Input::get('body');
        $message->save();
        // Sender
        $message= new Participant();
        $message->thread_id = $thread->id;
        $message->user_id = $user_id;
        $message->last_read = new Carbon;
        $message->save();
        // Recipient

        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'Message for Seller';
        $usersActivity->activity_id = $thread->id;
        $usersActivity->activity_type = 'message';
        $usersActivity->creater_id = $user_id;
        $usersActivity->receiver_id = Input::get('receiver_id');
        $usersActivity->save();
    }

    public function marketplaceProductRequestQuote(){
        $unique = QuoteUnique::first();
        $next = $unique->number+1;
        $unique->number = $next;
        $unique->save();

        $uniqueNumber = 'IJR-'.$next;
        $product = MarketplaceProducts::find(Input::get('product_id'));

        $quote = new Quotes();
        $quote->title = "Quote for Product - ".$product->name;
        $quote->specifications = Input::get('additional_notes');
        $quote->verified_only =  0;
        $quote->privacy =  0;
        $quote->expiry_date =  date('Y-m-d', strtotime("+7 day"));
        $quote->request_area = 0;
        $quote->additional_file = '';
        $quote->status = 1;
        $quote->created_by = Auth::user()->id;
        $quote->process_satus = 1;
        $quote->unique_number = $uniqueNumber;
        $quote->qty_request = 1;
        $quote->address = '';
        $quote->address2 = '';
        $quote->city = '';
        $quote->state = '';
        $quote->zip = '';
        $quote->country = '';

        $quote->save();

        $QuoteProducts = new QuoteProducts();
        $QuoteProducts->quote_id = $quote->id;
        $QuoteProducts->product_id = $product->id;
        $QuoteProducts->save();

        return Redirect::back()->with('message', 'Quote Request Submitted.');
    }
}
