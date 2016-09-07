@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
            @else
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
            @endif
        </li>
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url()}}/companies">Companies</a>
            <i class="fa fa-circle"></i>  
            @elseif(Auth::user()->access_level == 4)
            <a href="{{url('company/view')}}">Company</a>
            <i class="fa fa-circle"></i>  
            @else
            <a href="{{url()}}/companies/{{$company->id}}">Companies</a>
            <i class="fa fa-circle"></i>  
            @endif
        </li>
        <li>
            <span>Gallery</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> {{$company->name}} - Gallery
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  View Gallery </div>
                <div class="actions">
                    <a href="{{ URL::to('companies/info') }}/{{$company->id}}" class="btn btn-circle btn-success btn-sm">
                    <i class="fa fa-arrow-left"></i>  back </a>
                </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="row">
                    @foreach($company->gallery as $image)
                        <div class="col-md-3" style="text-align: center;">
                            <a data-src="{{url()}}/public/uploads/{{$image->path}}" class="viewImage" data-toggle="modal" href="#imageViewer"><img height="150" width="150" src="{{url()}}/public/uploads/{{$image->path}}"/></a>
                            <div style="text-align: center;padding-top: 10px;">
                                <a href="{{url('companies/gallery/delete')}}/{{$image->id}}" class="btn btn-circle btn btn-danger delete">Remove</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
    /* for show menu active */
    $("#compnay-main-menu").addClass("active");
	$('#compnay-main-menu' ).click();
	$('#conpmay-menu-arrow').addClass('open');
    /* end menu active */
    $(document).on("click", ".viewImage", function () {
        var src = $(this).data('src');
        jQuery('#imageViewer .modal-body #image').attr( "src", src);
    });
</script>
@endsection
