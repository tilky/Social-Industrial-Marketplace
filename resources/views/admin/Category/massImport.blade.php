@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Categories</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> Import Categories
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>Mass Import Categories </div>
            </div>
            <div class="portlet-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered" id="blockui_sample_1_portlet_body">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-plus font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp sbold">Import Category</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                
                                <!-- BEGIN FORM-->
                                <form method="post" action="{{url()}}/category/saveMassImport" class="form-horizontal form-row-seperated" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <label class="control-label">Select file</label>
                                                <span class="required" aria-required="true"> * </span>
                                                <div class="">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="input-group input-large">
                                                            <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                                <span class="fileinput-filename"> </span>
                                                            </div>
                                                            <span class="input-group-addon btn btn-circle default btn-file">
                                                                <span class="fileinput-new"> Select file </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" data-required="1" name="category_csv" required=""> </span>
                                                            <a href="javascript:;" class="input-group btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions right">
                                        <button id="blockui_sample_1_1" type="submit" class="btn btn-circle blue">
                                            <i class="fa fa-check"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script src="{{URL::asset('metronic/pages/scripts/ui-blockui.min.js')}}" type="text/javascript"></script>
<script>

</script>
@endsection
