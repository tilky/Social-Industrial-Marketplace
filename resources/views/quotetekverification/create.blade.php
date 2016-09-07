@extends('buyer.app')

@section('content')
<style>
.select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('quotetekverification')}}">Quotetek Verification</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Quotetek user Verification</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-plus color-black"></i>Add Quotetek user Verification</div>
            </div>

            <div class="portlet-body form">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- BEGIN FORM-->
                {!! Form::open([
                'route' => 'quotetekverification.store',
                'class' => 'horizontal-form',
                'files' => true,
                ]) !!}
                    <input type="hidden" name="user_id" class="form-control" value="{{$userData->user_id}}" >
                    <input type="hidden" name="is_active" value="0" />
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="control-label">General</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Apply As</label>
                                    <select name="apply" class="form-control" placeholder="Product Condition">
                                        <option value="I'm applying as a sole user" @if(Request::old('apply') == "I'm applying as a sole user") selected="selected" @endif>I'm applying as a sole user</option>
                                        <option value="I'm applying as a working professional independent of a company" @if(Request::old('apply') == "I'm applying as a working professional independent of a company") selected="selected" @endif>I'm applying as a working professional independent of a company</option>
                                        <option value="I'm applying as a working professional associated with a company" @if(Request::old('apply') == "I'm applying as a working professional associated with a company") selected="selected" @endif>I'm applying as a working professional associated with a company</option>
                                        <option value="I'm applying as a company general user account" @if(Request::old('apply') == "I'm applying as a company general user account") selected="selected" @endif>I'm applying as a company general user account</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">LinkedIn Profile Link</label>
                                    <input type="text" name="linkedin_link" class="form-control" value="{{Request::old('linkedin_link')}}" placeholder="LinkedIn Profile Link">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Facebook Profile Link</label>
                                    <input type="text" name="facebook_link" class="form-control" value="{{Request::old('facebook_link')}}" placeholder="Facebook Profile Link">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Driver's License No</label>
                                    <input type="text" name="driving_license" class="form-control" value="{{Request::old('driving_license')}}" placeholder="Driver's License No">
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-top: 30px;text-align: center;">
                                OR
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">State Id card</label>
                                    <input type="text" name="state_id_card" class="form-control" value="{{Request::old('state_id_card')}}" placeholder="State Id card">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="control-label">Upload Proofs:</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="blockui_sample_1_portlet_body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Proofs</label>
                                    <div id="proofs-add">
                                        <div id="proof-file-1" class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn btn-circle default btn-file">
                                                    <span class="fileinput-new"> Select file </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" data-required="1" name="proofs[]" > </span>
                                                <a href="javascript:;" class="input-group btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div>
                                        <a href="#" id="addmore_2" onclick="addMoreOption(id);return false"><i class="fa fa-plus-circle"></i>Add More Proof</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="control-label">References:</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="control-label">Reference #1</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="ref_1_name" class="form-control" value="{{Request::old('ref_1_name')}}" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Phone</label>
                                    <input type="text" name="ref_1_phone" class="form-control" value="{{Request::old('ref_1_phone')}}" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" name="ref_1_email" class="form-control" value="{{Request::old('ref_1_email')}}" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Relation</label>
                                    <input type="text" name="ref_1_relation" class="form-control" value="{{Request::old('ref_1_relation')}}" placeholder="Relation">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="ref_1_description" placeholder="Description" class="form-control">{{Request::old('ref_1_description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="control-label">Reference #2</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="ref_2_name" class="form-control" value="{{Request::old('ref_2_name')}}" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Phone</label>
                                    <input type="text" name="ref_2_phone" class="form-control" value="{{Request::old('ref_2_phone')}}" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" name="ref_2_email" class="form-control" value="{{Request::old('ref_2_email')}}" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Relation</label>
                                    <input type="text" name="ref_2_relation" class="form-control" value="{{Request::old('ref_2_relation')}}" placeholder="Relation">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="ref_2_description" placeholder="Description" class="form-control">{{Request::old('ref_2_description')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a href="{{ URL::to('quotetekverififcation') }}" class="btn btn-circle btn-sm">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle blue">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                {!! Form::close() !!}
                <!-- END FORM-->
                
            </div>
        </div>
    </div>
</div>
<script>
/* for show menu active */
$("#verification-main-menu").addClass("active");
$('#verification-main-menu' ).click();
$('#verification-menu-arrow').addClass('open');
$('#quotetek-user-verification-menu').addClass('active');
/* end menu active */
    
 function addMoreOption(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    var baseurl = "{{url('verify/proof/add')}}"+'/'+divId;
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    
    jQuery.ajax({
        url: baseurl,
        type: 'get',
        success: function(data) {
                    var element = document.getElementById("proofs-add");
                    $( "#proofs-add" ).append(data.html);
                    var newId = 'addmore_'+data.next_id;
                    $('#'+id).attr("id",newId);
                    App.unblockUI('#blockui_sample_1_portlet_body');
                 },
        done: function() {
            //console.log('error');
            App.unblockUI('#blockui_sample_1_portlet_body');
        },
        error: function() {
            //console.log('error');
            App.unblockUI('#blockui_sample_1_portlet_body');
        }
        
    }); 
}
function removeMainOption(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    $('#proof-file-'+divId).html('');
    $('#proof-file-'+divId).hide();
}   
</script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
