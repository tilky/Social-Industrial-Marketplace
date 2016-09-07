@extends('admin.app')

@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url('sa')}}">Home</a>
            <i class="fa fa-circle"></i>  
            @else
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
            @endif
        </li>
        <li>
            <a href="{{url('quotetekverification')}}">Quotetek Verification</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>View</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-server color-black"></i>  {{$user->name}} 
                </div>
                @if(Auth::user()->access_level == 1)
                <div class="actions">
                    
                    @if($verification->status == 0)
                        @if($type == 'user')
                            <a href="{{url('verififcation/approve/user')}}/{{$verification->id}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-thumbs-o-up"></i>  Approve </a>
                            <a href="{{ URL::to('verififcation/disapprove/user') }}/{{$verification->id}}" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i>  Disapprove </a>
                        @else
                        @endif
                    @endif
                </div>
                @endif
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="control-label">General</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4"><p><b>Full Name:</b> {{$verification->full_name}}</p></div>
                                <div class="col-md-4"><p><b>Email:</b> {{$user->email}}</p></div>
                                <div class="col-md-4"><p><b>Account Type:</b> {{$verification->account_type}}</p></div>

                            </div>
                        </div>
                        @if($type == 'user')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4"><p><b>Utility Bill:</b> @if($verification->utility_bill_path != '')<a href="{{url('/')}}/{{$verification->utility_bill_path}}" download>{{ explode('/',$verification->utility_bill_path)[3] }}</a> @endif</p></div>
                                <div class="col-md-4"><p><b>State Id Card:</b> @if($verification->state_id_path != '')<a href="{{url('/')}}/{{$verification->state_id_path}}" download>{{ explode('/',$verification->state_id_path)[3] }}</a> @endif</p></div>
                                <div class="col-md-4"><p><b>LinkedIn:</b>
                                        @if($verification->linkedin_vification == 1)
                                            Verified
                                        @else
                                            Not Verified
                                        @endif
                                </p></div>
                            </div>
                        </div>
                        @endif
                        @if($type == 'company')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4"><p><b>Utility Bill:</b> @if($verification->utility_bill_path != '')<a href="{{url('/')}}/{{$verification->utility_bill_path}}" download>{{ explode('/',$verification->utility_bill_path)[3] }}</a> @endif</p></div>
                                <div class="col-md-4"><p><b>Website:</b> {{$verification->website_url}}</p></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="control-label">References</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="control-label">Reference #1</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4"><p><b>Name:</b> {{$verification->ref_1_name}}</p></div>
                                <div class="col-md-4"><p><b>Email:</b> {{$verification->ref_1_email}}</p></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4"><p><b>Phone:</b> {{$verification->ref_1_phone}}</p></div>
                                <div class="col-md-4"><p><b>Relation:</b> {{$verification->ref_1_relation}}</p></div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="control-label">Reference #2</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4"><p><b>Name:</b> {{$verification->ref_2_name}}</p></div>
                                <div class="col-md-4"><p><b>Email:</b> {{$verification->ref_2_email}}</p></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4"><p><b>Phone:</b> {{$verification->ref_2_phone}}</p></div>
                                <div class="col-md-4"><p><b>Relation:</b> {{$verification->ref_2_relation}}</p></div>
                            </div>
                        </div>
                        
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
/* for show menu active */
$("#verification-main-menu").addClass("active");
$('#verification-main-menu' ).click();
$('#verification-menu-arrow').addClass('open');
$('#quotetekverification-view-menu').addClass('active');
/* end menu active */
$(document).on("click", ".viewImage", function () {
    var src = $(this).data('src');
    jQuery('#imageViewer .modal-body #image').attr( "src",'');
    jQuery('#imageViewer .modal-body #image').attr( "src", src);
});
function showimage(imgsrc)
{
    //alert(imgsrc);
    //document.getElementById('image').src=imgsrc;
    jQuery('#image-full').attr('src',imgsrc);
    jQuery('#main-img-a').data('src',imgsrc);
}
</script>
@endsection
