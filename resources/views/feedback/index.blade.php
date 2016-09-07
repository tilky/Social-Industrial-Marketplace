@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Feedbacks Received</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-server color-black"></i>Manage Received Feedbacks </div>
                @if(Auth::user()->access_level == 1)
                <div class="actions">
                    <a href="{{ URL::to('feedback/create') }}" class="btn btn-circle btn-sm">
                        <i class="fa fa-plus"></i> Add </a>
                </div>
                @endif
            </div>
            <div class="portlet-body">
            
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        @if(count($feedbacks) > 0)
                            @if(Auth::user()->access_level == 1)
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Sender Name </th>
                                    <th> Receiver Name </th>
                                    <th> Comment </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($feedbacks as $feedback)
                                <tr class="odd gradeX">
                                    <td>{{$feedback->sendername}}</td>
                                    <td>{{$feedback->receivername}}</td>
                                    <td>{{$feedback->comment}}</td>
                                    <td>{{ $feedback->status }}</td>
                                    <td>
                                        <a href="#" class="btn btn-circle btn-success btn-sm">
                                            <i class="fa fa-edit"></i> Edit </a>
                                        <a id="deleteButton" data-id="{{$feedback->id}}" data-toggle="modal" href="#deleteConfirmation" class="btn btn-circle btn-danger btn-sm">

                                            {!! Form::open([
                                            'method' => 'DELETE',
                                            'id' => 'DELETE_FORM_'.$feedback->id,
                                            ]) !!}
                                            {!! Form::close() !!}
                                            <i class="fa fa-remove"></i> Delete </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                @foreach($feedbacks as $feedback)
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
                                    </a>
                                    <div class="media-body">
                                        <div class="col-md-12 paddin-npt">
                                            <div class="col-md-8 paddin-npt">
                                                <h3 class="media-heading">{{$feedback->sendername}}</h3>
                                                @if($feedback->companyname != '')<span>Position at {{$feedback->companyname}}</span>@endif
                                                <p>{{$feedback->comment}}</p>
                                            </div>
                                            <div class="text-muted col-md-4 align-right paddin-npt"><small>Feedback received {!! $feedback->created_at->diffForHumans() !!}</small></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        @else
                        <p>No Feedback available</p>
                        @endif
                    </div>
                </div>
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> ? Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next ? </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

@endsection
