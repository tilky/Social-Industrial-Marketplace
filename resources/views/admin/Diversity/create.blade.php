@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="#">Settings</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Diversity</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>  Add Diversity </div>
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
                'route' => 'diversity.store',
                'class' => 'horizontal-form'
                ]) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <span class="required" aria-required="true"> * </span>
                                    <input data-required="1" type="text" name="name" class="form-control" placeholder="Name of diversity">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Active</label><br/>
                                    <input name="is_active" value="1" type="checkbox" checked class="make-switch form-control" data-size="small">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a href="{{ URL::to('diversity') }}" class="btn btn-circle btn-sm">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle blue">
                            <i class="fa fa-check"></i>  Save</button>
                    </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
/* for show menu active */
$("#settings-main-menu").addClass("active");
$('#settings-main-menu' ).click();
$('#settingsMenu-arrow').addClass('open');
$('#diversity-list-view-menu').addClass('active');
/* end menu active */
</script>
@endsection
