<?php



namespace App\Http\Controllers;



use App\Jobs;

use App\UserDetails;

use App\User;

use App\Company;

use App\JobsSave;

use App\JobUnique;

use App\JobsApply;

use App\JobsType;

use App\SkillsExpertise;

use App\AppsCountries;

use App\PaymentDetails;

use App\Subscriptions;

use App\Industry;

use App\JobIndustries;

use App\UsersActivity;

use App\JobApplyNote;



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

use File;



use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;



class JobsController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $user_id = Auth::user()->id;

        

        $jobs = Jobs::where('user_id',$user_id)->orderBy('id','desc')->paginate(15);

        

        $previousPageUrl = $jobs->previousPageUrl();//previous page url

        $nextPageUrl = $jobs->nextPageUrl();//next page url

        $lastPage = $jobs->lastPage(); //Gives last page number

        $total = $jobs->total();

        

        return view('jobs.index')->with([

                                        'jobs'=>$jobs,

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

        $user_id = Auth::user()->id;

        

        $user = User::find($user_id);

        $indutries = Industry::all();

        

        $userData = UserDetails::where('user_id',$user_id)->first();

        if($userData->industry_id != '')

        {

            $userIndustry = Industry::find($userData->industry_id);

            $selectedUserIndustries = $userIndustry->id;

        }

        else

        {

            $selectedUserIndustries = '';

        }

        

        

        

        $job_functions = JobsType::all();

        $countries = AppsCountries::all();

        return view('jobs.create')->with(['user'=>$user,'job_functions'=>$job_functions,'countries'=>$countries,'indutries'=>$indutries,'selectedUserIndustries'=>$selectedUserIndustries]);

    }

    

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

        

        $this->validate($request, [

            'title' => 'required'

        ]);

        

        

        $user_id = $input['user_id'];

        $user = User::find($user_id);

        $new_jobs = '';

        if($input['account_member'] == '')

        {

            

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

                    return Redirect::back()->with('message', 'There was a problem with your payment details. Please check and resubmit.');

                }

            } 

            

            if($amount > 0)

            {

                $charge = \Stripe\Charge::create(array(

                          "amount" => $amount*100,

                          "currency" => "usd",

                          "customer" => $user->stripe_id, // obtained with Stripe.js

                          "description" => "Charge for Job Post for ".$user->email

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

                $paymentDetails = new PaymentDetails;

                $paymentDetails->user_id = $user_id;

                $paymentDetails->payment_type = $input['card_type'];

                $paymentDetails->detail = 'Payment for Job Post';

                $paymentDetails->amount = $amount_chanrge;

                $paymentDetails->card_number = $input['cardNumber'];

                $paymentDetails->card_last_4 = $input['card_last_4'];

                $paymentDetails->expiry = $input['cardExpiry'];

                $paymentDetails->cvv = $input['cardCVC'];

                $paymentDetails->save();

                

                $input['payment_date'] = date('Y-m-d');

                $input['payment_status'] = 1;

            }

        }

        else

        {

            $job_remain = $user->job_post;

            if($job_remain == 0)

            {

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

                        return Redirect::back()->with('message', 'There was a problem with your payment details. Please check and resubmit.');

                    }

                } 

                

                if($amount > 0)

                {

                    $charge = \Stripe\Charge::create(array(

                              "amount" => $amount*100,

                              "currency" => "usd",

                              "customer" => $user->stripe_id, // obtained with Stripe.js

                              "description" => "Charge for Job Post for ".$user->email

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

                    $paymentDetails = new PaymentDetails;

                    $paymentDetails->user_id = $user_id;

                    $paymentDetails->payment_type = $input['card_type'];

                    $paymentDetails->detail = 'Payment for Job Post';

                    $paymentDetails->amount = $amount_chanrge;

                    $paymentDetails->card_number = $input['cardNumber'];

                    $paymentDetails->card_last_4 = $input['card_last_4'];

                    $paymentDetails->expiry = $input['cardExpiry'];

                    $paymentDetails->cvv = $input['cardCVC'];

                    $paymentDetails->save();

                    

                    $input['payment_date'] = date('Y-m-d');

                    $input['payment_status'] = 1;

                }

                $new_jobs = 0; 

            }

            else{

                $new_jobs = $job_remain - 1; 

                $input['payment_date'] = date('Y-m-d');

                $input['payment_status'] = 1;

            }

            

        }

        

        

        if(Input::has('does_not_apply'))

        {

            $input['does_not_apply'] = 1;

        }

        if($input['travel_required'] != 'Yes')

        {

            $input['travel_required'] = 0;

            $input['how_often'] = '';

        }

        else

        {

            $input['travel_required'] = 1;

        }

        

        // Skills and expertise

        $SpecificationArray = array();

        if(Input::has('specification'))

        {

            $allSpecifications = explode(',',$input['specification']);

            

            foreach($allSpecifications as $specification)

            {

                if($specification != '')

                {

                    $dataArray = array();

                    $opt = SkillsExpertise::where('name',$specification)->first();

                    if($opt)

                    {

                        $dataArray['id'] = $opt->id;

                        $dataArray['name'] = $opt->name;

                    }

                    else

                    {

                        $newOpt = new SkillsExpertise;

                        $newOpt->name = $specification;

                        $newOpt->user_id = $input['user_id'];

                        $newOpt->save();

                        $dataArray['id'] = $newOpt->id;

                        $dataArray['name'] = $newOpt->name;   

                    }

                }

                

                $SpecificationArray[] = $dataArray;

            }

        }

        if(!empty($SpecificationArray))

        {

            $serialized_array=serialize($SpecificationArray);    

        }

        else

        {

            $serialized_array = null;

        }

        $input['skills_expertise'] = $serialized_array;

        

        // for compensation and its range

        if($input['compensation_type'] == 'Hourly')

        {

            $input['compensation_range'] = $input['houryl_range'];

        }

        elseif($input['compensation_type'] == 'Salaried')

        {

            $input['compensation_range'] = $input['salaried_range'];

        }

        else

        {

            $input['compensation_range'] = null;

        }

        

        $input['status'] = 1;

        $input['expiry_date'] = date('Y-m-d',strtotime('+30 days',strtotime(date('Y-m-d'))));

        

        // for user unique number

        $unique = JobUnique::first();

        $next = $unique->number+1;

        $unique->number = $next;

        $unique->save();

        

        $unique_number = 'IJJ-'.$next;

        

        $input['unique_number'] = $unique_number;

        

        $input['external_url'] = $this->seo_friendly_url($input['title']).'-'.$unique_number;

        

        $job = Jobs::create($input);

        

        $user->job_post = $new_jobs;

        $user->save();

        

        /// user additional Industries

        if(Input::has('job_industries'))

        {

            $oldIndustries = JobIndustries::where('job_id',$job->id)->get();

            if($oldIndustries)

            {

                foreach($oldIndustries as $indst)

                {

                    $indst->delete();

                }

            }

            foreach(Input::get('job_industries') as $industry)

            {

                $userIndustries = new JobIndustries;

                $userIndustries->job_id = $job->id;

                $userIndustries->industry_id = $industry;

                $userIndustries->save();

            }

        }

        

        /// User Activity for message

        $usersActivity = new UsersActivity;

        $usersActivity->activity_name = 'You posted a New Job Listing, '.$job->title.'.';

        $usersActivity->activity_id = $job->id;

        $usersActivity->activity_type = 'job';

        $usersActivity->creater_id = $user_id;

        $usersActivity->receiver_id = null;

        $usersActivity->save();

        

        return Redirect::to('job/success/'.$job->id)->with('message', 'Your Job listing has been posted.');

    }

    

    public function payPendingJob(Request $request)

    {

        $input = $request->all();

        

        $job = Jobs::find($input['job_id']);

        

        $user_id = $input['user_id'];

        $user = User::find($user_id);

        $new_jobs = '';

        $payment_date = '';

        $payment_status = '';

        if($input['account_member'] == '')

        {

            

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

                    return Redirect::back()->with('message', 'There was a problem with your payment details. Please check and resubmit.');

                }

            } 

            

            if($amount > 0)

            {

                $charge = \Stripe\Charge::create(array(

                          "amount" => $amount*100,

                          "currency" => "usd",

                          "customer" => $user->stripe_id, // obtained with Stripe.js

                          "description" => "Charge for Job Post for ".$user->email

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

                $paymentDetails = new PaymentDetails;

                $paymentDetails->user_id = $user_id;

                $paymentDetails->payment_type = $input['card_type'];

                $paymentDetails->detail = 'Payment for Job Post';

                $paymentDetails->amount = $amount_chanrge;

                $paymentDetails->card_number = $input['cardNumber'];

                $paymentDetails->card_last_4 = $input['card_last_4'];

                $paymentDetails->expiry = $input['cardExpiry'];

                $paymentDetails->cvv = $input['cardCVC'];

                $paymentDetails->save();

                

                $payment_date = date('Y-m-d');

                $payment_status = 1;

            }

        }

        else

        {

            $job_remain = $user->job_post;

            if($job_remain == 0)

            {

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

                        return Redirect::back()->with('message', 'There was a problem with your payment details. Please check and resubmit.');

                    }

                } 

                

                if($amount > 0)

                {

                    $charge = \Stripe\Charge::create(array(

                              "amount" => $amount*100,

                              "currency" => "usd",

                              "customer" => $user->stripe_id, // obtained with Stripe.js

                              "description" => "Charge for Job Post for ".$user->email

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

                    $paymentDetails = new PaymentDetails;

                    $paymentDetails->user_id = $user_id;

                    $paymentDetails->payment_type = $input['card_type'];

                    $paymentDetails->detail = 'Payment for Job Post';

                    $paymentDetails->amount = $amount_chanrge;

                    $paymentDetails->card_number = $input['cardNumber'];

                    $paymentDetails->card_last_4 = $input['card_last_4'];

                    $paymentDetails->expiry = $input['cardExpiry'];

                    $paymentDetails->cvv = $input['cardCVC'];

                    $paymentDetails->save();

                    

                    $payment_date = date('Y-m-d');

                    $payment_status = 1;

                }

                $new_jobs = 0; 

            }

            else{

                $new_jobs = $job_remain - 1; 

                $payment_date = date('Y-m-d');

                $payment_status = 1;

            }

            

        }

        

        

        $job->payment_date = $payment_date;

        $job->payment_status = $payment_status;

        $job->save(); 

        

        $user->job_post = $new_jobs;

        $user->save();

        

        return Redirect::back()->with('message', 'Your job listing has been created.');

    }

    

    /**

     * Job Payment View

     */

    public function viewJobPayment($id)

    {

        $job = Jobs::find($id);

        $user = User::find(Auth::user()->id);

        return view('jobs.payment')->with(['user'=>$user,'job'=>$job]);

    }

    

    /**

     * Save job payment

     */

    public function saveJobPayment(Request $request)

    {

        $input = $request->all();

        return Redirect::to('job/success/'.$input['job_id'])->with('message', 'Your job listing payment has posted.');   

    }

    

    /**

     * Job's Success page

     */

    public function viewJobSuccess($id)

    {

        $job = Jobs::find($id);

        $user = User::find(Auth::user()->id);

        return view('jobs.success')->with(['user'=>$user,'job'=>$job]);

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

     * user job view

     */

    public function viewJob($id)

    {

        $job = Jobs::find($id);

        $user = User::find($job->user_id);

        $industries = Industry::all();

        

        // for set unique number

        if($job->unique_number == '')

        {

            // for user unique number

            $unique = JobUnique::first();

            $next = $unique->number+1;

            $unique->number = $next;

            $unique->save();

            

            $unique_number = 'IJJ-'.$next;

            

            $job->unique_number = $unique_number;

            $job->save();

        }

        

        // for set external url if blank

        if($job->external_link == '')

        {

            $job->external_url = $this->seo_friendly_url($job->title).'-'.$job->unique_number;    

            $job->save();

        }                        

        

        // skills

        if($job->skills_expertise != ''){

            if(@unserialize($job->skills_expertise))

            {

                $item_specifics_value = unserialize($job->skills_expertise);

                if(!empty($item_specifics_value))

                {

                    $job->specification = $item_specifics_value;

                }

                else

                {

                    $job->specification = array();

                }

            }

            else

            {

                $job->specification = array();

            }

            

        }else{

            $job->specification = array();

        }

        

        $company_id = $user->userdetail->company_id;

        if($company_id != '')

        {

            $UserCompany = Company::find($company_id);

            $UserCompany->user = User::find($UserCompany->user_id);

            if($UserCompany->user->account_member == 'gold')

            {

                $UserCompany->star = 'gold';

            }

            elseif($UserCompany->user->account_member == 'silver')

            {

                $UserCompany->star = 'silver';

            }

            else

            {

                $UserCompany->star = 'none';

            }

            $user->company = $UserCompany;

            $coworkers = UserDetails::whereRaw('company_id = ? AND user_id != ?',array($UserCompany,$user->id))->get()->toArray();

        }

        else

        {

            $UserCompany = new Company;

            $user->company = $UserCompany;

            $coworkers = array();

        }

        

        

        // get similar jobs of current

        $similarJobs = Jobs::getSimilarJob($job->id);

        foreach($similarJobs as $sm_job)

        {

            $jobUser = User::find($sm_job->user_id);

            $company_id = $jobUser->userdetail->company_id;

            if($company_id != '')

            {

                $UserCompany = Company::find($company_id);

                $UserCompany->user = User::find($UserCompany->user_id);

                $sm_job->company = $UserCompany;

            }

            else

            {

                $UserCompany = new Company;

                $sm_job->company = $UserCompany;

            }

        }

        

        // more jobs posted by same user

        $moreJobs = Jobs::where('user_id',$job->user_id)->whereNotIn('id',array($job->id))->orderBy('id','desc')->take(6)->get();

        foreach($moreJobs as $moreJob)

        {

            $jobUser = User::find($moreJob->user_id);

            $company_id = $jobUser->userdetail->company_id;

            if($company_id != '')

            {

                $UserCompany = Company::find($company_id);

                $UserCompany->user = User::find($UserCompany->user_id);

                $moreJob->company = $UserCompany;

            }

            else

            {

                $UserCompany = new Company;

                $moreJob->company = $UserCompany;

            }

        }

        

        return view('jobs.view')->with(['job'=>$job,'user'=>$user,'industries'=>$industries,'company'=>$UserCompany,'similar_jobs'=>$similarJobs,'moreJobs'=>$moreJobs,]); 

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $job = Jobs::find($id);

        $user_id = Auth::user()->id;

        

        $user = User::find($user_id);

        

        

        if($job->skills_expertise != ''){

            if(@unserialize($job->skills_expertise))

            {

                $item_specifics_value = unserialize($job->skills_expertise);

                if(!empty($item_specifics_value))

                {

                    $specification_string = '';

                    foreach($item_specifics_value as $index=>$item_specific)

                    {

                        if($index == 0)

                        {

                            $specification_string = $item_specific['name'];

                        }

                        else

                        {

                            $specification_string .= ','.$item_specific['name'];

                        }

                    }

                    $job->specification = $specification_string;

                    

                }

                else

                {

                    $job->specification = '';

                }

            }

            else

            {

                $job->specification = '';

            }

            

        }else{

            $job->specification = '';

        }

        

        $indutries = Industry::all();

        

        $selectedIndustries = array();

        $Industries = JobIndustries::where('job_id',$job->id)->get();

        foreach($Industries as $Industry)

        {

            $selectedIndustries[] = $Industry->industry_id;

        }

        

        $job_functions = JobsType::all();

        $countries = AppsCountries::all();

        return view('jobs.edit')->with(['job'=>$job,'user'=>$user,'job_functions'=>$job_functions,'countries'=>$countries,'indutries'=>$indutries,'selectedIndustries'=>$selectedIndustries]);

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

        // update Job

        $job = Jobs::find($id);

        

        $input = $request->all();

        

        $this->validate($request, [

            'title' => 'required'

        ]);

        

        

        if(Input::has('does_not_apply'))

        {

            $input['does_not_apply'] = 1;

        }

        if($input['travel_required'] != 'Yes')

        {

            $input['travel_required'] = 0;

            $input['how_often'] = '';

        }

        else

        {

            $input['travel_required'] = 1;

        }

        

        // Skills and expertise

        $SpecificationArray = array();

        if(Input::has('specification'))

        {

            $allSpecifications = explode(',',$input['specification']);

            

            foreach($allSpecifications as $specification)

            {

                if($specification != '')

                {

                    $dataArray = array();

                    $opt = SkillsExpertise::where('name',$specification)->first();

                    if($opt)

                    {

                        $dataArray['id'] = $opt->id;

                        $dataArray['name'] = $opt->name;

                    }

                    else

                    {

                        $newOpt = new SkillsExpertise;

                        $newOpt->name = $specification;

                        $newOpt->user_id = $input['user_id'];

                        $newOpt->save();

                        $dataArray['id'] = $newOpt->id;

                        $dataArray['name'] = $newOpt->name;   

                    }

                }

                

                $SpecificationArray[] = $dataArray;

            }

        }

        

        if(!empty($SpecificationArray))

        {

            $serialized_array=serialize($SpecificationArray);    

        }

        else

        {

            $serialized_array = null;

        }

        $input['skills_expertise'] = $serialized_array;

        

        // for compensation and its range

        if($input['compensation_type'] == 'Hourly')

        {

            $input['compensation_range'] = $input['houryl_range'];

        }

        elseif($input['compensation_type'] == 'Salaried')

        {

            $input['compensation_range'] = $input['salaried_range'];

        }

        else

        {

            $input['compensation_range'] = null;

        }

        

        ///////////////

        $job->fill($input)->save();

        

        /// user additional Industries

        if(Input::has('job_industries'))

        {

            $oldIndustries = JobIndustries::where('job_id',$job->id)->get();

            if($oldIndustries)

            {

                foreach($oldIndustries as $indst)

                {

                    $indst->delete();

                }

            }

            foreach(Input::get('job_industries') as $industry)

            {

                $userIndustries = new JobIndustries;

                $userIndustries->job_id = $job->id;

                $userIndustries->industry_id = $industry;

                $userIndustries->save();

            }

        }

        

        return Redirect::to('job')->with('message', 'Your job listing details have been updated.');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $job = Jobs::find($id);

        $job->delete();

        

        return Redirect::back()->with('message', 'Your job listing has been deleted.');

    }

    

    /**

     *  get skill and expertise

     */

    public function getSkillsExpertise()

    {

        $allSkillsOpt = SkillsExpertise::all();

        $ajaxArray = array();

        foreach($allSkillsOpt as $opt)

        {

            $ajaxArray[] = $opt->name;

        }

        return Response::json($ajaxArray);

    }

    

    /**

     * Change Job Status

     */

    public function setStatus($id,$status)

    {

        $job = Jobs::find($id);

        $job->status = $status;

        $job->save();

        

        return Redirect::back()->with('message', 'Your job listing status has been updated.');

    }

    

    /**

     * Extend job view

     */

    public function getJobExtend($id)

    {

        $job = Jobs::find($id);

        $html = '';

        $html .= '<div class="modal-dialog">

                <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                    <h4 class="modal-title">'.$job->title.'</h4>

                </div>

                <form action="'.url("job/save/extend").'" method="post" class="horizontal-form">

                <input type="hidden" name="job_id" value="'.$job->id.'" />

                <input type="hidden" name="_token" value="'.csrf_token().'" />

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12 form-group">

                            <label class="control-label">Expiry Date:</label>

                            <div class="">

                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">

                                    <input type="text" class="form-control" value="'.$job->expiry_date.'" name="expiry_date">

                                    <span class="input-group-btn">

                                        <button class="btn default" type="button">

                                            <i class="fa fa-calendar"></i>  

                                        </button>

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn red btn-circle" data-dismiss="modal">Close</button>

                    <button type="submite" class="btn yellow-crusta color-black btn-circle">Save changes</button>

                </div>

            </form></div></div>';

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        return Response::json($ajaxDataArray);

    }

    

    /**

     * Save extended date in job

     */

    public function saveJobExtend(Request $request)

    {

        $input = $request->all();

        $job = Jobs::find($input['job_id']);

        $job->expiry_date = $input['expiry_date'];

        $job->save();

        return Redirect::back()->with('message', 'Your job listing has been extended.');

    }

    

    /**

     * Search Job

     */

    public function viewSearchJob()

    {

        return view('jobs.search');

    }

    

    /**

     * serach result view

     */

    public function jobsSearchResult()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        if(isset($_REQUEST['search']))

        {

            $search = str_replace('+',' ',$_REQUEST['search']);

            $jobs = Jobs::whereRaw("(title LIKE '%$search%' OR job_position_title LIKE '%$search%') AND status = 1 AND user_id != $user_id ")->paginate(15);

            

            $previousPageUrl = $jobs->previousPageUrl();

            if($previousPageUrl != '')

            {

                $previousPageUrl = $jobs->previousPageUrl().'&search='.$_REQUEST['search'];//previous page url    

            }

            

            $nextPageUrl = $jobs->nextPageUrl();//next page url 

            if($nextPageUrl != '')

            {

                $nextPageUrl = $jobs->nextPageUrl().'&search='.$_REQUEST['search'];//next page url

            }

            

            

            $lastPage = $jobs->lastPage(); //Gives last page number

            $total = $jobs->total();

        }

        else

        {

            $search = '';

            $jobs = new Jobs;

            

            $previousPageUrl = '';//previous page url

            $nextPageUrl = '';//next page url

            $lastPage = ''; //Gives last page number

            $total = '';

        }

        return view('jobs.searchResult')->with([

                                                        'user'=>$user,

                                                        'jobs'=>$jobs,

                                                        'search'=>$search,

                                                        'previousPageUrl'=>$previousPageUrl,

                                                        'nextPageUrl'=>$nextPageUrl,

                                                        'lastPage'=>$lastPage,

                                                        "total"=>$total,

                                                        ]);

    }

    

    /**

     * job Search View

     */

    public function jobSearchResult()

    {

        $user_id = Auth::user()->id;

        $search = '';

        

        if(isset($_REQUEST['query']))

        {

            $search = str_replace('+',' ',$_REQUEST['query']);

            if($search != '')

            {

                $searchResults = array();

                

                // Job Search

                $jobs = Jobs::whereRaw("(title LIKE '%$search%' OR job_position_title LIKE '%$search%') AND status = 1 ")->get();

                

                foreach($jobs as $job)

                {

                    $job_user_id = $job->user_id;

                    $jobUser = User::find($job_user_id);

                    if($jobUser->account_member == 'gold')

                    {

                        $job->star = 'gold';

                    }

                    elseif($jobUser->account_member == 'silver')

                    {

                        $job->star = 'silver';

                    }

                    else

                    {

                        $job->star = 'none';

                    }

                    $job->user = $jobUser;

                    $job->search_type = 'job';

                    $searchResults[] = $job;

                }

                

                

                $page = Input::get('page', 1);

                $perPage = 15;

                //Get current page form url e.g. &page=6

                $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;

        

                //Create a new Laravel collection from the array data

                $collection = new Collection($searchResults);

        

                //Define how many items we want to be visible in each page

                $perPage = 15;

        

                //Slice the collection to get the items to display in current page

                $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();

        

                //Create our paginator and pass it to the view

                $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage,$page,['path' => request()->url(), 'query' => request()->query()]);

                //$paginatedSearchResults->setPath(url().request()->getPathInfo(),'?search=a');

                $total = count($collection);

            }

        }

        

        return view('search.jobs')->with(['results' => $paginatedSearchResults,'search' => $search,'total'=>$total]);        

    }

    

    /**

     * search products

     * 

     * @return \Illuminate\Http\Response

     */

     public function searchJobsList(Request $request)

     {

        $this->validate($request, [

            'search' => 'required',

        ]);

        

        $search = str_replace(' ',"+",Input::get('search'));

        return Redirect::to('jobs/search/result?query='.$search);

     }

     

     /**

      * save job to user

      */

     public function saveUserJobs($id,$user_id)

     {

        $jobSave = JobsSave::whereRaw('job_id = ? AND user_id = ?',array($id,$user_id))->first();

        if($jobSave)

        {

            return Redirect::back()->with('message', 'You have saved this job already.');

        }

        else

        {

            $newJobSave = new JobsSave;

            $newJobSave->job_id = $id;

            $newJobSave->user_id = $user_id;

            $newJobSave->save();

            

            /// User Activity for message

            $usersActivity = new UsersActivity;

            $usersActivity->activity_name = 'You saved a job listing for later viewing.';

            $usersActivity->activity_id = $id;

            $usersActivity->activity_type = 'job';

            $usersActivity->creater_id = $user_id;

            $usersActivity->receiver_id = null;

            $usersActivity->save();

            

            return Redirect::back()->with('message', 'This job listing has been saved in your account.');

        }

     }

     

     /**

      * save job to user

      */

     public function applyUserJob($id,$user_id)

     {

        $jobApply = JobsApply::whereRaw('job_id = ? AND user_id = ?',array($id,$user_id))->first();

        if($jobApply)

        {

            return Redirect::back()->with('message', 'You have previously applied to this job listing.');

        }

        else

        {

            $newJobApply = new JobsApply;

            $newJobApply->job_id = $id;

            $newJobApply->user_id = $user_id;

            $newJobApply->save();

            

            /// User Activity for message

            $job = Jobs::find($id);

            $usersActivity = new UsersActivity;

            $usersActivity->activity_name = 'An applicant has contacted you regarding your Job Listing '.$job->title.'.';

            $usersActivity->activity_id = $id;

            $usersActivity->activity_type = 'job';

            $usersActivity->creater_id = $job->user_id;

            $usersActivity->receiver_id = $user_id;

            $usersActivity->save();

            

            return Redirect::back()->with('message', 'Your job application has been sent.');

        }

     }

     

     /**

      * save apply job

      */

     public function applyJobSave(Request $request)

     {

        $input = $request->all();

        $user_id = Auth::user()->id;

        $jobApply = JobsApply::whereRaw('job_id = ? AND user_id = ?',array($input['job_id'],$input['apply_job_user']))->first();

        if($jobApply)

        {

            return Redirect::back()->with('message', 'You have previously applied for this job.');

        }

        else

        {

            if(Input::file('resume'))

            {

                /// PDF file upload to public folder ///

                $destinationPath = 'public/jobs/resume'; // upload path

                $pdfName = str_replace(' ','_',$request->file('resume')->getClientOriginalName()).'_'.rand(11111,99999). '.' .$request->file('resume')->getClientOriginalExtension();

                $request->file('resume')->move(

                    base_path() . '/'.$destinationPath, $pdfName

                );

                

                $input['resume'] = 'jobs/resume/'.$pdfName;

            }
            else
            {
                $input['resume'] = '';
            }

            if(Input::file('cover_latter'))
            {

                /// PDF file upload to public folder ///

                $destinationPath = 'public/jobs/coverletters'; // upload path

                $pdfName = str_replace(' ','_',$request->file('cover_latter')->getClientOriginalName()).'_'.rand(11111,99999). '.' .$request->file('cover_latter')->getClientOriginalExtension();

                $request->file('cover_latter')->move(

                    base_path() . '/'.$destinationPath, $pdfName

                );

                

                $input['cover_latter'] = 'jobs/coverletters/'.$pdfName;

            }
            else
            {
                $input['cover_latter'] = '';
            }

            $newJobApply = new JobsApply;

            $newJobApply->job_id = $input['job_id'];

            $newJobApply->user_id = $input['apply_job_user'];

            $newJobApply->resume = $input['resume'];

            $newJobApply->cover_latter = $input['cover_latter'];

            $newJobApply->summary = $input['summary'];

            $newJobApply->certify_information = $input['certify_information'];

            $newJobApply->authorized_work = $input['authorized_work'];

            $newJobApply->save();

            

            /// User Activity for message

            $job = Jobs::find($input['job_id']);

            $usersActivity = new UsersActivity;

            $usersActivity->activity_name = 'An applicant has contacted you regarding your Job Listing '.$job->title.'.';

            $usersActivity->activity_id = $input['job_id'];

            $usersActivity->activity_type = 'job';

            $usersActivity->creater_id = $job->user_id;

            $usersActivity->receiver_id = $user_id;

            $usersActivity->save();

            

            return Redirect::back()->with('message', 'Your job application has been sent.');

        }

     }

     

     /**

      * Ajax Job Detail

      */

     public function ajaxGetJobDetails($id)

     {

        $job = Jobs::find($id);

        $ajaxArray = array();

        $jobUser = User::find($job->user_id);

        $ajaxArray['company_name'] = '';

        if($jobUser->userdetail)

        {

            if($jobUser->userdetail->company_id != '')

            {

                $company = Company::find($jobUser->userdetail->company_id);

                $ajaxArray['company_name'] = $company->name;

            }

        }

        else

        {

            $company = Company::where('user_id',$jobUser->id)->first();

            $ajaxArray['company_name'] = $company->name;;

        }

        

        $ajaxArray['title'] = $job->title;

        $ajaxArray['user_id'] = Auth::user()->id;

        $ajaxArray['country'] = $job->country;

        return Response::json($ajaxArray);

     }

     

     /**

      * user's saved jobs

      */

     public function savedJobs()

     {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $jobs = JobsSave::where('user_id',$user_id)->orderBy('id','desc')->paginate(15);

        

        $previousPageUrl = $jobs->previousPageUrl();//previous page url

        $nextPageUrl = $jobs->nextPageUrl();//next page url

        $lastPage = $jobs->lastPage(); //Gives last page number

        $total = $jobs->total();

        

        return view('jobs.savedJob')->with([

                                        'jobs'=>$jobs,

                                        'user'=>$user,

                                        'previousPageUrl'=>$previousPageUrl,

                                        'nextPageUrl'=>$nextPageUrl,

                                        'lastPage'=>$lastPage,

                                        "total"=>$total,

                                        ]);

     }

     

     /**

      * Jon Applicants view

      */

     public function viewJobApplicants($id)

     {

        $applicants = JobsApply::where('job_id',$id)->orderBy('id','desc')->paginate(15);

        $job = Jobs::find($id);

        foreach($applicants as $applicant)

        {

            $applicant->user = User::find($applicant->user_id);

            

            if($applicant->user->userdetail->company_id != '')

            {

                $applicant->userCompany = Company::find($applicant->user->userdetail->company_id);    

            }

            else

            {

                $applicant->userCompany = '';

            }

        }

                

        $previousPageUrl = $applicants->previousPageUrl();//previous page url

        $nextPageUrl = $applicants->nextPageUrl();//next page url

        $lastPage = $applicants->lastPage(); //Gives last page number

        $total = $applicants->total();

        

        return view('jobs.applicants')->with([

                                        'applicants'=>$applicants,

                                        'job'=>$job,

                                        'previousPageUrl'=>$previousPageUrl,

                                        'nextPageUrl'=>$nextPageUrl,

                                        'lastPage'=>$lastPage,

                                        "total"=>$total,

                                        ]);

        

     }

     

     /**

      * Applicant Note save

      */

     public function applicantNoteSave(Request $request)

     {

        $input = $request->all();

        $applyJob = JobsApply::find($input['job_apply_id']);

        $jobApplyNote = new JobApplyNote;

        $jobApplyNote->job_apply_id = $input['job_apply_id'];

        $jobApplyNote->job_id = $applyJob->job_id;

        $jobApplyNote->user_id = $input['user_id'];

        $jobApplyNote->note = $input['note'];

        $jobApplyNote->save();

        

        return Redirect::back()->with('message', 'Your note has been recorded.');

     }

     

     /**

      * view job application

      */

     public function viewJobApplication($id)

     {

        $jobsApply = JobsApply::find($id);

        $jobsApply->user = User::find($jobsApply->user_id);

        $job = Jobs::find($jobsApply->job_id);

        return view('jobs.application')->with([

                                        'application'=>$jobsApply,

                                        'job'=>$job,

                                        ]);

     }

     

     /**

      * jon applivation reject

      */

     public function applicationReject($id)

     {

        $jobsApply = JobsApply::find($id);

        

        if($jobsApply->resume != '')

        {
            unlink('public/'.$jobsApply->resume);

        }

        if($jobsApply->cover_latter != '')

        {
            unlink('public/'.$jobsApply->cover_latter);

        }

        

        $jobsApply->delete();

        return Redirect::back()->with('message', 'Selected Application has been deleted.');

     }

    

}

