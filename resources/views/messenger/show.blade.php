@extends('buyer.app')



@section('content')

<link href="{{URL::asset('metronic/apps/css/inbox.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/plugins/jquery-file-upload/css/jquery.fileupload.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')}}" rel="stylesheet" type="text/css" />

<div class="page-bar">

    <ul class="page-breadcrumb">

        <li>

            <a href="{{url()}}/user-dashboard">Home</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            <a href="{{url()}}/messages">Message Inbox</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            <span>Add New Message</span>

        </li>

    </ul>

</div>



<div class="col-md-12 main_box">

<div class="row">

<div class="col-md-12 border2x_bottom">

<h3 class="page-title uppercase"> Send Message </h3>

</div>

</div>

<div class="row">

    <div class="col-md-12">

         <div class="col-md-12 padding-top paddin-bottom">

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

            <!-- BEGIN PAGE BASE CONTENT -->

            <div class="inbox">

                <div class="row">

                    <div class="col-md-2">

                        <div class="inbox-sidebar">

                            <a href="{{ URL::to('messages/create') }}" data-title="Compose" class="btn btn-danger compose-btn btn-circle btn-block">

                                <i class="fa fa-edit"></i> Compose </a>

                            <ul class="inbox-nav">

                                <li class="active">

                                    <a href="{{url('messages')}}" data-type="inbox" data-title="Inbox"> Inbox

                                        <span class="badge badge-success">{{Auth::user()->newMessagesCount()}}</span>

                                    </a>

                                </li>

                                <li>

                                    <a href="{{url('message/sent')}}" data-type="sent" data-title="Sent"> Sent </a>

                                </li>

                            </ul>

                        </div>

                    </div>

                    <div class="col-md-10">

                        <div class="inbox-body">

                            <div class="inbox-content">

                                

                                <h1>{!! $thread->subject !!}</h1>

            

                                @foreach($thread->messages as $message)

                                    <div class="media">

                                        @if($message->user->access_level == 4)
                                            <a class="pull-left" href="#">
                                            @if($message->user->companydetail->log != '')
                                                <img src="{{url('')}}/{{$message->user->companydetail->log}}" alt="{!! $message->user->name !!}" width="80px" class="img-circle">
                                            @else
                                                <img src="{{url('images/default-user.png')}}" alt="{!! $message->user->name !!}" class="img-circle" width="80px">
                                            @endif
                                            </a>
                                        @else
                                            <a class="pull-left" href="{{url('home/user/profile')}}/{{$message->user->id}}" target="_blank">
                                            @if($message->user->userdetail->profile_picture != '')
                                                <img src="{{url('')}}/{{$message->user->userdetail->profile_picture}}" alt="{!! $message->user->name !!}" width="80px" class="img-circle">
                                            @else
                                                <img src="{{url('images/default-user.png')}}" alt="{!! $message->user->name !!}" class="img-circle" width="80px">
                                            @endif
                                            </a>
                                        @endif

                                        

                                        <div class="media-body">

                                            <h5 class="media-heading">{!! $message->user->name !!}</h5>

                                            <p>{!! $message->body !!}</p>

                                            <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>

                                        </div>

                                    </div>

                                @endforeach

                                

                                @if(count($thread->getAttachments) > 0)

                                <div class="col-md-12">

                                    <h3>Attachments</h3>

                                    @foreach($thread->getAttachments as $index=>$attachment)

                                    <p><a href="{{url('')}}/{{$attachment->attachment_path}}" download>Download File {{$index+1}}</a></p>

                                    @endforeach

                                </div>

                                @endif

                                <div style="clear: both;"></div>              

                                <!-- BEGIN FORM-->

                                {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}

                                <div class="form-body">

                                    <h2>Add a new message</h2>

                                    <div class="row">

                                        <div class="col-md-12">

                                            <!-- Subject Form Input -->

                                            <div class="form-group">

                                                <textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12"></textarea>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-actions right">

                                        <a href="{{ URL::to('marketplaceproducts') }}" class="btn btn-danger bold btn-sm">

                                            Cancel </a>

                                        <button type="submit" class="btn btn-circle yellow-crusta color-black bold">

                                            <i class="fa fa-check"></i> Send</button>

                                    </div>

                                

                                {!! Form::close() !!}

                                <!-- END FORM-->

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- END PAGE BASE CONTENT -->

        </div>   

        

    </div>

</div>

</div>



<script>

    /* for show menu active */

    $("#contact-list-main-menu").addClass("active");

	$('#contact-list-main-menu' ).click();
    $('#contact-list-menu-arrow').addClass('open')
    $('#message-list-view-menu').addClass('active');
    /* end menu active */

    

    $( document ).ready(function() {

        $('#free_shipping_continents').multiSelect();

        $('#product_color').multiSelect();

        $('#product_usage').multiSelect();

        $('.inbox-wysihtml5').wysihtml5({

          toolbar: {

            

          }

        });

    });

</script>

<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.pack.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/vendor/tmpl.min.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/vendor/load-image.min.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.iframe-transport.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-process.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-image.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-audio.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-video.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-validate.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-ui.js')}}" type="text/javascript"></script>

@endsection

