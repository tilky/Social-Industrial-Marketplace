@extends('admin.app')

@section('content')
<style>
.select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url()}}/users">Users</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Edit User</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Edit {{$user->name}}</div>
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
                {!! Form::model($user, [
                'method' => 'PATCH',
                'id' => 'submit-form',
                'route' => ['users.update', $user->id],
                'class' => 'horizontal-form',
                ]) !!}
                <div class="form-body">
                    <input type="hidden" name="account" value="0" />
                        <div class="row">
                            <div class="col-md-12 paddin-npt">
                                <div class="form-group">
            						<div class="col-md-6">
                                        <label class="control-label">First Name</label>
            							<input type="text" class="form-control" name="firstname" value="{{ $userData->first_name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Last Name</label>
            							<input type="text" class="form-control" name="lastname" value="{{ $userData->last_name }}">
                                    </div>
            					</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 paddin-npt">
            					<div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">E-Mail Address</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly="">
                                    </div>
            						<div class="col-md-6">
                                        <label for="inputEmail3" class="control-label">Compnay:</label>
                                        <select id="select2-button-addons-single-input-group-sm" name="company" class="form-control col-md-12 js-data-company-ajax" >
                                            <option selected="" value="{{$userData->company_id}}">{{$userData->companyname}}</option>
                                        </select>
                                    </div>
            					</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 paddin-npt">
            					<div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Email Verified</label>
                                        <select name="email_verify" class="form-control">
                                            <option @if($user->email_verify == 1)selected="selected" @endif value="1">Yes</option>
                                            <option @if($user->email_verify == 0) selected="selected" @endif value="0">No</option>
                                        </select>
                                    </div>
            					</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 paddin-npt">
            					<div class="form-group">
            						<div class="col-md-6">
            							<label class="control-label">Address 1</label>
                                        <input type="text" name="address1" value="{{ $userData->address1 }}" class="form-control" placeholder="Address 1" />
            						</div>
                                    <div class="col-md-6">
            							<label class="control-label">Address 2</label>
                                        <input type="text" name="address2" value="{{ $userData->address2 }}" class="form-control" placeholder="Address 2" />
            						</div>
            					</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 paddin-npt">
                                <div class="form-group">
            						<div class="col-md-6">
            							<label class="control-label">City</label>
                                        <input type="text" name="city" value="{{ $userData->city }}" class="form-control" placeholder="City" />
            						</div>
                                    <div class="col-md-6">
            							<label class="control-label">State</label>
                                        <input type="text" name="state" value="{{ $userData->state }}" class="form-control" placeholder="State" />
            						</div>
            					</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 paddin-npt">
                                <div class="form-group">
            						<div class="col-md-6">
            							<label class="control-label">Pin code</label>
                                        <input type="text" name="zip" value="{{ $userData->zip }}" class="form-control" placeholder="Pin code" />
            						</div>
                                    <div class="col-md-6">
            							<label class="control-label">Country</label>
                                        <input type="text" name="country" value="{{ $userData->country }}" class="form-control" placeholder="Country" />
            						</div>
            					</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 paddin-npt">
                            <div class="form-group">
        						<div class="col-md-6">
        							<label class="control-label">Phone</label>
                                    <input type="text" name="phone" value="{{ $userData->phone }}" class="form-control" placeholder="Phone" />
        						</div>
                                <div class="col-md-6">
        							<label class="control-label">Account Type</label>
                                    <select name="account_type" class="form-control">
                                        @foreach($access_levels as $level)
                                            @if($level->id != 4)
                                            @if($user->access_level == $level->id)
                                                <option value="{{$level->id}}" selected="">{{$level->name}}</option>
                                            @else
                                                <option value="{{$level->id}}">{{$level->name}}</option>
                                            @endif
                                            @endif
                                        @endforeach
                                    </select>
        						</div>
        					</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 paddin-npt">
                            <div class="form-group">
        						<div class="col-md-6">
        							<label class="control-label">About User</label>
                                    <textarea name="about" placeholder="About User" class="form-control">{{ $userData->about }}</textarea>
        						</div>
                                <div class="col-md-6">
        							<label class="control-label">Website Link</label>
                                    <input type="text" name="website_url" value="{{ $userData->website_url }}" class="form-control" placeholder="Website Link" />
        						</div>
        					</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 paddin-npt">
                            <div class="form-group">
        						<div class="col-md-6">
        							<label class="control-label">Facebook Link</label>
                                    <input type="text" name="facebook_url" value="{{ $userData->facebook_url }}" class="form-control" placeholder="Facebook Link" />
        						</div>
                                <div class="col-md-6">
        							<label class="control-label">Instagram Link</label>
                                    <input type="text" name="insta_url" value="{{ $userData->insta_url }}" class="form-control" placeholder="Instagram Link" />
        						</div>
        					</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 paddin-npt">
                            <div class="form-group">
        						<div class="col-md-6">
        							<label class="control-label">Pinterest Link</label>
                                    <input type="text" name="pintress_url" value="{{ $userData->pintress_url }}" class="form-control" placeholder="Pinterest Link" />
        						</div>
                                <div class="col-md-6">
        							<label class="control-label">Youtube Link</label>
                                    <input type="text" name="youtube_url" value="{{ $userData->youtube_url }}" class="form-control" placeholder="Youtube Link" />
        						</div>
        					</div>
                        </div>
                    </div>
                </div>
                <div class="form-actions right">
                    <a href="{{ URL::to('users') }}" class="btn btn-circle btn-sm">
                        Cancel </a>
                    <button type="submit" class="btn btn-circle blue">
                        <i class="fa fa-check"></i> Save</button>
                </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
    /* for show menu active */
    $("#users-main-menu").addClass("active");
	$('#users-main-menu' ).click();
	$('#users-menu-arrow').addClass('open');
	/* end menu active */
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

$(".js-data-company-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/user/compnay/search",
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
@endsection
