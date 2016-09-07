<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\UserDetails;
use App\UsersActivity;
use App\AppsCountries;
use App\Referrals;
use App\ReferralPayment;
use App\SubscriptionPlans;
use App\Subscriptions;
use App\Company;
use App\QuotetekUserVerification;
use App\QuotetekCompanyVerification;
use App\PaymentDetails;
use App\StripeCards;
use App\TransactionUnique;
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
use Cartalyst\Stripe\Laravel\Facades\Stripe; 





use PayPal\EBLBaseComponents\ManageRecurringPaymentsProfileStatusRequestDetailsType;
use PayPal\PayPalAPI\ManageRecurringPaymentsProfileStatusReq;
use PayPal\PayPalAPI\ManageRecurringPaymentsProfileStatusRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
     * Account Payment Information
     */
    public function viewPaymentInfo()
    {
        $user_id = Auth::user()->id;
        $paymentDetails = PaymentDetails::where('user_id',$user_id)->paginate(15);

        $previousPageUrl = $paymentDetails->previousPageUrl();//previous page url
        $nextPageUrl = $paymentDetails->nextPageUrl();//next page url
        $lastPage = $paymentDetails->lastPage(); //Gives last page number
        $total = $paymentDetails->total();

        return view('account.paymentInfo')->with(['paymentDetails'=>$paymentDetails,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Account Payment History
     */
    public function viewPaymentHistory()
    {
        $user_id = Auth::user()->id;

        $paymentDetails = PaymentDetails::where('user_id',$user_id)->orWhere('paid_for',$user_id)->orderBy('id','desc')->paginate(15);

        foreach($paymentDetails as $paymentDetail)
        {
            $user_id = $paymentDetail->user_id;

            $user = User::find($user_id);

            $paymentDetail->user = $user;
        }

        $previousPageUrl = $paymentDetails->previousPageUrl();//previous page url
        $nextPageUrl = $paymentDetails->nextPageUrl();//next page url
        $lastPage = $paymentDetails->lastPage(); //Gives last page number
        $total = $paymentDetails->total();

        return view('account.paymentHistory')->with(['paymentDetails'=>$paymentDetails,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * user packages view
     */
    public function viewPackages()
    {
        $user_id = Auth::user()->id;

        $currentDate = date('Y-m-d');

        $activeBuyerPackage = Subscriptions::whereRaw('user_id = ? AND status = ?',array($user_id,'Active'))->whereIn('plan_id', [1, 6])->first();

        if(empty($activeBuyerPackage)){
            $activeBuyerPackage = Subscriptions::whereRaw('user_id = ? AND status = ? AND subscription_end > ?',array($user_id,'Canceled',date('Y-m-d')))->whereIn('plan_id', [1, 6])->first();
        }

        if(empty($activeBuyerPackage)){
            $packages = Subscriptions::whereRaw('user_id = ? AND status = ?', array($user_id, 'Completed'))->whereIn('plan_id', [1, 6])->paginate(15);
        }else{
            $packages = Subscriptions::whereRaw('user_id = ? AND (status = ? OR status = ?)', array($user_id, 'Completed', 'Canceled'))->whereIn('plan_id', [1, 6])->paginate(15);
        }


        $previousPageUrl = $packages->previousPageUrl();//previous page url
        $nextPageUrl = $packages->nextPageUrl();//next page url
        $lastPage = $packages->lastPage(); //Gives last page number
        $total = $packages->total();

        return view('account.package')->with(['activeBuyerPackage'=>$activeBuyerPackage, 'packages'=>$packages,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * user packages view
     */
    public function viewSupplierPackages()
    {
        $user_id = Auth::user()->id;
        $currentDate = date('Y-m-d');
        $activeSupplierPackage = Subscriptions::whereRaw('user_id = ? AND status = ?',array($user_id,'Active'))->whereIn('plan_id', [3, 4, 7, 8])->first();

        if(empty($activeSupplierPackage)){
            $activeSupplierPackage = Subscriptions::whereRaw('user_id = ? AND status = ? AND subscription_end > ?',array($user_id,'Canceled',date('Y-m-d')))->whereIn('plan_id', [3, 4, 7, 8])->first();
        }

        if(empty($activeSupplierPackage)){
            $packages = Subscriptions::whereRaw('user_id = ? AND status = ?', array($user_id, 'Completed'))->whereIn('plan_id', [3, 4, 7, 8])->paginate(15);
        }else{
            $packages = Subscriptions::whereRaw('user_id = ? AND (status = ? OR status = ?)', array($user_id, 'Completed', 'Canceled'))->whereIn('plan_id', [3, 4, 7, 8])->paginate(15);
        }

        $previousPageUrl = $packages->previousPageUrl();//previous page url
        $nextPageUrl = $packages->nextPageUrl();//next page url
        $lastPage = $packages->lastPage(); //Gives last page number
        $total = $packages->total();

        return view('account.package-supplier')->with(['activeSupplierPackage'=>$activeSupplierPackage, 'packages'=>$packages,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Unsubscribe package
     */
    public function unsubscribePackages($subscription_id)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $Subscriptions = Subscriptions::find($subscription_id);

        if($Subscriptions->stripe_id != null){
            //Its a stripe subscription.
            $strip_key = env('STRIPE_SECRET', '');

            \Stripe\Stripe::setApiKey($strip_key);

            $customer = \Stripe\Customer::retrieve($Subscriptions->stripe_id);
            $subscription = $customer->subscriptions->retrieve($Subscriptions->stripe_plan);
            $subscription->cancel();

            if($subscription)
            {
                $SubScriptionResponse =  $subscription->__toArray(true);

                if($SubScriptionResponse['status'] == 'canceled'){
                    $Subscriptions->is_canceled = 1;
                    $Subscriptions->status = 'Canceled';
                    $Subscriptions->canceled_on = date('Y-m-d',$SubScriptionResponse['canceled_at']);
                    $Subscriptions->save();
                    return Redirect::back()->with('message', 'Your subscription is canceled.');
                }
            }
            else
            {
                return Redirect::back()->with('message', 'There was a problem with this action. Please try again.');
            }
        }else{
            $config = array (
                'mode' => 'sandbox' ,
                'acct1.UserName' => 'test_api1.quotetek.com',
                'acct1.Password' => '1403115389',
                'acct1.Signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AWRfIfgWS9Rar0.DLJQL1NXqh2M8'
            );
            $manageRPPStatusReqestDetails = new ManageRecurringPaymentsProfileStatusRequestDetailsType();
            $manageRPPStatusReqestDetails->Action = 'Cancel';
            $manageRPPStatusReqestDetails->ProfileID = $Subscriptions->paypal_payer_id;
            $manageRPPStatusReqest = new ManageRecurringPaymentsProfileStatusRequestType();
            $manageRPPStatusReqest->ManageRecurringPaymentsProfileStatusRequestDetails = $manageRPPStatusReqestDetails;
            $manageRPPStatusReq = new ManageRecurringPaymentsProfileStatusReq();
            $manageRPPStatusReq->ManageRecurringPaymentsProfileStatusRequest = $manageRPPStatusReqest;
            $paypalService = new PayPalAPIInterfaceServiceService($config);
            try {
                $manageRPPStatusResponse = $paypalService->ManageRecurringPaymentsProfileStatus($manageRPPStatusReq);
                if($manageRPPStatusResponse->Ack == 'Success'){
                    $Subscriptions->is_canceled = 1;
                    $Subscriptions->status = 'Canceled';
                    $Subscriptions->canceled_on = date('Y-m-d',$SubScriptionResponse['canceled_at']);
                    $Subscriptions->save();
                    return Redirect::back()->with('message', 'Your subscription is canceled.');
                }else{
                    return Redirect::back()->with('message', 'There was a problem with this action. Please try again.');
                }
            } catch (Exception $ex) {
                return Redirect::back()->with('message', 'There was a problem with this action. Please try again.');
            }

        }
    }

    /**
     * package detail
     */
    public function packageDetail($id)
    {
        $package = Subscriptions::find($id);

        $strip_key = env('STRIPE_SECRET', '');
        \Stripe\Stripe::setApiKey($strip_key);

        $customer = \Stripe\Customer::retrieve($package->stripe_id);
        $subscription = $customer->subscriptions->retrieve($package->stripe_plan);
        $response =  $subscription->__toArray(true);

        $html = '';
        $html .= '<div class="modal-dialog">
                    <div class="modal-content" >
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <p>Package Name: <b>'.$response['plan']['name'].'</b></p>
                            <p>Amount: <b>'.$package->amount.'</b></p>
                            <p>Status: <b>'.$response['status'].'</b></p>
                            <p>Trial End: <b>'.$response['trial_end'].'</b></p>
                            <p>Subscribed At: <b>'.date('Y-m-d',strtotime($package->created_at)).'</b></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div></div></div>';
        $ajaxDataArray = array();
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }

    /**
     * add new package
     */
    public function addPackages()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $strip_public_key = env('STRIPE_PUBLIC_KEY', '');
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData->company_id != '')
        {
            $company = Company::find($userData->company_id);
            $userData->company_name = $company->name;
        }
        else
        {
            $userData->company_name = '';
        }
        $billingPlans = array();
        if($userData->account_type == 'buyer')
        {
            $billingPlans = SubscriptionPlans::where('plan_type','buyer')->get();
        }
        elseif($userData->account_type == 'Seller')
        {
            $billingPlans = SubscriptionPlans::where('plan_type','supplier')->get();
        }

        return view('account.billingPlans')->with(['user'=>$user,'userData'=>$userData,'billingPlans'=>$billingPlans,'strip_public_key'=>$strip_public_key]);
    }

    /**
     * Save user Billing Plan
     */
    public function saveUserPackage(Request $request)
    {
        $payment = Input::get('payment') / 100;
        $plan = Input::get('plan');
        $type = Input::get('type');

        $input = $request->all();
        $user_id = Auth::user()->id;
        $isForTeamMember = false;
        $manager_id = null;
        if(Input::get('team_member_id') != null){
            $user_id = Input::get('team_member_id');
            $isForTeamMember = true;
            $manager_id = Auth::user()->id;
        }
        $user = User::find($user_id);
        $card_token = $input['card_token'];
        $strip_key = env('STRIPE_SECRET', '');
        \Stripe\Stripe::setApiKey($strip_key);
        $this->validate($request, [
            'billing_plan' => 'required',
        ]);


        if($user->stripe_id == '')
        {
            $result = \Stripe\Customer::create(array(
                "description" => "Customer for ".$user->email,
                "email"=>$user->email,
                "source" => $card_token // obtained with Stripe.js
            ));
            if($result)
            {
                $response =  $result->__toArray(true);
                $user->stripe_id = $response['id'];
                $user->save();

            }
            else
            {
                return Redirect::to('user/packages')->with('message', 'There was a problem processing your payment. Please verify payment details and resubmit.');
            }
        }

        $billingPlan = SubscriptionPlans::find($input['billing_plan']);

        $account_plan = $billingPlan->plan_key;

        $member_type = '';
        if($billingPlan->name == 'Supplier Gold Package' || $billingPlan->name == 'Supplier Gold Annual')
        {
            $member_type = 'gold';
            $jobs = 15;
            $user->account_member = $member_type;
            $user->job_post = $jobs;
            $user->save();
        }
        elseif($billingPlan->name == 'Supplier Silver Package' || $billingPlan->name == 'Supplier Silver Annual')
        {
            $member_type = 'silver';
            $jobs = 5;
            $user->account_member = $member_type;
            $user->job_post = $jobs;
            $user->save();
        }else{
            $user->account_plan = $account_plan;
            $jobs = 15;
            $user->job_post = $jobs;
            $user->save();
        }
        if(floatval($billingPlan->amount) > 0)
        {
            $charge = \Stripe\Charge::create(array(
                "amount" => floatval($billingPlan->amount),
                "currency" => "usd",
                "customer" => $user->stripe_id, // obtained with Stripe.js
                "description" => "Charge for ".$user->email
            ));
        }
        else
        {
            $charge = true;
        }
        if($charge)
        {
            if($billingPlan->amount > 0)
            {
                $charges = $charge->__toArray(true);
                $amount_chanrge = $charges['amount'];
                $invoice_id = $charges['invoice'];
                $charge_id = $charges['id'];
                $balance_transaction = $charges['balance_transaction'];
            }
            else
            {
                $amount_chanrge = 0;
                $invoice_id = '';
                $charge_id = '';
                $balance_transaction = '';
            }
            $cu = \Stripe\Customer::retrieve($user->stripe_id);
            $subscriptionResult = $cu->subscriptions->create(array("plan" => $billingPlan->plan_key));
            if($subscriptionResult)
            {
                $SubScriptionResponse =  $subscriptionResult->__toArray(true);
                // payment details store

                // for user unique number
                $unique = TransactionUnique::first();
                $next = $unique->number+1;
                $unique->number = $next;
                $unique->save();

                $unique_number = 'IJV-'.$next;

                $paymentDetails = new PaymentDetails;
                $paymentDetails->user_id = $user_id;
                $paymentDetails->unique_number = $unique_number;

                if($isForTeamMember == true){
                    $paymentDetails->paid_for = $manager_id;
                }
                $paymentDetails->payment_type = $input['card_type'];
                $paymentDetails->detail = 'Payment for '.$SubScriptionResponse['plan']['name'];
                $paymentDetails->amount = $amount_chanrge;
                $paymentDetails->card_number = $input['cardNumber'];
                $paymentDetails->card_last_4 = $input['card_last_4'];
                $paymentDetails->expiry = $input['cardExpiry'];
                $paymentDetails->cvv = $input['cardCVC'];
                $paymentDetails->save();


                //check here if user have any active subscription, if yes then mark as completed and send end date as current date.

                $billingPlan = SubscriptionPlans::find($input['billing_plan']);

                $account_plan = $billingPlan->plan_key;


                if($account_plan == 'buyerplus' || $account_plan == 'buyerplus_annual'){
                    $activeBuyerPackage = Subscriptions::whereRaw('user_id = ? AND status = ?',array($user_id,'Active'))->whereIn('plan_id', [1, 6])->first();
                    if(!empty($activeBuyerPackage)){
                        $activeBuyerPackage->status	 = "Completed";
                        $activeBuyerPackage->subscription_end = date('Y-m-d');
                        $activeBuyerPackage->save();
                    }
                }

                if($account_plan == 'suppliersilver' || $account_plan == 'suppliersilver' || $account_plan == 'suppliergold' || $account_plan == 'suppliergold_annual'){
                    $activeSupplierPackage = Subscriptions::whereRaw('user_id = ? AND status = ?',array($user_id,'Active'))->whereIn('plan_id', [3, 4, 7, 8])->first();

                    if(!empty($activeSupplierPackage)){
                        $activeSupplierPackage->status	 = "Completed";
                        $activeSupplierPackage->subscription_end = date('Y-m-d');
                        $activeSupplierPackage->save();
                    }
                }

                // subscription save
                $subscription = new Subscriptions;
                $subscription->user_id = $user_id;
                $subscription->name = $SubScriptionResponse['plan']['name'];
                $subscription->plan_id = $billingPlan->id;
                $subscription->payment_id = $paymentDetails->id;
                $subscription->amount = $amount_chanrge;
                $subscription->invoice_id = $invoice_id;
                $subscription->charge_id = $charge_id;
                $subscription->balance_transaction = $balance_transaction;
                $subscription->stripe_id = $user->stripe_id;
                $subscription->stripe_plan = $SubScriptionResponse['id'];
                $subscription->quantity = $SubScriptionResponse['quantity'];
                $subscription->trial_ends_at = $SubScriptionResponse['trial_end'];
                $subscription->ends_at = $SubScriptionResponse['ended_at'];
                $subscription->subscription_start = date('Y-m-d',$SubScriptionResponse['current_period_start']);
                $subscription->subscription_end = date('Y-m-d',$SubScriptionResponse['current_period_end']);
                $subscription->is_canceled = 0;
                $subscription->status = 'Active';
                $subscription->save();

                if($billingPlan->amount > 0)
                {
                    $referral = Referrals::whereRaw('referral_to = '.$user_id.' AND paid_referral_by != 1 ')->first();
                    if($referral)
                    {
                        // add amount to referral by user
                        $paind_amount = round($amount_chanrge/2);

                        $referralPayment = new ReferralPayment;
                        $referralPayment->user_id = $referral->referral_by;
                        $referralPayment->referral_user_id = $user_id;
                        $referralPayment->referral_id = $referral->id;
                        $referralPayment->subscription_id = $subscription->id;
                        $referralPayment->amount = $paind_amount;
                        $referralPayment->save();

                        /// set first time amount added;
                        $referral->paid_referral_by = 1;
                        $referral->save();

                        /// User Activity for message
                        $usersActivity = new UsersActivity;
                        $usersActivity->activity_name = 'Your referral payout(s) has posted on '.date('M d, Y').'.';
                        $usersActivity->activity_id = $referral->referral_by;
                        $usersActivity->activity_type = 'refferel_payout';
                        $usersActivity->creater_id = $referral->referral_by;
                        $usersActivity->receiver_id = null;
                        $usersActivity->save();
                    }
                }

                /* payment mail to receiver */
                $receiverData = UserDetails::where('user_id',$user_id)->first();
                $receiver = User::find($user_id);

                /// User Activity for message
                $usersActivity = new UsersActivity;
                $usersActivity->activity_name = 'Your Indy John account payment for '.$SubScriptionResponse['plan']['name'].' has been posted on '.date('M d, Y').'.';
                $usersActivity->activity_id = $user_id;
                $usersActivity->activity_type = 'package';
                $usersActivity->creater_id = $user_id;
                $usersActivity->receiver_id = null;
                $usersActivity->save();

                Input::replace(array('email' => $receiver->email,'name'=>$receiverData->first_name.' '.$receiverData->last_name));
                $data = array(
                    'name'=>Input::get('name'),
                    'plan'=>$SubScriptionResponse['plan']['name'],
                    'fees'=>$amount_chanrge,
                    'transaction_id'=>$charge_id,
                    //'invoice_id'=>$invoice_id,
                    'invoice_id'=>$paymentDetails->unique_number,
                    'invoicr_url'=>url('/user/payment-invoice/').$paymentDetails->id
                );
                Mail::send('admin.Emailtemplates.sellerPaymentPosted', $data, function($message){
                    $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                    $message->to(Input::get('email'), Input::get('name'))->subject('Your Indy John account payment');
                });

                //return Redirect::to('user/packages')->with('message', 'Your account status has been changed.');
                $ajaxDataArray = array();
                $ajaxDataArray['success'] = true;
                return Response::json($ajaxDataArray);
            }

        }
        else
        {
            /* payment mail to receiver */
            $receiverData = UserDetails::where('user_id',$user_id)->first();
            $receiver = User::find($user_id);

            /// User Activity for message
            $usersActivity = new UsersActivity;
            $usersActivity->activity_name = 'There was a problem with your Account payment on '.date('M d, Y').'.';
            $usersActivity->activity_id = $user_id;
            $usersActivity->activity_type = 'package';
            $usersActivity->creater_id = $user_id;
            $usersActivity->receiver_id = null;
            $usersActivity->save();

            Input::replace(array('email' => $receiver->email,'name'=>$receiverData->first_name.' '.$receiverData->last_name));
            $data = array(
                'name'=>Input::get('name'),
                'plan'=>$billingPlan->name,
                'fees'=>$billingPlan->amount,
                'transaction_id'=>'',
                'invoice_id'=>'',
                'email'=>$receiver->email,
                'date'=> date('Y-m-d'),
                'invoicr_url'=>url('')
            );
            Mail::send('admin.Emailtemplates.sellerPaymentDeclined', $data, function($message){
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), Input::get('name'))->subject('Your Indy John account payment');
            });
        }

        return Redirect::to('user/packages')->with('message', 'There was a problem with your action, please try again.');
    }

    /**
     * For user payment view
     */
    public function viewPaymentDetail($user_id,$price,$payment_type)
    {
        $user = User::find($user_id);
        return view('account.payment')->with(['user'=>$user,'price'=>$price,'payment_type'=>$payment_type]);
    }

    /**
     * user payment save
     */
    public function savePaymentDetail()
    {
        $input = Input::all();
        $user_id = $input['user_id'];
        $user = User::find($user_id);
        $card_token = $input['card_token'];
        $amount = $input['amount'];
        $strip_key = env('STRIPE_SECRET', '');
        $admin_name = env('CONTACT_TO_NAME', '');
        $admin_email = env('CONTACT_TO_EMAIL', '');
        $amount_chanrge = 0;
        \Stripe\Stripe::setApiKey($strip_key);


        if($user->stripe_id == '')
        {
            $result = \Stripe\Customer::create(array(
                "description" => "Customer for ".$user->email,
                "email"=>$user->email,
                "source" => $card_token // obtained with Stripe.js
            ));
            if($result)
            {
                $response =  $result->__toArray(true);
                $user->stripe_id = $response['id'];
                $user->save();
            }
            else
            {
                return Redirect::to('quotetek/payment/'.$user_id.'/'.$amount)->with('message', 'There was a problem processing your payment. Please verify payment details and resubmit.');
            }
        }

        if($amount > 0)
        {
            $charge = \Stripe\Charge::create(array(
                "amount" => $amount*100,
                "currency" => "usd",
                "customer" => $user->stripe_id, // obtained with Stripe.js
                "description" => "Charge for ".$user->email
            ));
        }
        else
        {
            $charge = true;
        }
        if($charge)
        {
            if($amount > 0)
            {
                $charges = $charge->__toArray(true);
                $amount_chanrge = $charges['amount']/100;
                $invoice_id = $charges['invoice'];
                $charge_id = $charges['id'];
                $balance_transaction = $charges['balance_transaction'];
            }
            else
            {
                $amount_chanrge = 0;
                $invoice_id = '';
                $charge_id = '';
                $balance_transaction = '';
            }

            // payment details store

            $unique = TransactionUnique::first();
            $next = $unique->number+1;
            $unique->number = $next;
            $unique->save();

            $unique_number = 'IJV-'.$next;

            $paymentDetails = new PaymentDetails;
            $paymentDetails->user_id = $user_id;
            $paymentDetails->unique_number = $unique_number;
            $paymentDetails->payment_type = $input['card_type'];
            $paymentDetails->detail = 'Payment for '.$input['payment_type'];
            $paymentDetails->amount = $amount_chanrge;
            $paymentDetails->card_number = $input['cardNumber'];
            $paymentDetails->card_last_4 = $input['card_last_4'];
            $paymentDetails->expiry = $input['cardExpiry'];
            $paymentDetails->cvv = $input['cardCVC'];
            $paymentDetails->save();

            /* payment mail to receiver */
            $receiver = User::find($user_id);
            $name = '';
            if($receiver->access_level == 4)
            {
                $name = $receiver->name;
            }
            else
            {
                $receiverData = UserDetails::where('user_id',$user_id)->first();
                $name = $receiverData->first_name.' '.$receiverData->last_name;
            }



            if($input['payment_type'] == 'verification')
            {
                if($user->access_level == 4)
                {
                    $companyVerification = QuotetekCompanyVerification::where('user_id',$user_id)->first();
                    $companyVerification->payment = 1;
                    $companyVerification->save();
                }
                else
                {
                    $userVerification = QuotetekUserVerification::where('user_id',$user_id)->first();
                    $userVerification->payment = 1;
                    $userVerification->save();
                }

                Input::replace(array('email' => $admin_email,'name'=>$admin_name));
                $data = array(
                    'name'=>Input::get('name'),
                    'user'=>$name,
                    'date' => date('M d, Y'),
                    'transaction_id'=>$charge_id,
                    //'invoice_id'=>$invoice_id,
                    'invoice_id'=>$paymentDetails->unique_number
                );
                Mail::send('admin.Emailtemplates.verificationPaymentPosted', $data, function($message){
                    $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                    $message->to(Input::get('email'), Input::get('name'))->subject('Your Indy John account verification details');
                });

            }
            else
            {
                Input::replace(array('email' => $receiver->email,'name'=>$name));
                $data = array(
                    'name'=>Input::get('name'),
                    'plan'=>'Payment for '.$input['payment_type'],
                    'fees'=>$amount_chanrge,
                    'transaction_id'=>$charge_id,
                    //'invoice_id'=>$invoice_id,
                    'invoice_id'=>$paymentDetails->unique_number,
                    'invoicr_url'=>url('/user/payment-invoice/').$paymentDetails->id
                );
                Mail::send('admin.Emailtemplates.sellerPaymentPosted', $data, function($message){
                    $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                    $message->to(Input::get('email'), Input::get('name'))->subject('Your Indy John account payment');
                });
            }

            return Redirect::to('user/payment-history')->with('message', 'Your account status has been changed.');

        }
        else
        {
            /* payment mail to receiver */
            $receiver = User::find($user_id);
            $name = '';
            if($receiver->access_level == 4)
            {
                $name = $receiver->name;
            }
            else
            {
                $receiverData = UserDetails::where('user_id',$user_id)->first();
                $name = $receiverData->first_name.' '.$receiverData->last_name;
            }

            Input::replace(array('email' => $receiver->email,'name'=>$name));
            $data = array(
                'name'=>Input::get('name'),
                'plan'=>'Payment for '.$input['payment_type'],
                'fees'=>$amount_chanrge,
                'transaction_id'=>'',
                'invoice_id'=>'',
                'email'=>$receiver->email,
                'date'=> date('Y-m-d'),
                'invoicr_url'=>url('')
            );
            Mail::send('admin.Emailtemplates.sellerPaymentDeclined', $data, function($message){
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), Input::get('name'))->subject('Your indy John account payment');
            });
        }
        return Redirect::to('user/payment-history')->with('message', 'Your payment was unsuccessful. Please verify your details and resubmit.');

    }

    public function viewCardDetail()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $strip_key = env('STRIPE_SECRET', '');
        \Stripe\Stripe::setApiKey($strip_key);

        if($user->stripe_id != null){
            $cards = \Stripe\Customer::retrieve($user->stripe_id)->sources->all(array(
                "object" => "card"
            ));
            $response =  $cards->__toArray(true);
            //echo '<pre>';print_r($response['data']);
            //exit(0);
            return view('account.cards')->with(['cards'=>$response['data'],'user'=>$user]);
        }else{
            return view('account.cards')->with(['cards'=>[],'user'=>$user]);
        }

    }

    public function saveCardDetail()
    {
        $input = Input::all();
        $user = User::find($input['user_id']);
        $strip_key = env('STRIPE_SECRET', '');
        \Stripe\Stripe::setApiKey($strip_key);

        $customer = \Stripe\Customer::retrieve($user->stripe_id);
        $result = $customer->sources->create(array("source" => $input['card_token']));
        if($result)
        {
            return Redirect::to('account-cards')->with('message', 'Your credit card details have been added.');
        }
        else
        {
            return Redirect::to('account-cards')->with('message', 'There was a problem with your credit card details. Please check and resubmit.');
        }
    }

    public function updateCardDetail()
    {
        $input = Input::all();
        $user = User::find($input['user_id']);
        $strip_key = env('STRIPE_SECRET', '');
        \Stripe\Stripe::setApiKey($strip_key);

        $customer = \Stripe\Customer::retrieve($user->stripe_id);
        $card = $customer->sources->retrieve($input['card_id']);
        $card->exp_month = $input['cardExpiryMonth'];
        $card->exp_year = $input['cardExpiryYear'];
        $result = $card->save();

        if($result)
        {
            return Redirect::to('account-cards')->with('message', 'Your credit card details have been added.');
        }
        else
        {
            return Redirect::to('account-cards')->with('message', 'There was a problem with your credit card details. Please check and resubmit.');
        }
    }

    public function deleteCard()
    {
        $input = Input::all();
        $user = User::find(Auth::user()->id);

        $strip_key = env('STRIPE_SECRET', '');
        \Stripe\Stripe::setApiKey($strip_key);

        $customer = \Stripe\Customer::retrieve($user->stripe_id);
        $result = $customer->sources->retrieve($input['card_id'])->delete();
        if($result)
        {
            return Redirect::to('account-cards')->with('message', 'Your credit card details have been added.');
        }
        else
        {
            return Redirect::to('account-cards')->with('message', 'There was a problem with your credit card details. Please check and resubmit.');
        }
    }

    public function viewTestMail()
    {
        return view('account.testmail');
    }

    public function sendTestMail()
    {
        echo '<pre>';print_r(Input::All());
        exit(0);

        try{

            $data = array('name'=>'Hiren Dave','email'=>Input::get('email'),'password'=>'admin123');
            Mail::send('admin.Emailtemplates.emailTemplate', $data, function($message){
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), 'Hiren Dave')->subject('Quotetek\'r Portal Login');
            });
        }
        catch (\Exception $e) {
            echo $e;
            exit(0);
        }


        return Redirect::to('user/testmail')->with('message', 'This e-mail has been sent.');
    }

    /**
     * user payment invoice
     */
    public function viewPaymentInvoice($id)
    {
        $paymentDetail = PaymentDetails::find($id);
        if(Auth::user()->id != $paymentDetail->user_id)
        {
            return Redirect::to('not-authorized');
        }
        // for set unique number
        if($paymentDetail->unique_number == '')
        {
            // for user unique number
            $unique = TransactionUnique::first();
            $next = $unique->number+1;
            $unique->number = $next;
            $unique->save();

            $unique_number = 'IJV-'.$next;

            $paymentDetail->unique_number = $unique_number;
            $paymentDetail->save();
        }

        if($paymentDetail->paid_for != null)
        {
            $user_id = $paymentDetail->paid_for;
        }
        else
        {
            $user_id = $paymentDetail->user_id;
        }

        $user = User::find($user_id);

        $paymentDetail->user = $user;


        $userId = $paymentDetail->user_id;
        $userData = User::find($userId);
        $paymentDetail->paidFor = $userData;

        if($user->userdetail->company_id != '')
        {
            $paymentDetail->userCompany = Company::find($user->userdetail->company_id);
        }
        else
        {
            $paymentDetail->userCompany = '';
        }

        return view('account.paymentInvoice')->with(['paymentDetail'=>$paymentDetail]);
    }

    /**
     * package Invoice
     */
    public function viewPackagesInvoice($id)
    {
        $subscription = Subscriptions::find($id);
        if($subscription->payment_id != '')
        {
            $paymentDetail = PaymentDetails::find($subscription->payment_id);

            // for set unique number
            if($paymentDetail->unique_number == '')
            {
                // for user unique number
                $unique = TransactionUnique::first();
                $next = $unique->number+1;
                $unique->number = $next;
                $unique->save();

                $unique_number = 'IJV-'.$next;

                $paymentDetail->unique_number = $unique_number;
                $paymentDetail->save();
            }

            $user_id = $paymentDetail->user_id;

            $user = User::find($user_id);

            $paymentDetail->user = $user;

            if($user->userdetail->company_id != '')
            {
                $paymentDetail->userCompany = Company::find($user->userdetail->company_id);
            }
            else
            {
                $paymentDetail->userCompany = '';
            }
        }
        else
        {
            $paymentDetail = '';
        }

        return view('account.package-invoice')->with(['paymentDetail'=>$paymentDetail,'subscription'=>$subscription]);
    }

    
////////////////////////////////////////////////////////////////////////////////
    public function quotecheckout(Request $request)
    {
        //$email->txt_payment = $request->Input('txt_payment');
        $payment = $request->txt_payment;
        $data = Input::all();
         $btn=Input::get('submit');

        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
  
  
    //$customer = Stripe::customers()->create([
    //'email' => $user_email,
    //]);
         $customers = Stripe::customers()->all();
         
          
         $customer_email=$customers['data']['0']['email'];
     

       $data=$user_email||$customer_email;
      
   if(isset($btn))
            {
               // print_r($email); die();
                if($user_email||$customer_email){
                    
                $customer_id=$customers['data']['0']['id'];

        $id=DB::table('user_strip')->insert(['strip_id' => $customer_id,'user_id'=>$user_id,'payment'=>$payment]);
        if(isset($id)){
            //echo 'hi';
            $data=array('message1'=>'Connected');
            return view('/account/quotecheckout',with($data));
        }
        else{
            echo "You are not connected with Strip,Please connected";
        }
            }}
            else{

                $ckeckoutl=DB::table('user_details')->select('checkout')->where('user_id',$user_id)->get();
                if(isset($ckeckoutl))
                {
                $data=array('message'=>'Not connected');
                return view('/account/quotecheckout',with($data));
            }
            else{
                echo "unsuccessful";
            }
            }
   

}





}
