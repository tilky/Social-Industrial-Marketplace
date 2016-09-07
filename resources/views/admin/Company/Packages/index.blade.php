@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url()}}/companies">Companies</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Packages</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> Manage Company Accounts
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  View Current Accounts</div>

            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th> Name </th>
                        <th> Package </th>
                        <th> Subscription Period </th>
                        <th> Start Date </th>
                        <th> End Date </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($companies as $company)
                    @if($company)
                    <tr class="odd gradeX">
                        <td>{{ $company->name }}</td>
                        <td>
                            @if($company->package) {{ $company->package->name }} @endif
                        </td>
                        <td>
                            {{ $company->subscription_type }}
                        </td>
                        <td>
                            {{ $company->subscription_start_date }}
                        </td>
                        <td>
                            {{ $company->subscription_end_date }}
                        </td>
                        <td>


                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-circle btn-success btn-sm">
                                <i class="fa fa-edit"></i>  Change </a>

                        </td>
                    </tr>
                    @endif
                    @endforeach
                    </tbody>
                </table>
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> ← Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next → </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
</script>
@endsection
