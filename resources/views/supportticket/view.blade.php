@extends('buyer.app')

@section('content')
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
            <a href="{{url()}}/supporttickets">Support Tickets</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>View</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">

<div class="col-md-12 border2x_bottom">

<div class="col-md-9 col-sm-9">

<div class="row">

<h3 class="page-title uppercase"> 

 <i class="fa fa-server color-black"></i> {{$ticket->title}}

</h3>

</div>

</div>

<div class="col-md-3 col-sm-3 text-right">

<div class="row">

 @if($user_access_level == 1)
                <div class="actions margin-top-10">
                    <div class="btn-group">
                        <input name="status" id="ticket-status" onchange="TicketStatus(id)" type="checkbox" @if($ticket->status == 0) checked @endif class="make-switch form-control" data-size="small" data-on-text="Open" data-off-text="Closed" >
                    </div>
                </div>
                @endif

</div>

</div>

</div>

</div>
<div class="row">
<div class="col-md-12">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
       
            <div class="portlet-body form">
            <div class="inbox margin-top-15">
            <div class="inbox-body">
            <div class="inbox-content">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <form method="post" action="{{url()}}/supporttickets/comment/save/{{$ticket->id}}" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input id="ticket_id" type="hidden" name="ticket_id" value="{{$ticket->id}}" />
                    <input type="hidden" name="user_id" value="{{$userData->user_id}}" />
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="margin-top-15 margin-bottom-15">{{$ticket->title}}</h1>
                                <p class="margin-top-15 margin-bottom-15">{{$ticket->description}}</p>
                            </div>
                            <div class="col-md-12">
                            
                                @if(count($comments) > 0)
                                    @foreach($comments as $comment)
                                        <div class="media">
                                            <a class="pull-left" href="{{url('home/user/profile')}}/{{$comment->user->id}}" target="_blank">
                                            @if($comment->user->userdetail->profile_picture != '')
                                                <img src="{{url('')}}/{{$comment->user->userdetail->profile_picture}}" alt="{!! $comment->user->name !!}" width="80px" class="img-circle">
                                            @else
                                                <img src="{{url('images/default-user.png')}}" alt="{!! $comment->user->name !!}" class="img-circle" width="80px">
                                            @endif
                                            </a>
                                            <div class="media-body">
                                                <div class="row" >
                                                    <div class="col-md-12">
                                                        <h5 class="media-heading">{{$comment->user->userdetail->first_name}} {{$comment->user->userdetail->last_name}} say:</h5>
                                                        <p>{{$comment->comment}}</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <p>No comment Avilable</p>
                                @endif
                            
                            </div>
                        </div>
                        @if($ticket->status == 0)
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="col-sm-12">
                                <h2>Comment</h2>
                                <div class="form-group">
                                    
                                    <textarea name="comment" class="inbox-editor inbox-wysihtml5 form-control" rows="12" placeholder="Add New Comment" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if($ticket->status == 0)
                    <div class="form-actions right">
                        <div class="row">
                            
                                <button type="submit" class="btn btn-circle yellow-crusta bold">
                                    <i class="fa fa-check"></i> Post</button>
                            
                        </div>
                    </div>
                    @endif
                </form>
            </div>
            </div>
            </div>
            </div>
        
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
</div>
</div>
<script>
/* for show menu active */
$("#support-tickets-main-menu").addClass("active");
$('#support-tickets-main-menu' ).click();
$('#support-tickets-menu-arrow').addClass('open')
$('#manage-ticket-menu').addClass('active');
/* end menu active */
function TicketStatus(id)
{
    var baseUrl = '{{url()}}';
    var status = $('#'+id).bootstrapSwitch('state');
    if(status == true)
    {
        var st_val = 0;
    }
    else{
        var st_val = 1;
    }
    var ticket_id = $('#ticket_id').val();
    //console.log(baseUrl+'/supporttickets/ticket/status/'+ticket_id+'/'+st_val);
    
    window.location.href = baseUrl+'/supporttickets/ticket/status/'+ticket_id+'/'+st_val;
}
</script>
<script>
    /* for show menu active */
    $("#messenger-main-menu").addClass("active");
	$('#messenger-main-menu' ).click();
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
function AddNewAttachment(id){
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    var baseurl = "{{url('message/atachment')}}"+'/'+divId;
    console.log(baseurl);
    
    jQuery.ajax({
        url: baseurl,
        type: 'get',
        success: function(data) {
                    var element = document.getElementById("fileattachments");
                    $( "#fileattachments" ).append(data.html);
                    var newId = 'attachment_'+data.next_id;
                    $('#'+id).attr("id",newId);
                    App.unblockUI('#blockui_sample_1_portlet_body');
                 },
        done: function() {
            //console.log('error');
        },
        error: function() {
            //console.log('error');
        }
        
    });    
}
</script>
<script>
function formatRepo(repo) {
    if (repo.loading) return repo.text;

    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.full_name +"</div>";
    
    markup += "</div></div>";

    return markup;
}

function formatRepoSelection(repo) {
    return repo.full_name || repo.text;
}

$(".js-data-example-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/conatct/usersearch",
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function(data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
                results: data.items
            };
        },
        cache: true
    },
    escapeMarkup: function(markup) {
        return markup;
    }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});
$(".select2, .select2-multiple, .select2-allow-clear, .js-data-example-ajax").on("select2:open", function() {
            if ($(this).parents("[class*='has-']").length) {
                var classNames = $(this).parents("[class*='has-']")[0].className.split(/\s+/);

                for (var i = 0; i < classNames.length; ++i) {
                    if (classNames[i].match("has-")) {
                        $("body > .select2-container").addClass(classNames[i]);
                    }
                }
            }
        });

        $(".js-btn-set-scaling-classes").on("click", function() {
            $("#select2-multiple-input-sm, #select2-single-input-sm").next(".select2-container--bootstrap").addClass("input-sm");
            $("#select2-multiple-input-lg, #select2-single-input-lg").next(".select2-container--bootstrap").addClass("input-lg");
            $(this).removeClass("btn-primary btn-outline").prop("disabled", true);
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
