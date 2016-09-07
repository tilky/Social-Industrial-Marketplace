@extends('buyer.app')

@section('content')

<!-- Model to get alert for review -->
<div class="modal fade" id="review" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Success</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" id="rejectReview" class="btn blue">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-star"></i>
        </li>
        <li>
            <span>Reviews Received</span>
        </li>
    </ul>
</div>



<div class="col-md-12 main_box">
    <div class="row">

        <div class="col-md-12 border2x_bottom">
            <h3 class="page-title uppercase"><i class="fa fa-star color-black"></i>Review Center</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs">
                        <li class="active">
                           <a class="color-black" href="#tab_1_1" data-toggle="tab"><h5 class="bold uppercase"> Received Reviews </h5></a>
                        </li>
                        <li>
                            <a class="color-black" href="#tab_1_2" data-toggle="tab"><h5 class="bold uppercase"> Reviewed Users </h5></a>
                        </li>
                        <li>
                            <a class="color-black" href="#tab_1_3" data-toggle="tab"><h5 class="bold uppercase"> Pending Reviews </h5></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    
                        <div class="tab-pane fade active in" id="tab_1_1">
                        <div class="mt-comments col-md-12 col-sm-12 center-block margin-bottom-20 float_none">
                            @if (Session::has('message'))
                            <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                            @endif
                            
                            @if(count($reviews) > 0)
                                @foreach($reviews as $review)
                                <div class="mt-comments col-md-12 col-sm-12 center-block no_filter">
                                <p class="text-right res_found">&nbsp;</p>
                                <div class="mt-comment result">
                                    @if($review->sender->access_level == 4)
                                    <div class="mt-comment-img">
                                    <a class="pull-left" href="{{url('company/profile')}}/{{$review->sender->companydetail->id}}" target="_blank">
                                        @if($review->sender_avatar != '')
                                        <img src="{{url('')}}/{{$review->sender_avatar}}" alt="sell" class="img-circle" width="50px">
                                        @else
                                        <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
                                        @endif
                                    </a>
                                    </div>
                                    
                                    <div class="mt-comment-body">
                                        <div class="mt-comment-info">
                                            <div class="pull-left">
                                                <a href="{{url('company/profile')}}/{{$review->sender->companydetail->id}}" target="_blank"><h3 class="media-heading">{{$review->sendername}}</h3></a>
                                                <h5>{{$review->title}}</h5>
                                                <p>{{$review->comment}}</p>
                                            </div>
                                             <div class="pull-right">
                                              <p>  @for ($i=1; $i <= 5 ; $i++)
                                                  <span class=" stars glyphicon glyphicon-star{{ ($i <= $review->stars) ? '' : '-empty'}}"></span>
                                                @endfor
                                                </p>
                                                <div class="actions pull-right margin-top-10">
                                                    <div class="btn-group"> 
                                                        <a class="btn btn-circle  btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="{{url('/review-user/profile')}}/{{$review->sender_id}}">View Profile</a>
                                                            </li>
                                                            <li class="divider"> </li>
                                                            <li>
                                                                <a href="{{url('/review-user/profile')}}/{{$review->sender_id}}">View Profile</a>
                                                            </li>
                                                            <li class="divider"> </li>
                                                            <li>
                                                            <a href="{{url('messages/create')}}?buyer={{$review->sender_id}}">Message</a>
                                                            </li>
                                                             @if($review->endorse == 0)
                                                            <li>
                                                            <a href="{{url('endorse-user')}}/{{$review->receiver_id}}/{{$review->sender_id}}">Endorse</a>
                                                            </li>
                                                            @endif
                                                            <li>
                                                            <a href="">Showcase</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                </div>
                                               
                                            <!--<div class="text-muted col-md-4 align-right paddin-npt"><small>Review received {!! $review->created_at->diffForHumans() !!}</small></div>-->
                                        </div>
                                        
                                    </div>
                                    </div>
                                    </div>
                                    @else
                                    <div class="mt-comments col-md-12 col-sm-12 center-block no_filter">
                                    <p class="text-right res_found">&nbsp;</p>
                                <div class="mt-comment result">
                                <div class="mt-comment-img">
                                    <a class="pull-left" href="{{url('home/user/profile')}}/{{$review->sender_id}}" target="_blank">
                                        @if($review->sender_avatar != '')
                                        <img src="{{url('')}}/{{$review->sender_avatar}}" alt="sell" class="img-circle" width="50px">
                                        @else
                                        <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
                                        @endif
                                    </a>
                                    </div>
                                    <div class="mt-comment-body">
                                        <div class="mt-comment-info">
                                            <div class="pull-left">
                                                <a href="{{url('home/user/profile')}}/{{$review->sender_id}}" target="_blank"><h3 class="media-heading">{{$review->sendername}}</h3></a>
                                                @if($review->companyname != '')<span>Position at {{$review->companyname}}</span>@endif
                                                <h5>{{$review->title}}</h5>
                                                <p>{{$review->comment}}</p>
                                            </div>
                                            <div class="pull-right">
                                              <p>  @for ($i=1; $i <= 5 ; $i++)
                                                  <span class=" stars glyphicon glyphicon-star{{ ($i <= $review->stars) ? '' : '-empty'}}"></span>
                                                @endfor
                                                </p>
                                                <div class="actions pull-right margin-top-10">
                                                    <div class="btn-group"> 
                                                        <a class="btn btn-circle  btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="{{url('/review-user/profile')}}/{{$review->sender_id}}">View Profile</a>
                                                            </li>
                                                            <li class="divider"> </li>
                                                            <li>
                                                                <a href="{{url('messages/create')}}?buyer={{$review->sender_id}}">Message</a>
                                                            </li>
                                                            
                                                            <li class="divider"> </li>
                                                             @if($review->endorse == 0)
                                                            <li>
                                                            <a href="{{url('endorse-user')}}/{{$review->receiver_id}}/{{$review->sender_id}}">Endorse</a>
                                                            </li>
                                                            <li class="divider"> </li>
                                                            @endif
                                                            @if($review->connect == 0)
                                                            <li>
                                                            <a href="{{url('contactusers/create')}}?search={{str_replace(' ','+',$review->sendername)}}">Connect</a>
                                                            </li>
                                                             @endif
                                                             <li>
                                                            <a href="" >Showcase</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                </div>
                                            <!--<div class="text-muted col-md-4 align-right paddin-npt"><small>Review received {!! $review->created_at->diffForHumans() !!}</small></div>-->
                                        </div>
                                        
                                    </div>
                                    </div>
                                    </div>
                                    @endif
                                
                                @endforeach
                            @else
                                <p class="text-center res_found">No Review available</p>
                            @endif
                           
                            <ul class="pager">
                                @if($previousPageUrl != '')
                                    <li class="previous">
                                        <a href="{{$previousPageUrl}}"> <i class="fa fa-arrow-left"></i> Prev </a>
                                    </li>
                                @endif
                                @if($nextPageUrl != '')
                                    <li class="next">
                                        <a href="{{$nextPageUrl}}"> Next <i class="fa fa-arrow-right"></i> </a>
                                    </li>
                                @endif
                            </ul>
                            <div class="clearfix"></div>
                         </div>
                         <div class="clearfix"></div>
                         </div>
                         <div class="clearfix"></div>
                       </div>
                       <div class="clearfix"></div>
                         </div>

                        <div class="tab-pane fade" id="tab_1_2">
                        <div class="mt-comments col-md-12 col-sm-12 center-block margin-bottom-20 float_none">
                        <p class="text-center res_found">No Review available</p>
                        </div>
                        <div class="clearfix"></div>
                        </div>

                        <div class="tab-pane fade" id="tab_1_3">
                           <div class="mt-comments col-md-12 col-sm-12 center-block margin-bottom-20 float_none">
                                @if(count($reviewApproval) > 0)
                                @foreach($reviewApproval as $approval)
                                <div class="mt-comments col-md-12 col-sm-12 center-block no_filter">
                                <p class="text-right res_found">&nbsp;</p>
                                <div class="mt-comment result">
                                <div class="mt-comment-img">
                                    <a class="pull-left" href="{{url('home/user/profile')}}/{{$approval->sender_id}}" target="_blank">
                                        @if($approval->sender_avatar != '')
                                        <img src="{{url('')}}/{{$approval->sender_avatar}}" alt="sell" class="img-circle" width="50px">
                                        @else
                                        <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
                                        @endif
                                    </a>
                                    </div>
                                    <div class="mt-comment-body">
                                        <div class="mt-comment-info">
                                            <div class="pull-left">
                                                <a href="{{url('home/user/profile')}}/{{$approval->sender_id}}" target="_blank"><h3 class="media-heading">{{$approval->sendername}}</h3></a>
                                                @if($approval->companyname != '')<span>Position at {{$approval->companyname}}</span>@endif
                                                <h5>{{$approval->title}}</h5>
                                                <p>{{$approval->comment}}</p>
                                            </div>
                                        
                                        
                                            <div class="pull-right">
                                                <p>
                                                    @for ($i=1; $i <= 5 ; $i++)
                                                    <span class="stars glyphicon glyphicon-star{{ ($i <= $approval->stars) ? '' : '-empty'}}"></span>
                                                    @endfor
                                                </p>
                                            </div>
                                            <div class="actions pull-right margin-top-10">
                                                    <div class="btn-group"> 
                                                        <a class="btn btn-circle  btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="#" id="approve_{{$approval->id}}">Approve</a>
                                                            </li>
                                                            <li class="divider"> </li>
                                                            <li>
                                                                <a href="#" id="reject_{{$approval->id}}">Reject</a>
                                                            </li>
                                                            
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            
</div>
                                </div>
                                @endforeach
                                @else
                               <p class="text-center res_found">No Review available</p>
                                @endif
                            </div>
                            <ul class="pager">
                                @if($previousPage != '')
                                <li class="previous">
                                    <a href="{{$previousPage}}"> <i class="fa fa-arrow-left"></i> Prev </a>
                                </li>
                                @endif
                                @if($nextPage != '')
                                <li class="next">
                                    <a href="{{$nextPage}}"> Next <i class="fa fa-arrow-right"></i> </a>
                                </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</div>
