<?php

namespace App\Http\Controllers;

use App\QuotetekVerification;
use App\QuotetekVerificationProof;
use App\QuotetekUserVerification;
use App\QuotetekCompanyVerification;
use App\UserDetails;
use App\AppsCountries;
use App\Company;
use App\User;
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

class QuotetekVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        if(Auth::user()->access_level ==1)
        {
            $QuotetekVerifications = QuotetekVerification::paginate(15);
        }
        else
        {
            $QuotetekVerifications = QuotetekVerification::where('user_id',$user_id)->paginate(15);
        }
        
        $previousPageUrl = $QuotetekVerifications->previousPageUrl();//previous page url
        $nextPageUrl = $QuotetekVerifications->nextPageUrl();//next page url
        $lastPage = $QuotetekVerifications->lastPage(); //Gives last page number
        $total = $QuotetekVerifications->total();
        return view('quotetekverification.index')->with([
                                                        'quotetekVerifications'=>$QuotetekVerifications,
                                                        'previousPageUrl'=>$previousPageUrl,
                                                        'nextPageUrl'=>$nextPageUrl,
                                                        'lastPage'=>$lastPage,
                                                        "total"=>$total
                                                        ]);
    }
    
    /**
     * Users verififcations
     */
    public function usersVerifications()
    {
        $QuotetekVerifications = QuotetekUserVerification::paginate(15);
        foreach($QuotetekVerifications as $QuotetekVerification)
        {
            $user_id = $QuotetekVerification->user_id;
            $QuotetekVerification->user = User::find($user_id);
        }
        $previousPageUrl = $QuotetekVerifications->previousPageUrl();//previous page url
        $nextPageUrl = $QuotetekVerifications->nextPageUrl();//next page url
        $lastPage = $QuotetekVerifications->lastPage(); //Gives last page number
        $total = $QuotetekVerifications->total();
        return view('quotetekverification.usersVerificationGrid')->with([
                                                        'quotetekVerifications'=>$QuotetekVerifications,
                                                        'previousPageUrl'=>$previousPageUrl,
                                                        'nextPageUrl'=>$nextPageUrl,
                                                        'lastPage'=>$lastPage,
                                                        "total"=>$total
                                                        ]);
    }
    
    /**
     * Users verififcations
     */
    public function companyVerifications()
    {
        $QuotetekVerifications = QuotetekCompanyVerification::paginate(15);
        foreach($QuotetekVerifications as $QuotetekVerification)
        {
            $user_id = $QuotetekVerification->user_id;
            $QuotetekVerification->user = User::find($user_id);
        }
        $previousPageUrl = $QuotetekVerifications->previousPageUrl();//previous page url
        $nextPageUrl = $QuotetekVerifications->nextPageUrl();//next page url
        $lastPage = $QuotetekVerifications->lastPage(); //Gives last page number
        $total = $QuotetekVerifications->total();
        return view('quotetekverification.companyVerificationGrid')->with([
                                                        'quotetekVerifications'=>$QuotetekVerifications,
                                                        'previousPageUrl'=>$previousPageUrl,
                                                        'nextPageUrl'=>$nextPageUrl,
                                                        'lastPage'=>$lastPage,
                                                        "total"=>$total
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
        return view('quotetekverification.create')->with(['userData'=>$userData]);
    }
    
    /**
     * Quoetek User Verification View
     */
    public function addUserVerififcation()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $redirect_uri = env('LINKEDIN_REDIRECT_URL', '');
        $client_id = env('LINKEDIN_CLIENT_ID', '');
        $client_secret = env('LINKEDIN_CLIENT_SECRETE', '');
        $linkedin_verify = 0;
        if(isset($_REQUEST['verify']))
        {
            $verify = str_replace('#!','',$_REQUEST['verify']);
            if($verify == 1)
            {
                $linkedin_verify = 1;
            }    
        }
        else
        {
            $linkedin_verify = $user->linkedin_verify;
        }
        $status = '';
        $subnitedDate = '';
        $userVerificationSent = QuotetekUserVerification::where('user_id',$user_id)->first();
        if($userVerificationSent)
        {
            if($userVerificationSent->status == 0)
            {
                $status = 3; // for pendding status
            }
            else
            {
                $status = $userVerificationSent->status;
            }
            $subnitedDate = date('M d, Y',strtotime($userVerificationSent->created_at));
        }
        
        return view('quotetekverification.userVerification')->with([
                                                                    'user'=>$user,
                                                                    'redirect_uri'=>$redirect_uri,
                                                                    'client_id'=>$client_id,
                                                                    'client_secret'=>$client_secret,
                                                                    'linkedin_verify'=>$linkedin_verify,
                                                                    'status'=>$status,
                                                                    'subnitedDate'=>$subnitedDate
                                                                    ]);
    }
    
    /**
     * Save Quotetek user verification
     */
    /*public function saveUserVerification()
    {
        $input = Input::all();
        $user_id = $input['user_id'];
        
        /*if(Input::get('linkedin_verify') == 0)
        {
            $this->validate($input, [
                'utility_bill'  => 'required|required_if:requestType,sick|mimes:pdf,jpg,png,gif,jpeg,doc,docx',
                'state_issued_photo_id'  => 'required|required_if:requestType,sick|mimes:pdf,jpg,png,gif,jpeg,doc,docx',
            ]);    
        }*/
        //echo Input::file('utility_bill'); exit(0);
        /*$oldVerification = QuotetekUserVerification::where('user_id',$user_id)->first();
        $destinationPath = 'public/quotetek/proofs'; // upload path
        if($oldVerification)
        {
            if(Input::file('utility_bill'))
            {
                if($oldVerification->utility_bill_path != '')
                {
                    unlink($oldVerification->utility_bill_path);    
                }
                
                /// utility bill file upload to public folder ///
                
                $BillName = str_replace(' ','_',Auth::user()->name).'_bill_'.rand(11111,99999). '.' .Input::file('utility_bill')->getClientOriginalExtension();
                Input::file('utility_bill')->move(
                    base_path() . '/'.$destinationPath, $BillName
                );
                $input['utility_bill_path'] = $destinationPath.'/'.$BillName;
            }
            
            if(Input::file('state_issued_photo_id'))
            {
                if($oldVerification->state_id_path != '')
                {
                    unlink($oldVerification->state_id_path);    
                }
                
                /// state issued photo id file upload to public folder ///
                
                $StateIdName = str_replace(' ','_',Auth::user()->name).'_state_id_'.rand(11111,99999). '.' .Input::file('state_issued_photo_id')->getClientOriginalExtension();
                Input::file('state_issued_photo_id')->move(
                    base_path() . '/'.$destinationPath, $StateIdName
                );
                $input['state_id_path'] = $destinationPath.'/'.$StateIdName;
                
            }
            
            $oldVerification->user_id = $user_id;
            $oldVerification->utility_bill_path = $input['utility_bill_path'];
            $oldVerification->state_id_path = $input['state_id_path'];
            $user = User::find($user_id);
            $oldVerification->linkedin_vification = $user->linkedin_verify;
            $oldVerification->payment = 0;
            $oldVerification->status = 0;
            $oldVerification->save();
        }
        else
        {
            $userVerification = new QuotetekUserVerification;
            if(Input::file('utility_bill'))
            {
                /// utility bill file upload to public folder ///
                
                $BillName = str_replace(' ','_',Auth::user()->name).'_bill_'.rand(11111,99999). '.' .Input::file('utility_bill')->getClientOriginalExtension();
                Input::file('utility_bill')->move(
                    base_path() . '/'.$destinationPath, $BillName
                );
                $input['utility_bill_path'] = $destinationPath.'/'.$BillName;
                
            }
            
            if(Input::file('state_issued_photo_id'))
            {
                /// state issued photo id file upload to public folder ///
                
                $StateIdName = str_replace(' ','_',Auth::user()->name).'_state_id_'.rand(11111,99999). '.' .Input::file('state_issued_photo_id')->getClientOriginalExtension();
                Input::file('state_issued_photo_id')->move(
                    base_path() . '/'.$destinationPath, $StateIdName
                );
                $input['state_id_path'] = $destinationPath.'/'.$StateIdName;
                
            }
            
            $userVerification->user_id = $user_id;
            $userVerification->utility_bill_path = $input['utility_bill_path'];
            $userVerification->state_id_path = $input['state_id_path'];
            $user = User::find($user_id);
            $userVerification->linkedin_vification = $user->linkedin_verify;
            $userVerification->payment = 0;
            $userVerification->status = 0;
            $userVerification->save();
        }
        
        // save user data
        $user = User::find($user_id);
        $user->email = $input['email'];
        $user->save();
        
        /// save user details
        $userData = UserDetails::where('user_id',$user_id)->first();
        $userData->first_name = $input['first_name'];
        $userData->last_name = $input['last_name'];
        $userData->alias_name = $input['alias_name'];
        $userData->save();
        
        /// User Activity for message
        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'You chose to verify your account on '.date('M d, Y').'.';
        $usersActivity->activity_id = $user_id;
        $usersActivity->activity_type = 'user_verification';
        $usersActivity->creater_id = $user_id;
        $usersActivity->receiver_id = null;
        $usersActivity->save();

        //return Redirect::to('quotetek/payment/'.$user_id.'/50/verification');
        $ajaxArray = array();
        $ajaxArray['success'] = true;
        return Response::json($ajaxArray);
    }*/


    public function saveUserVerification(Request $request)
    {
        $input = $request->all();

        $user_id = $input['user_id'];

        /*if(Input::get('linkedin_verify') == 0)
        {
            $this->validate($input, [
                'utility_bill'  => 'required|required_if:requestType,sick|mimes:pdf,jpg,png,gif,jpeg,doc,docx',
                'state_issued_photo_id'  => 'required|required_if:requestType,sick|mimes:pdf,jpg,png,gif,jpeg,doc,docx',
            ]);
        }*/

        $oldVerification = QuotetekUserVerification::where('user_id',$user_id)->first();
        $destinationPath = 'public/quotetek/proofs'; // upload path
        if($oldVerification)
        {
            if(Input::file('utility_bill'))
            {
                if($oldVerification->utility_bill_path != '')
                {
                    unlink('public/'.$oldVerification->utility_bill_path);
                }

                /// utility bill file upload to public folder ///

                $BillName = str_replace(' ','_',Auth::user()->name).'_bill_'.rand(11111,99999). '.' .$request->file('utility_bill')->getClientOriginalExtension();
                $request->file('utility_bill')->move(
                base_path() . '/'.$destinationPath, $BillName
                );
                $input['utility_bill_path'] = 'quotetek/proofs/'.$BillName;
            }

            if(Input::file('state_issued_photo_id'))
            {
                if($oldVerification->state_id_path != '')
                {
                    unlink('public/'.$oldVerification->state_id_path);
                }

                /// state issued photo id file upload to public folder ///

                $StateIdName = str_replace(' ','_',Auth::user()->name).'_state_id_'.rand(11111,99999). '.' .$request->file('state_issued_photo_id')->getClientOriginalExtension();
                $request->file('state_issued_photo_id')->move(

                base_path() . '/'.$destinationPath, $StateIdName
                );
                $input['state_id_path'] = 'quotetek/proofs/'.$StateIdName;

            }

            $oldVerification->user_id = $user_id;
            $oldVerification->utility_bill_path = $input['utility_bill_path'];
            $oldVerification->state_id_path = $input['state_id_path'];
            $user = User::find($user_id);
            $oldVerification->linkedin_vification = $user->linkedin_verify;
            $oldVerification->payment = 0;
            $oldVerification->status = 0;
            $oldVerification->save();
        }
        else
        {
            $userVerification = new QuotetekUserVerification;
            if(Input::file('utility_bill'))
            {
                /// utility bill file upload to public folder ///

                $BillName = str_replace(' ','_',Auth::user()->name).'_bill_'.rand(11111,99999). '.' .$request->file('utility_bill')->getClientOriginalExtension();
                $request->file('utility_bill')->move(
                base_path() . '/'.$destinationPath, $BillName
                );
                $input['utility_bill_path'] = 'quotetek/proofs/'.$BillName;

            }

            if(Input::file('state_issued_photo_id'))
            {
                /// state issued photo id file upload to public folder ///

                $StateIdName = str_replace(' ','_',Auth::user()->name).'_state_id_'.rand(11111,99999). '.' .$request->file('state_issued_photo_id')->getClientOriginalExtension();
                $request->file('state_issued_photo_id')->move(

                base_path() . '/'.$destinationPath, $StateIdName
                );
                $input['state_id_path'] = 'quotetek/proofs/'.$StateIdName;

            }

            $userVerification->user_id = $user_id;
            $userVerification->utility_bill_path = $input['utility_bill_path'];
            $userVerification->state_id_path = $input['state_id_path'];
            $user = User::find($user_id);
            $userVerification->linkedin_vification = $user->linkedin_verify;
            $userVerification->payment = 0;
            $userVerification->status = 0;
            $userVerification->save();
        }

        // save user data
        $user = User::find($user_id);
        $user->email = $input['email'];
        $user->save();

        /// save user details
        $userData = UserDetails::where('user_id',$user_id)->first();
        $userData->first_name = $input['first_name'];
        $userData->last_name = $input['last_name'];
        $userData->alias_name = $input['alias_name'];
        $userData->save();

        /// User Activity for message
        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'You chose to verify your account on '.date('M d, Y').'.';
        $usersActivity->activity_id = $user_id;
        $usersActivity->activity_type = 'user_verification';
        $usersActivity->creater_id = $user_id;
        $usersActivity->receiver_id = null;
        $usersActivity->save();

        //return Redirect::to('quotetek/payment/'.$user_id.'/50/verification');
        $ajaxArray = array();
        $ajaxArray['success'] = true;
        return Response::json($ajaxArray);
    }
    
    /**
     * user verification view
     */
    public function viewUserVerififcation()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $userVerififcation = QuotetekUserVerification::where('user_id',$user_id)->first();
        if(!$userVerififcation)
        {
            $userVerififcation = '';
        }
        return view('quotetekverification.userVerificationView')->with(['user'=>$user,'userVerififcation'=>$userVerififcation]);
    }
    
    /**
     * Quoetek Company Verification View
     */
    public function addCompanyVerififcation()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $countries = AppsCountries::all();
        $companyVerification = QuotetekCompanyVerification::where('user_id',$user_id)->first();
        if(!$companyVerification)
        {
            $companyVerification = new QuotetekCompanyVerification;
        }
        return view('quotetekverification.companyVerification')->with(['user'=>$user,'countries'=>$countries,'companyVerification'=>$companyVerification]);
    }
    
    /**
     * Quotetek Company referrence add
     */
    public function addCompanyReference($id)
    {
        $html = '';
        $html .= '<div class="modal-dialog">
                    <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add your reference Details</h4>
                </div>
                <form id="company-reference-add" action="'.url("company/reference/save").'" method="post" class="horizontal-form">
                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                    <input type="hidden" name="reference" value="'.$id.'" />
                    <input type="hidden" name="user_id" value="'.Auth::user()->id.'" />
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="col-md-6">
                                <label class="control-label">Name:</label>
                				<input type="text" class="form-control" name="ref_name" placeholder="Enter Reference Name">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Phone:</label>
                				<input type="text" class="form-control" name="ref_phone" placeholder="Enter Reference Phone">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="col-md-6">
                                <label class="control-label">Email:</label>
                				<input type="email" class="form-control" name="ref_email" placeholder="Enter Reference Email" required="">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Relation:</label>
                				<input type="text" class="form-control" name="ref_relation" placeholder="Enter Reference Relation">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn red" data-dismiss="modal">Close</button>
                    <button type="button" onclick="saveCompanyReference();" class="btn yellow-crusta color-black">Save</button>
                </div>
            </form></div></div>';
        $ajaxDataArray = array();
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }
    
    /**
     * edit company reference
     */
    public function editCompanyReference($id,$type)
    {
        $companyVerification = QuotetekCompanyVerification::find($id);
        $html = '';
        $html .= '<div class="modal-dialog">
                    <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add your reference Details</h4>
                </div>
                <form id="company-reference-add" action="'.url("company/reference/save").'" method="post" class="horizontal-form">
                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                    <input type="hidden" name="reference" value="'.$type.'" />
                    <input type="hidden" name="user_id" value="'.Auth::user()->id.'" />
                <div class="modal-body">
                    
                    <div class="row">';
                        if($type == 1):
                        $html .= '<div class="col-md-12 form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Name:</label>
                        				<input type="text" class="form-control" name="ref_name" value="'.$companyVerification->ref_1_name.'" placeholder="Enter Reference Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Phone:</label>
                        				<input type="text" class="form-control" name="ref_phone" value="'.$companyVerification->ref_1_phone.'" placeholder="Enter Reference Phone">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Email:</label>
                        				<input type="email" class="form-control" name="ref_email" value="'.$companyVerification->ref_1_email.'" placeholder="Enter Reference Email" required="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Relation:</label>
                        				<input type="text" class="form-control" name="ref_relation" value="'.$companyVerification->ref_1_relation.'" placeholder="Enter Reference Relation">
                                    </div>
                                </div>';
                        else:
                        $html .= '<div class="col-md-12 form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Name:</label>
                        				<input type="text" class="form-control" name="ref_name" value="'.$companyVerification->ref_2_name.'" placeholder="Enter Reference Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Phone:</label>
                        				<input type="text" class="form-control" name="ref_phone" value="'.$companyVerification->ref_2_phone.'" placeholder="Enter Reference Phone">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Email:</label>
                        				<input type="email" class="form-control" name="ref_email" value="'.$companyVerification->ref_2_email.'" placeholder="Enter Reference Email" required="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Relation:</label>
                        				<input type="text" class="form-control" name="ref_relation" value="'.$companyVerification->ref_2_relation.'" placeholder="Enter Reference Relation">
                                    </div>
                                </div>';
                        endif;
        $html .= '</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn red" data-dismiss="modal">Close</button>
                    <button type="button" onclick="saveCompanyReference();" class="btn yellow-crusta color-black">Save</button>
                </div>
            </form></div></div>';
        $ajaxDataArray = array();
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }
    
    /**
     * save company reference
     */
    public function saveCompanyReference()
    {
        $input = Input::all();
        
        $companyVerification = QuotetekCompanyVerification::where('user_id',Auth::user()->id)->first();
        if(!$companyVerification)
        {
            $companyVerification = new QuotetekCompanyVerification;
        }
        
        $html = '';
        if($input['reference'] == 1)
        {
            $companyVerification->user_id = $input['user_id'];
            $companyVerification->ref_1_name = $input['ref_name'];
            $companyVerification->ref_1_phone = $input['ref_phone'];
            $companyVerification->ref_1_email = $input['ref_email'];
            $companyVerification->ref_1_relation = $input['ref_relation'];
            $companyVerification->save();
            
            $html .= '<div class="paddin-bottom">
                        <input type="hidden" name="reference_1_name" value="'.$companyVerification->ref_1_name.'" />
                        <input type="hidden" name="reference_1_phone" value="'.$companyVerification->ref_1_phone.'" />
                        <input type="hidden" name="reference_1_email" value="'.$companyVerification->ref_1_email.'" />
                        <input type="hidden" name="reference_1_relation" value="'.$companyVerification->ref_1_relation.'" />
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Relation</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$companyVerification->ref_1_name.'</td>
                                    <td>'.$companyVerification->ref_1_phone.'</td>
                                    <td>'.$companyVerification->ref_1_email.'</td>
                                    <td>'.$companyVerification->ref_1_relation.'</td>
                                    <td>
                                        <a href="javascript:void(0)" id="'.url('company/reference/edit').'/'.$companyVerification->id.'/1" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">
                                            <i class="fa fa-edit"></i>  Edit </a>
                                        <a href="javascript:void(0)" id="'.url('company/reference/delete').'/'.$companyVerification->id.'/1" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">
                                            <i class="fa fa-remove"></i>  Delete </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>';
        }
        elseif($input['reference'] == 2)
        {
            $companyVerification->user_id = $input['user_id'];
            $companyVerification->ref_2_name = $input['ref_name'];
            $companyVerification->ref_2_phone = $input['ref_phone'];
            $companyVerification->ref_2_email = $input['ref_email'];
            $companyVerification->ref_2_relation = $input['ref_relation'];
            $companyVerification->save();
            $html .= '<div class="paddin-bottom">
                        <input type="hidden" name="reference_2_name" value="'.$companyVerification->ref_2_name.'" />
                        <input type="hidden" name="reference_2_phone" value="'.$companyVerification->ref_2_phone.'" />
                        <input type="hidden" name="reference_2_email" value="'.$companyVerification->ref_2_email.'" />
                        <input type="hidden" name="reference_2_relation" value="'.$companyVerification->ref_2_relation.'" />
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Relation</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$companyVerification->ref_2_name.'</td>
                                    <td>'.$companyVerification->ref_2_phone.'</td>
                                    <td>'.$companyVerification->ref_2_email.'</td>
                                    <td>'.$companyVerification->ref_2_relation.'</td>
                                    <td>
                                        <a href="javascript:void(0)" id="'.url('company/reference/edit').'/'.$companyVerification->id.'/2" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">
                                            <i class="fa fa-edit"></i>  Edit </a>
                                        <a href="javascript:void(0)" id="'.url('company/reference/delete').'/'.$companyVerification->id.'/2" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">
                                            <i class="fa fa-remove"></i>  Delete </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>';
        }
        
        
        
        $ajaxDataArray = array();
        $ajaxDataArray['html'] = $html;
        $ajaxDataArray['ref_type'] = $input['reference'];
        return Response::json($ajaxDataArray);
    }
    
    /**
     * delete company reference
     */
    public function deleteCompanyReference($id,$type)
    {
        $companyVerification = QuotetekCompanyVerification::find($id);
        $html = '';
        if($type == 1)
        {
            $companyVerification->ref_1_name = '';
            $companyVerification->ref_1_phone = '';
            $companyVerification->ref_1_email = '';
            $companyVerification->ref_1_relation = '';
            $companyVerification->save();
            
            $html .= '<div class="paddin-bottom">
                        <input type="hidden" name="reference_1_name" value="'.$companyVerification->ref_1_name.'" />
                        <input type="hidden" name="reference_1_phone" value="'.$companyVerification->ref_1_phone.'" />
                        <input type="hidden" name="reference_1_email" value="'.$companyVerification->ref_1_email.'" />
                        <input type="hidden" name="reference_1_relation" value="'.$companyVerification->ref_1_relation.'" />
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Relation</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>';
        }
        elseif($type == 2)
        {
            $companyVerification->ref_2_name = '';
            $companyVerification->ref_2_phone = '';
            $companyVerification->ref_2_email = '';
            $companyVerification->ref_2_relation = '';
            $companyVerification->save();
            $html .= '<div class="paddin-bottom">
                        <input type="hidden" name="reference_2_name" value="'.$companyVerification->ref_2_name.'" />
                        <input type="hidden" name="reference_2_phone" value="'.$companyVerification->ref_2_phone.'" />
                        <input type="hidden" name="reference_2_email" value="'.$companyVerification->ref_2_email.'" />
                        <input type="hidden" name="reference_2_relation" value="'.$companyVerification->ref_2_relation.'" />
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Relation</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>';
        }
        $ajaxDataArray = array();
        $ajaxDataArray['html'] = $html;
        $ajaxDataArray['ref_type'] = $type;
        return Response::json($ajaxDataArray);
    }
    
    /**
     * save company verififcation
     */
    public function saveCompanyVerification(Request $request)
    {
        $input = $request->all();
        $user_id = $input['user_id'];
        
        $this->validate($request, [
            'utility_bill'  => 'required|required_if:requestType,sick|mimes:pdf,jpg,png,gif,jpeg,doc,docx',
            'website'  => 'required',
            'reference_1_name' => 'required',
            'reference_1_email' => 'required|email',
            'reference_2_name' => 'required',
            'reference_1_email' => 'required|email',
        ]);
        
        $oldVerification = QuotetekCompanyVerification::where('user_id',$user_id)->first();
        $destinationPath = 'public/quotetek/proofs'; // upload path
        if($oldVerification)
        {
            if(Input::file('utility_bill'))
            {
                if($oldVerification->utility_bill_path != '')
                {
                    unlink('public/'.$oldVerification->utility_bill_path);
                }
                
                /// utility bill file upload to public folder ///
                
                $BillName = str_replace(' ','_',Auth::user()->name).'_bill_'.rand(11111,99999). '.' .$request->file('utility_bill')->getClientOriginalExtension();
                $request->file('utility_bill')->move(
                    base_path() . '/'.$destinationPath, $BillName
                );
                $input['utility_bill_path'] = 'quotetek/proofs/'.$BillName;
                
            }
            
            $oldVerification->user_id = $user_id;
            $oldVerification->utility_bill_path = $input['utility_bill_path'];
            $oldVerification->website_url = $input['website'];
            $oldVerification->payment = 0;
            $oldVerification->status = 0;
            $oldVerification->save();
        }
        else
        {
            $companyVerification = new QuotetekCompanyVerification;
            if(Input::file('utility_bill'))
            {
                /// utility bill file upload to public folder ///
                
                $BillName = str_replace(' ','_',Auth::user()->name).'_bill_'.rand(11111,99999). '.' .$request->file('utility_bill')->getClientOriginalExtension();
                $request->file('utility_bill')->move(
                    base_path() . '/'.$destinationPath, $BillName
                );
                $input['utility_bill_path'] = 'quotetek/proofs/'.$BillName;
                
            }
            
            $companyVerification->user_id = $user_id;
            $companyVerification->utility_bill_path = $input['utility_bill_path'];
            $companyVerification->website_url = $input['website'];
            $userVerification->payment = 0;
            $userVerification->status = 0;
            $userVerification->save();
        }
        
        // save user data
        $user = User::find($user_id);
        $user->email = $input['email'];
        $user->save();
        
        /// save user details
        $companyData = Company::where('user_id',$user_id)->first();
        $companyData->name = $input['name'];
        $companyData->email = $input['email'];
        $companyData->address = $input['address'];
        $companyData->address2 = $input['address2'];
        $companyData->city = $input['city'];
        $companyData->state = $input['state'];
        if(Input::has('country'))
        {
            $companyData->country = $input['country'];    
        }
        $companyData->zip = $input['zip'];
        $companyData->website = $input['website'];
        $companyData->save();
        
        /// User Activity for message
        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'You chose to verify your account on '.date('M d, Y').'.';
        $usersActivity->activity_id = $user_id;
        $usersActivity->activity_type = 'company_verification';
        $usersActivity->creater_id = $user_id;
        $usersActivity->receiver_id = null;
        $usersActivity->save();
        
        return Redirect::to('quotetek/payment/'.$user_id.'/100/verification');
    }
    
    /**
     * company verification view
     */
    public function viewCompanyVerififcation()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $companyVerififcation = QuotetekCompanyVerification::where('user_id',$user_id)->first();
        if(!$companyVerififcation)
        {
            $companyVerififcation = '';
        }
        return view('quotetekverification.companyVerificationView')->with(['user'=>$user,'companyVerififcation'=>$companyVerififcation]);
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
        $user_id = $input['user_id'];
        $oldVerification = QuotetekVerification::where('user_id',$user_id)->first();
        if($oldVerification)
        {
            $proofs = QuotetekVerificationProof::where('quotetek_verification_id',$oldVerification->id)->get();
            foreach($proofs as $proof)
            {
                $full_path = '';
                $full_path = $proof->path;
                unlink('public/'.$full_path);
            }
            $oldVerification->delete();
        }
        
        $QuotetekVerification = QuotetekVerification::create($input);
        $quotetekverififcation_id = $QuotetekVerification->id;
        foreach($input['proofs'] as $proof)
        {
            if($proof != '')
            {
                $destinationPath = 'public/quotetek/proofs'; // upload path
                $proofName = 'verification_'.rand(11111111,99999999). '.' .$proof->getClientOriginalExtension();
                $proof->move(
                    base_path() . '/'.$destinationPath, $proofName
                );
                $path = '';
                $path = 'quotetek/proofs/'.$proofName;
                $QuotetekVerificationProof = '';
                $QuotetekVerificationProof = new QuotetekVerificationProof;
                $QuotetekVerificationProof->quotetek_verification_id = $quotetekverififcation_id;
                $QuotetekVerificationProof->path = $path;
                $QuotetekVerificationProof->save();
            }
        }
        return Redirect::to('quotetekverification')->with('message', 'Your verification proof has been uploaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $verification = QuotetekVerification::find($id);
        $user_id = $verification->user_id;
        $user = User::find($user_id);
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData)
        {
            $verification->full_name = $userData->first_name.' '.$userData->last_name;
            $verification->account_type = $userData->account_type;
        }
        else
        {
            $verification->full_name = $user->name;
            $verification->account_type = 'Company';
        }
        
        return view('quotetekverification.view')->with(['verification'=>$verification,'user'=>$user,'userData'=>$userData]);
    }
    
    /**
     * Verififcation view
     */
    public function verificationView($type,$id)
    {
        if($type == 'user')
        {
            $verification = QuotetekUserVerification::find($id);
        }
        else
        {
            $verification = QuotetekCompanyVerification::find($id);
        }
        
        $user_id = $verification->user_id;
        $user = User::find($user_id);
        
        if($user->access_level == 4)
        {
            $verification->full_name = $user->name;
            $verification->account_type = 'Company';
            $userData = Company::where('user_id',$user_id)->first();
        }
        else
        {
            $userData = UserDetails::where('user_id',$user_id)->first();
            $verification->full_name = $userData->first_name.' '.$userData->last_name;
            $verification->account_type = $userData->account_type;
        }
        
        return view('quotetekverification.view')->with(['verification'=>$verification,'user'=>$user,'userData'=>$userData,'type'=>$type]);
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
        $QuotetekVerification = QuotetekVerification::find($id);
        
        $user_id = $QuotetekVerification->user_id;
        $user = User::find($user_id);
        $user->quotetek_verify = 0;
        $user->save();
        
        $proofs = QuotetekVerificationProof::where('quotetek_verification_id',$id)->get();
        foreach($proofs as $proof)
        {
            $full_path = '';
            $full_path = $proof->path;
            unlink('public/'.$full_path);
        }
        $QuotetekVerification->delete();
        
        /* quote receive mail to receiver */
        $receiverData = UserDetails::where('user_id',$user_id)->first();
        $receiver = User::find($user_id);
        
        Input::replace(array('email' => $receiver->email,'name'=>$receiverData->first_name.' '.$receiverData->last_name));
        $data = array(
                        'name'=>Input::get('name')
                        );
        Mail::send('admin.Emailtemplates.accountSuspended', $data, function($message){
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to(Input::get('email'), Input::get('name'))->subject('Your Indy John account has been suspended');
        });
        
        return Redirect::to('quotetekverification')->with('message', 'Your verification proof has been deleted.');
    }
    
    /**
     * add proof select
     */
    public function addProof($id)
    {
        $current_id = $id;
        $next_id = $id + 1;
        $html = '';
        $html .= '<div id="proof-file-'.$current_id.'" class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="input-group input-large">
                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                            <i class="fa fa-file fileinput-exists"></i>  &nbsp;
                            <span class="fileinput-filename"> </span>
                        </div>
                        <span class="input-group-addon btn default btn-file">
                            <span class="fileinput-new"> Select file </span>
                            <span class="fileinput-exists"> Change </span>
                            <input type="file" data-required="1" name="proofs[]" > </span>
                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                        <a href="javascript:void(0)" id="removemain_'.$current_id.'" class="input-group-addon btn red" onclick="removeMainOption(id)" style="padding-left:10px">Delete</a>
                    </div>
                </div>';
        $ajaxArray = array();
        $ajaxArray['success'] = true;
        $ajaxArray['html'] = $html;
        $ajaxArray['next_id'] = $next_id;
        return Response::json($ajaxArray);
        
    }
    
    /**
     * Approve verification
     */
    public function verificationApprove($type,$id)
    {
        if($type == 'user')
        {
            $QuotetekVerification = QuotetekUserVerification::find($id);
            $QuotetekVerification->status = 1;
            $QuotetekVerification->save();
            
            /// quotetek verify edit in user table
            $user_id = $QuotetekVerification->user_id;
            $user = User::find($user_id);
            $user->quotetek_verify = 1;
            $user->save();
            
            return Redirect::to('users/verififcation')->with('message', 'Your Indy John account has been verified.');
        }
        else
        {
            $QuotetekVerification = QuotetekCompanyVerification::find($id);
            $QuotetekVerification->status = 1;
            $QuotetekVerification->save();
            
            /// quotetek verify edit in user table
            $user_id = $QuotetekVerification->user_id;
            $user = User::find($user_id);
            $user->quotetek_verify = 1;
            $user->save();
            
            return Redirect::to('company/verification')->with('message', 'Your Indy John account has been verified.');
        }
    }
    
    /**
     * Disapprove verification
     */
    public function verificationDisapprove($type,$id)
    {
        if($type == 'user')
        {
            $QuotetekVerification = QuotetekUserVerification::find($id);
            $QuotetekVerification->status = 2;
            $QuotetekVerification->save();
            
            /// quotetek verify edit in user table
            $user_id = $QuotetekVerification->user_id;
            $user = User::find($user_id);
            $user->quotetek_verify = 0;
            $user->save();
            
            return Redirect::to('users/verififcation')->with('message', 'Unable to verify your Indy John account details.');
        }
        else
        {
            $QuotetekVerification = QuotetekCompanyVerification::find($id);
            $QuotetekVerification->status = 2;
            $QuotetekVerification->save();
            
            /// quotetek verify edit in user table
            $user_id = $QuotetekVerification->user_id;
            $user = User::find($user_id);
            $user->quotetek_verify = 0;
            $user->save();
            
            return Redirect::to('company/verification')->with('message', 'Unable to verify your Indy John account details.');
        }
    }
    
    public function verificationDelete($type,$id)
    {
        if($type == 'user')
        {
            $QuotetekVerification = QuotetekUserVerification::find($id);
        
            $user_id = $QuotetekVerification->user_id;
            $user = User::find($user_id);
            $user->quotetek_verify = 0;
            $user->save();
            
            if($QuotetekVerification->utility_bill_path != '')
            {
                $full_path = '';
                $full_path = $QuotetekVerification->utility_bill_path;
                unlink('public/'.$full_path);
            }
            
            if($QuotetekVerification->state_id_path != '')
            {
                $full_path = '';
                $full_path = $QuotetekVerification->state_id_path;
                unlink('public/'.$full_path);
            }
            
            $QuotetekVerification->delete();
        }
        else
        {
            $QuotetekVerification = QuotetekCompanyVerification::find($id);
        
            $user_id = $QuotetekVerification->user_id;
            $user = User::find($user_id);
            $user->quotetek_verify = 0;
            $user->save();
            
            if($QuotetekVerification->utility_bill_path != '')
            {
                $full_path = '';
                $full_path = $QuotetekVerification->utility_bill_path;
                unlink('public/'.$full_path);
            }
            
            $QuotetekVerification->delete();
        }
        
        
        /* quote receive mail to receiver */
        $name = '';
        $receiver = User::find($user_id);
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
                        'name'=>Input::get('name')
                        );
        Mail::send('admin.Emailtemplates.accountSuspended', $data, function($message){
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to(Input::get('email'), Input::get('name'))->subject('Your Indy John account has been suspended');
        });
        if($type == 'user')
        {
            return Redirect::to('users/verififcation')->with('message', 'Your action has been completed.');    
        }
        else
        {
            return Redirect::to('company/verification')->with('message', 'Your action has been completed.');
        }
    }
    
    /**
     * user verification status change
     */
    public function changeVerificationStatus($id)
    {
        $user = User::find($id);
        $user->quotetek_verify = 0;
        $user->save();
        return Redirect::back();
    }
}
