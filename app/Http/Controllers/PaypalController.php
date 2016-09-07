<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use Input;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use PayPal\Service\PayPalAPIInterfaceServiceService;
use PayPal\EBLBaseComponents\PaymentDetailsType;
use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
use PayPal\PayPalAPI\SetExpressCheckoutRequestType;
use PayPal\PayPalAPI\SetExpressCheckoutReq;
use Session;
use PayPal\EBLBaseComponents\RecurringPaymentsProfileDetailsType;
use PayPal\EBLBaseComponents\BillingPeriodDetailsType;
use PayPal\EBLBaseComponents\ScheduleDetailsType;
use PayPal\EBLBaseComponents\CreateRecurringPaymentsProfileRequestDetailsType;
use PayPal\PayPalAPI\CreateRecurringPaymentsProfileRequestType;
use PayPal\PayPalAPI\CreateRecurringPaymentsProfileReq;
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
use Mail;

class PaypalController extends Controller
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

    public function initPayPalPayment(){
        $payment = Input::get('payment') / 100;
        $plan = Input::get('plan');
        $type = Input::get('type');

        Session::put('payment',$payment);
        Session::put('plan',$plan);
        Session::put('type',$type);
        Session::put('team_member_id',Input::get('team_member_id'));

        $config = array (
            'mode' => 'sandbox' ,
            'acct1.UserName' => 'test_api1.quotetek.com',
            'acct1.Password' => '1403115389',
            'acct1.Signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AWRfIfgWS9Rar0.DLJQL1NXqh2M8'
        );
        $paypalService = new PayPalAPIInterfaceServiceService($config);
        $paymentDetails= new PaymentDetailsType();

        $orderTotal = new BasicAmountType();
        $orderTotal->currencyID = 'USD';
        $orderTotal->value = $payment;

        $paymentDetails->OrderTotal = $orderTotal;
        $paymentDetails->PaymentAction = 'Sale';

        $setECReqDetails = new SetExpressCheckoutRequestDetailsType();
        $setECReqDetails->PaymentDetails[0] = $paymentDetails;
        $setECReqDetails->CancelURL = url('/cancel-paypal-payment');
        $setECReqDetails->ReturnURL = url('/success-paypal-payment');

        $billingAgreementDetails = new BillingAgreementDetailsType('RecurringPayments');
        $billingAgreementDetails->BillingAgreementDescription = 'Recurring Billing For '.$plan .' Plan';
        $setECReqDetails->BillingAgreementDetails = array($billingAgreementDetails);

        $setECReqType = new SetExpressCheckoutRequestType();
        $setECReqType->Version = '104.0';
        $setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;

        $setECReq = new SetExpressCheckoutReq();
        $setECReq->SetExpressCheckoutRequest = $setECReqType;

        $setECResponse = $paypalService->SetExpressCheckout($setECReq);

        if($setECResponse->Ack == 'Success'){
            $token = $setECResponse->Token;
            return Redirect::to('https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$token);
        }else{
            return Redirect::to('user-dashboard')->with('message', 'There is a problem in payment processing.');
        }
    }

    public function cancelPayPalPayment(){
        return Redirect::to('user-dashboard')->with('message', 'Your upgrade is cancled');
    }

    public function successPayPalPayment(){
        //get payer id here and set up recurring billing profile.
        $token = Input::get('token');
        $PayerID = Input::get('PayerID');

        $payment = Session::get('payment');
        $plan = Session::get('plan');
        $type = Session::get('type');
        $team_member_id = Session::get('team_member_id');

        $profileDetails = new RecurringPaymentsProfileDetailsType();
        $profileDetails->BillingStartDate = date(DATE_ISO8601, strtotime(date('Y-m-d').' +1 day'));

        $paymentBillingPeriod = new BillingPeriodDetailsType();
        $paymentBillingPeriod->BillingFrequency = 1;
        if($type == 'month'){
            $paymentBillingPeriod->BillingPeriod = "Month";
        }else{
            $paymentBillingPeriod->BillingPeriod = "Year";
        }

        $paymentBillingPeriod->Amount = new BasicAmountType("USD", $payment);

        $scheduleDetails = new ScheduleDetailsType();
        $scheduleDetails->Description = "Recurring Billing For ".$plan.' Plan';
        $scheduleDetails->PaymentPeriod = $paymentBillingPeriod;

        $createRPProfileRequestDetails = new CreateRecurringPaymentsProfileRequestDetailsType();
        $createRPProfileRequestDetails->Token = $token;

        $createRPProfileRequestDetails->ScheduleDetails = $scheduleDetails;
        $createRPProfileRequestDetails->RecurringPaymentsProfileDetails = $profileDetails;

        $createRPProfileRequest = new CreateRecurringPaymentsProfileRequestType();
        $createRPProfileRequest->CreateRecurringPaymentsProfileRequestDetails = $createRPProfileRequestDetails;

        $createRPProfileReq = new CreateRecurringPaymentsProfileReq();
        $createRPProfileReq->CreateRecurringPaymentsProfileRequest = $createRPProfileRequest;

        $config = array (
            'mode' => 'sandbox' ,
            'acct1.UserName' => 'test_api1.quotetek.com',
            'acct1.Password' => '1403115389',
            'acct1.Signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AWRfIfgWS9Rar0.DLJQL1NXqh2M8'
        );
        $paypalService = new PayPalAPIInterfaceServiceService($config);
        $createRPProfileResponse = $paypalService->CreateRecurringPaymentsProfile($createRPProfileReq);
        if($createRPProfileResponse->Ack == 'Success'){
            $profileId = $createRPProfileResponse->CreateRecurringPaymentsProfileResponseDetails->ProfileID;
            $startDate = date(DATE_ISO8601, strtotime(date('Y-m-d').' +1 day'));
            if($type == 'month'){
                $endDate = date(DATE_ISO8601, strtotime($startDate.' +1 month'));
            }else{
                $endDate = date(DATE_ISO8601, strtotime($startDate.' +12 months'));
            }

            $user_id = Auth::user()->id;
            $isForTeamMember = false;
            $manager_id = null;
            if($team_member_id != null){
                $user_id = $team_member_id;
                $isForTeamMember = true;
                $manager_id = Auth::user()->id;
            }
            $user = User::find($user_id);

            $planName = '';
            $planId = '';

            switch($plan){
                case "SILVER" : $planName = 'Supplier Silver Package';$planId=4;break;
                case "GOLD" : $planName = 'Supplier Gold Package';$planId=3;break;
                case "BUYERPLUS" : $planName = 'Buyer Plus Package';$planId=1;break;
            }

            $unique = TransactionUnique::first();
            $next = $unique->number+1;
            $unique->number = $next;
            $unique->save();

            $unique_number = 'IJV-'.$next;

            $paymentDetails = new PaymentDetails;
            $paymentDetails->user_id = $user_id;
            if($isForTeamMember == true){
                $paymentDetails->paid_for = $manager_id;
            }
            $paymentDetails->unique_number = $unique_number;
            $paymentDetails->payment_type = 'Paypal Recurring Payment';
            $paymentDetails->detail = 'Payment for '.$planName;
            $paymentDetails->amount = $payment;
            $paymentDetails->save();

            //check here if user have any active subscription, if yes then mark as completed and send end date as current date.

            $billingPlan = SubscriptionPlans::find($planId);

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


            $subscription = new Subscriptions;
            $subscription->user_id = $user_id;
            $subscription->name = $planName;
            $subscription->plan_id = $planId;
            $subscription->payment_id = $paymentDetails->id;
            $subscription->amount = $payment;
            $subscription->invoice_id = null;
            $subscription->charge_id = null;
            $subscription->balance_transaction = null;
            $subscription->stripe_id = null;
            $subscription->stripe_plan = null;
            $subscription->quantity = 1;
            $subscription->paypal_payer_id = $profileId;
            $subscription->paypal_token = $token;
            $subscription->subscription_start = $startDate;
            $subscription->subscription_end = $endDate;
            $subscription->is_canceled = 0;
            $subscription->status = 'Active';
            $subscription->save();



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
                $jobs = 5;
                $user->job_post = $jobs;
                $user->save();
            }

            $referral = Referrals::whereRaw('referral_to = '.$user_id.' AND paid_referral_by != 1 ')->first();
            if($referral)
            {
                // add amount to referral by user
                $paind_amount = round($payment/2);

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
            $receiverData = UserDetails::where('user_id',$user_id)->first();
            $receiver = User::find($user_id);

            $usersActivity = new UsersActivity;
            $usersActivity->activity_name = 'Your Indy John account payment for '.$subscription->name.' has been posted on '.date('M d, Y').'.';
            $usersActivity->activity_id = $user_id;
            $usersActivity->activity_type = 'package';
            $usersActivity->creater_id = $user_id;
            $usersActivity->receiver_id = null;
            $usersActivity->save();

            Session::forget('payment');
            Session::forget('plan');
            Session::forget('type');
            Session::forget('team_member_id');

            Input::replace(array('email' => $receiver->email,'name'=>$receiverData->first_name.' '.$receiverData->last_name));
            $data = array(
                'name'=>Input::get('name'),
                'plan'=>$planName,
                'fees'=>$payment,
                'transaction_id'=>$PayerID,
                //'invoice_id'=>'',
                'invoice_id'=>$paymentDetails->unique_number,
                'invoicr_url'=>url('/user/payment-invoice/').$paymentDetails->id
            );
            Mail::send('admin.Emailtemplates.sellerPaymentPosted', $data, function($message){
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), Input::get('name'))->subject('Your Indy John account payment');
            });

            return Redirect::to('user-dashboard')->with('message', 'Your account is upgraded.');
        }else{
            return Redirect::to('user-dashboard')->with('message', 'There is a problem in payment processing.');
        }
    }
}
