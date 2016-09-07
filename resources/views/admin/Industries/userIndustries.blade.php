@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Industries</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> View users listed various industries
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  Industries </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th> User Name </th>
                        <th> Industry </th>
                        @if(count($industry['additional_industry') > 0)
                        <th> Additional Industry </th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($finalArray as $industry)
                    <tr class="odd gradeX">
                        <td>{{$industry['user_name']}}</td>
                        <td>{{ $industry['industry_name'] }}</td>
                        @if(count($industry['additional_industry') > 0)
                        @foreach ($industry['additional_industry'] as $industry)
                        <td>{{$industry['additional']}},</td>
                        @endforeach
                        @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
    /* for show menu active */
    $("#industries-main-menu").addClass("active");
    $('#industries-main-menu' ).click();
    $('#industries-menu-arrow').addClass('open');
    $('#industries-list-menu').addClass('active');
    /* end menu active */

</script>
@endsection
