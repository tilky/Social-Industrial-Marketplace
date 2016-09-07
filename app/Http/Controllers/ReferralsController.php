<?php

namespace App\Http\Controllers;

use App\Referrals;
use App\ReferralsLinks;
use App\UserDetails;
use App\User;
use App\AppsCountries;
use App\ReferralPaymentCheque;
use App\ReferralPaymentPaypal;
use App\ReferralPayment;
use App\ReferralPayout;
use App\Subscriptions;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Input;
use Auth;
use Response;
use Session;

class ReferralsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->access_level == 1){
            $referrals = Referrals::paginate(15);
        }else{
            $user_id = Auth::user()->id;
            $referrals = Referrals::where('referral_by',$user_id)->paginate(15);
        }

        foreach($referrals as $referral)
        {
            $referral_to = $referral->referral_to;
            $user = User::find($referral_to);
            $referral->email = $user->email;
            $userData = UserDetails::where('user_id',$referral_to)->first();
            $referral->first_name = $userData->first_name;
            $referral->last_name = $userData->last_name;
            $referral->account_type = $userData->account_type;
            $referral->payment = ReferralPayment::where('referral_id',$referral->id)->first();
            
            if($referral->payment){
                if($referral->payment->payment_clear == 1){
                    $referral->status = 'Cleared';
                }
                else{
                     $today  = date('Y-m-d');
                     $days_after = date('Y-m-d', strtotime('+30 days', strtotime($referral->payment->created_at)));
                    if(strtotime($today) < strtotime($days_after))
                    {
                        $referral->status = 'Pending';
                    }
                    else
                    {
                        $referral->status = 'Not Cleared';
                    }   
                }
            } 
            else{
                $referral->status = 'N/A';
            }
        }
        $previousPageUrl = $referrals->previousPageUrl();//previous page url
        $nextPageUrl = $referrals->nextPageUrl();//next page url
        $lastPage = $referrals->lastPage(); //Gives last page number
        $total = $referrals->total();
        return view('referrals.index')->with([
                                                        'referrals'=>$referrals,
                                                        'previousPageUrl'=>$previousPageUrl,
                                                        'nextPageUrl'=>$nextPageUrl,
                                                        'lastPage'=>$lastPage,
                                                        "total"=>$total,
                                                        ]);
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
     * generate random code
     */
    public function randomCode() {
        $alphabet = "0123456789";
        $code = array(); //remember to declare code as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 5; $i++) {
            $n = rand(0, $alphaLength);
            $code[] = $alphabet[$n];
        }
        return implode($code); //turn the array into a string
    }
    
    /**
     * Referral Link view
     */
    public function referaalLink()
    {
        $user_id = Auth::user()->id;
        $referralLink = ReferralsLinks::where('user_id',$user_id)->first();
        if($referralLink)
        {
            $link_count = 1;
        }
        else
        {
            $referralLink = new ReferralsLinks;
            $link_count = 0;
        }
        return view('referrals.referralLink')->with(['user_id'=>$user_id,'link_count'=>$link_count,'referralLink'=>$referralLink]);
    }
    
    public function CheckReferralLink($user_id,$usernamecheck,$cnt)
    {
        $userData = UserDetails::where('user_id',$user_id)->first();
        $username = $userData->first_name;
        
        $checkLink = ReferralsLinks::where('referral_code',$usernamecheck)->first();
        if($checkLink)
        {
            $cnt++;
            $usernamecheck = $username.$cnt;
            $linkcode = $this->CheckReferralLink($userData->user_id,$usernamecheck,$cnt);
            
        }
        else
        {
            $linkcode = $usernamecheck;
        }
        return $linkcode;
    }
    
    /**
     * Generate referral link for user
     */
    public function addReferaalLink($user_id)
    {
        $userData = UserDetails::where('user_id',$user_id)->first();
        
        $username = $userData->first_name;
        $cnt = 0;
        $checkLink = $this->CheckReferralLink($user_id,$username,$cnt);
        
        //$code = $this->randomCode();
        $referralLinkCheck = 
        $referralLink = new ReferralsLinks;
        $referralLink->user_id = $user_id;
        $referralLink->referral_code = $checkLink;
        $referralLink->save();
        return Redirect::to('referral-link')->with('message', 'Your referral code and link has been created.');
    }
    
    /**
     * Edit Referral Link
     */
    public function saveEditReferaalLink()
    {
        $user_id = Auth::user()->id;
        $referral_link = Input::get('referral_link');
        $referralLink = ReferralsLinks::where('referral_code',$referral_link)->first();
        if($referralLink)
        {
            if($referralLink->user_id != $user_id)
            {
                return Redirect::to('referral-link')->with('message', $referral_link.' has already been taken by another user. Please choose another.');
            }
        }
        $userReferralLink = ReferralsLinks::where('user_id',$user_id)->first();
        $userReferralLink->referral_code = $referral_link;
        $userReferralLink->save();
        return Redirect::to('referral-link')->with('message', 'Your Referral Code and Link has been changed.');
    }
    
    /**
     * referral link about progam view
     */
    public function viewAboutProgram()
    {
        return view('referrals.about');
    }
    
    /**
     * referral payment information
     */
    public function viewReferralPayment()
    {
        $user_id = Auth::user()->id;
        
        $referralPaymentPaypal = ReferralPaymentPaypal::where('user_id',$user_id)->first();
        
        $flg_payment = 0;
        if($referralPaymentPaypal)
        {
            $paymentInfo = $referralPaymentPaypal;
            $flg_payment = 1;
        }
        
        $referralPaymentCheque = ReferralPaymentCheque::where('user_id',$user_id)->first();
        
        if($referralPaymentCheque)
        {
            $referralPaymentCheque->paypal_email = '';
            $paymentInfo = $referralPaymentCheque;
            $flg_payment = 1;
        }
        
        if($flg_payment == 0)
        {
            $paymentInfo = '';
        }
        
        $countries = AppsCountries::all();
        
        return view('referrals.payment')->with(['paymentInfo'=>$paymentInfo,'user_id' => $user_id, 'countries' => $countries]);
    }
    
    /**
     * add paypal payment
     */
    public function addPayplaPayment()
    {
        $user_id = Auth::user()->id;
        $countries = AppsCountries::all();
        return view('referrals.addPaypal')->with(['user_id'=>$user_id,'countries'=>$countries]);
    }
    
    /**
     * save paypal payment
     */
    public function savePayplaPayment(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
                'payment_via' => 'required',
                'payee_name' => 'required',
                'address1' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'phone' => 'required'
            ]);
        
        if($input['country'] == 'United States')
        {
            $this->validate($request, [
                'legal_name' => 'required',
                'account_type' => 'required'
            ]);
            if($input['account_type'] == 1)
            {
                $this->validate($request, [
                    'social_security_number' => 'required'
                ]);
                
                $input['federal_employer_identification_number'] = ''; 
            }
            else
            {
                $this->validate($request, [
                    'federal_employer_identification_number' => 'required'
                ]);
                $input['social_security_number'] = '';
            }
        }
        else
        {
            $input['legal_name'] = '';
            $input['federal_employer_identification_number'] = '';
            $input['social_security_number'] = '';
        }
        
        if($input['payment_via'] == 'Paypal')
        {
                        
            $referralPaymentPaypal = ReferralPaymentPaypal::where('user_id',$input['user_id'])->first();
            if($referralPaymentPaypal)
            {
                $referralPaymentPaypal->fill($input)->save();
            }
            else
            {
                if($input['payment_via'] == 'Paypal')
                {
                    $this->validate($request, [
                        'paypal_email' => 'required|email|max:255|unique:referral_payment_paypal'
                    ]);
                }
                // first delete cheque
                $referralPaymentCheque = ReferralPaymentCheque::where('user_id',$input['user_id'])->first();
                if($referralPaymentCheque)
                {
                    $referralPaymentCheque->delete();
                }
                $PaymentPaypal = ReferralPaymentPaypal::create($input);    
            }
                    
        }
        else
        {
            
            
            $referralPaymentCheque = ReferralPaymentCheque::where('user_id',$input['user_id'])->first();
            if($referralPaymentCheque)
            {
                $referralPaymentCheque->fill($input)->save();
            }
            else
            {
                // first delete paypal
                $referralPaymentPaypal = ReferralPaymentPaypal::where('user_id',$input['user_id'])->first();
                if($referralPaymentPaypal)
                {
                    $referralPaymentPaypal->delete();
                }
                $PaymentPaypal = ReferralPaymentCheque::create($input);    
            }
        }
        
        return Redirect::to('referral/payment-info')->with('message', 'Your Payout settings have been updated.');
    }
    
    /**
     * edit paypal payment
     */
    public function editPayplaPayment($id)
    {
        $referralPaymentPaypal = ReferralPaymentPaypal::find($id);
        $countries = AppsCountries::all();
        return view('referrals.editPaypal')->with(['paypal'=>$referralPaymentPaypal,'countries'=>$countries]);
    }
    
    /**
     * update paypal payment
     */
    public function updatePayplaPayment(Request $request)
    {
        $input = $request->all();
        $user_id = 
        $checkuseremail = ReferralPaymentPaypal::whereRaw('user_id = ? AND paypal_email = ?',array($input['user_id'],$input['paypal_email']))->first();
        if($checkuseremail)
        {
            $this->validate($request, [
                'payee_name' => 'required',
                'address1' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'phone' => 'required'
            ]);
        }
        else
        {
            $this->validate($request, [
                'paypal_email' => 'required|email|max:255|unique:referral_payment_paypal',
                'payee_name' => 'required',
                'address1' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'phone' => 'required'
            ]);    
        }
        
        if($input['country'] == 'United States')
        {
            if($input['account_type'] == 1)
            {
                $this->validate($request, [
                    'legal_name' => 'required',
                    'social_security_number' => 'required'
                ]);
                
                $input['federal_employer_identification_number'] = ''; 
            }
            else
            {
                $this->validate($request, [
                    'legal_name' => 'required',
                    'federal_employer_identification_number' => 'required'
                ]);
                $input['social_security_number'] = '';
            }
        }
        else
        {
            $input['legal_name'] = '';
            $input['federal_employer_identification_number'] = '';
            $input['social_security_number'] = '';
        }
        
        $referralPaymentPaypal = ReferralPaymentPaypal::find($input['paypal_id']);
        
        $referralPaymentPaypal->fill($input)->save();
        
        return Redirect::to('referral/payment-info')->with('message', 'Your payout settings have been updated.');
    }
    
    /**
     * delete paypal payment
     */
    public function deletePayplaPayment($id)
    {
        $referralPaymentPaypal = ReferralPaymentPaypal::find($id);
        
        $referralPaymentPaypal->delete();
        
        return Redirect::to('referral/payment-info')->with('message', 'Your payout settings have been updated.');
    }
    
    /**
     * add cheque payment
     */
    public function addChequePayment()
    {
        $user_id = Auth::user()->id;
        $countries = AppsCountries::all();
        return view('referrals.addCheque')->with(['user_id'=>$user_id,'countries'=>$countries]);
    }
    
    /**
     * save cheque payment
     */
    public function saveChequePayment(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
                'payee_name' => 'required',
                'address1' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'phone' => 'required'
            ]);
        if($input['country'] == 'United States')
        {
            if($input['account_type'] == 1)
            {
                $this->validate($request, [
                    'legal_name' => 'required',
                    'social_security_number' => 'required'
                ]);
                
                $input['federal_employer_identification_number'] = ''; 
            }
            else
            {
                $this->validate($request, [
                    'legal_name' => 'required',
                    'federal_employer_identification_number' => 'required'
                ]);
                $input['social_security_number'] = '';
            }
        }
        else
        {
            $input['legal_name'] = '';
            $input['federal_employer_identification_number'] = '';
            $input['social_security_number'] = '';
        }
        $referralPaymentCheque = ReferralPaymentCheque::create($input);
        
        return Redirect::to('referral/payment-info')->with('message', 'Your referral payout details have been changed.');
    }
    
    /**
     * edit cheque payment
     */
    public function editChequePayment($id)
    {
        $referralPaymentCheque = ReferralPaymentCheque::find($id);
        $countries = AppsCountries::all();
        return view('referrals.editCheque')->with(['cheque'=>$referralPaymentCheque,'countries'=>$countries]);
    }
    
    /**
     * update cheque payment
     */
    public function updateChequePayment(Request $request)
    {
        $input = $request->all();
        
        $this->validate($request, [
                'payee_name' => 'required',
                'address1' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'phone' => 'required'
            ]);
        if($input['country'] == 'United States')
        {
            if($input['account_type'] == 1)
            {
                $this->validate($request, [
                    'legal_name' => 'required',
                    'social_security_number' => 'required'
                ]);
                
                $input['federal_employer_identification_number'] = ''; 
            }
            else
            {
                $this->validate($request, [
                    'legal_name' => 'required',
                    'federal_employer_identification_number' => 'required'
                ]);
                $input['social_security_number'] = '';
            }
        }
        else
        {
            $input['legal_name'] = '';
            $input['federal_employer_identification_number'] = '';
            $input['social_security_number'] = '';
        }
        
        $referralPaymentCheque = ReferralPaymentCheque::find($input['cheque_id']);
        
        $referralPaymentCheque->fill($input)->save();
        return Redirect::to('referral/payment-info')->with('message', 'Your payout settings have been updated.');
    }
    
    /**
     * delete cheque payment
     */
    public function deleteChequePayment($id)
    {
        $referralPaymentCheque = ReferralPaymentCheque::find($id);
        $referralPaymentCheque->delete();
        return Redirect::to('referral/payment-info')->with('message', 'Your payout settings have been updated.');
    }
    
    /**
     * user referral generated income view
     */
    public function referralGenerateIncome()
    {
        $user_id = Auth::user()->id;
        $referralPayments = ReferralPayment::where('user_id',$user_id)->paginate(15);
        $referral_total = 0;
        $total_payout = 0;
        foreach($referralPayments as $referralPayment)
        {
            $referral_user_id = $referralPayment->referral_user_id;
            $referralPayment->referral_user = UserDetails::where('user_id',$referral_user_id)->first();
            $referralPayment->sunscription = Subscriptions::find($referralPayment->subscription_id);
            $days_after = date('Y-m-d', strtotime('+30 days', strtotime($referralPayment->created_at)));
            $referralPayment->endPeriod = $days_after;
            $referralPayment->referralPayout = ReferralPayout::where('referral_payment_id',$referralPayment->id)->first();
            if($referralPayment->referralPayout)
            {
                $total_payout += $referralPayment->referralPayout->amount;
            }
            $referral_total += $referralPayment->amount;
        }
        $total_pending = $referral_total - $total_payout;
        $previousPageUrl = $referralPayments->previousPageUrl();//previous page url
        $nextPageUrl = $referralPayments->nextPageUrl();//next page url
        $lastPage = $referralPayments->lastPage(); //Gives last page number
        $total = $referralPayments->total();
        
        return view('referrals.income')->with([
                                                'referralPayments'=>$referralPayments,
                                                'previousPageUrl'=>$previousPageUrl,
                                                'nextPageUrl'=>$nextPageUrl,
                                                'lastPage'=>$lastPage,
                                                "total"=>$total,
                                                'referral_total'=>$referral_total,
                                                'total_payout'=>$total_payout,
                                                'total_pending'=>$total_pending
                                                ]);
    }
    
    /**
     * Referral Payout View SuperAdmin
     */
    public function referralPayout()
    {
        $referralPayments = ReferralPayment::paginate(15);
        $referral_total = 0;
        foreach($referralPayments as $referralPayment)
        {
            $referral_user_by_id = $referralPayment->user_id;
            $referralPayment->referral_user = User::find($referral_user_by_id);
            $referral_user_to_id = $referralPayment->referral_user_id;
            $referralPayment->referral_user_to = UserDetails::where('user_id',$referral_user_to_id)->first();
            $referralPayment->sunscription = Subscriptions::find($referralPayment->subscription_id);
            $days_after = date('Y-m-d', strtotime('+30 days', strtotime($referralPayment->created_at)));
            $referralPayment->endPeriod = $days_after;
        }
        
        $previousPageUrl = $referralPayments->previousPageUrl();//previous page url
        $nextPageUrl = $referralPayments->nextPageUrl();//next page url
        $lastPage = $referralPayments->lastPage(); //Gives last page number
        $total = $referralPayments->total();
        
        return view('referrals.payout')->with(['referralPayments'=>$referralPayments,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }
    
    /**
     * Referral Payout send
     */
    /**
     * uncomment if form view show
    public function referralPayoutSend($id)
    {
        $referralPayment = ReferralPayment::find($id);
        $referral_user_by_id = $referralPayment->user_id;
        $referralPayment->referral_user = User::find($referral_user_by_id);
        return view('referrals.payout-send')->with(['referralPayment'=>$referralPayment]);
    }*/
    public function referralPayoutSend($id)
    {
        $referralPayment = ReferralPayment::find($id);
        $referralPayment->payment_clear	= 1;
        $referralPayment->save();
        
        $referralPayout = new ReferralPayout;
        $referralPayout->user_id = $referralPayment->user_id;
        $referralPayout->referral_payment_id = $id;
        $referralPayout->amount = $referralPayment->amount;
        $referralPayout->status = 1;
        $referralPayout->save();
        return Redirect::to('referral-payout')->with('message', 'Your referral payment has been cleared.');
    }

    public function recentlyReferred()
    {
        $referrals = Referrals::where('paid_referral_by',0)->paginate(15);

        foreach($referrals as $referral)
        {
            $referral_to = $referral->referral_to;
            $user = User::find($referral_to);
            $referral->email = $user->email;
            $userData = UserDetails::where('user_id',$referral_to)->first();
            $referral->first_name = $userData->first_name;
            $referral->last_name = $userData->last_name;
            $referral->account_type = $userData->account_type;
            $referral->status = 'N/A';
        }
        $previousPageUrl = $referrals->previousPageUrl();//previous page url
        $nextPageUrl = $referrals->nextPageUrl();//next page url
        $lastPage = $referrals->lastPage(); //Gives last page number
        $total = $referrals->total();
        return view('referrals.recentlyUsers')->with([
            'referrals'=>$referrals,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            "total"=>$total,
        ]);
    }

    public function referralURLs()
    {
        $referralLink = ReferralsLinks::paginate(15);

        foreach($referralLink as $referral)
        {
            $referral->userName = User::find($referral->user_id)->name;
        }
        $previousPageUrl = $referralLink->previousPageUrl();//previous page url
        $nextPageUrl = $referralLink->nextPageUrl();//next page url
        $lastPage = $referralLink->lastPage(); //Gives last page number
        $total = $referralLink->total();
        return view('referrals.referralURLs')->with([
            'referralLink'=>$referralLink,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            "total"=>$total,
        ]);
    }
    
}
