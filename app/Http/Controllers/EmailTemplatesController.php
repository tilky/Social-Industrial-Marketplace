<?php

namespace App\Http\Controllers;

use App\EmailTemplates;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Input;
use Auth;
use Response;
use View;

class EmailTemplatesController extends Controller
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
        $this->validate($request, [
            'content' => 'required',
        ]);
        //Creating accreditations and go back to index.
        $input = $request->all();
        $backurl = Input::get('backlink');
        $template_id = Input::get('template_id');
        $templateObj = EmailTemplates::where('template_id',$template_id)->first();
        if($templateObj)
        {
            $templateObj->content = Input::get('content');
            $templateObj->save();
        }
        else
        {
            $emailTemplate = EmailTemplates::create($input);    
        }
        
        
        return Redirect::to($backurl)->with('message', 'E-mail template has been saved.');
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
    
    public function EmailTemplate($template_id)
    {
        $templateObj = EmailTemplates::where('template_id',$template_id)->first();
        $templateNameArray = array('1'=>'New Buyer Email Template','2'=>'New Seller Email Template','3'=>'New Quote Request Posted','4'=>'New Marketplace Product Posted',
                                    '5'=>'New Lead Matched for Seller','6'=>'New Lear Matched for buyer','7'=>'New Lead matched but seller not authorized to view',
                                    '8'=>'Support Ticket Initial','9'=>'New Message Received','10'=>'New quote Received','11'=>'New Endorsement','12'=>'New Feedback',
                                    '13'=>'New Purchase interested in Marketplace product','14'=>'New Referral Received','15'=>'Account Suspended email','16'=>'Package Expired Email',
                                    '17'=>'Package Subscription payment received email',);
        $templateName = $templateNameArray[$template_id];
        if($templateObj)
        {
            $content = $templateObj->content;
        }
        else
        {
            $content = '';
        }
        return view('admin.Emailtemplates.newTemplate')->with(['content'=>$content,'template_id'=>$template_id,'templateName'=>$templateName]);
    }
    
    public function EmailView($template_id)
    {
        $templateObj = EmailTemplates::where('template_id',$template_id)->first();
        $view = View::make('admin.Emailtemplates.viewTemplate', ['template'=>$templateObj,'name' => 'Arjun','email'=>'test','password'=>'asdsadsad']);
        $contents = $view->render();
        // or
        $contents = (string) $view;
        echo $contents;
        exit(0);
        $templateObj = EmailTemplates::where('template_id',$template_id)->first();
        return view('admin.Emailtemplates.viewTemplate')->with(['template'=>$templateObj]);
    }
}