<div class="clearfix"></div>
</div>
<script>
    /* for show menu active */
    $("#review-main-menu").addClass("active");
	$('#review-main-menu' ).click();
    $('#review-menu-arrow').addClass('open');
	$('#review-receive-menu').addClass('active');
    /* end menu active */

    $(".btn-approve").on('click',function(){
        var dataId=$(this).attr('id').split('_')[1];
        console.log(dataId);

        var baseurl = "{{url('review/approve')}}"+'/'+dataId;
        jQuery.ajax({
            url: baseurl,
            type: 'post',
            data:{
                '_token':'{{csrf_token()}}'
            },
            success: function(data) {
                window.location.href = "{{url('review')}}";
            },
            done: function() {
                //console.log('error');
            },
            error: function() {
                //console.log('error');
            }

        });

    });

    $(".btn-reject").on('click',function(){
        var dataId=$(this).attr('id').split('_')[1];
        console.log(dataId);
        $('#review').modal('show');
        $('#review').find('.modal-body').html('Are you sure you want to Reject and Delete This review ?');
        $("#rejectReview").on("click", function(){
            var baseurl = "{{url('review/reject')}}"+'/'+dataId;
            jQuery.ajax({
                url: baseurl,
                type: 'post',
                data:{
                    '_token':'{{csrf_token()}}'
                },
                success: function(data) {
                    $('#review').modal('hide');
                    window.location.href = "{{url('review')}}";
                },
                done: function() {
                    //console.log('error');
                },
                error: function() {
                    //console.log('error');
                }

            });
        });

    });

</script>
<script src="{{URL::asset('js/starrr.js')}}" type="text/javascript"></script>
@endsection
