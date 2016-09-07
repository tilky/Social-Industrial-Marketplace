@extends('home.header')

@section('content')

<link href="{{URL::asset('css/style_custom.css')}}" rel="stylesheet">
<!-- Custome Style -->
    
    

    <link href="{{URL::asset('metronic/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    
    <script src="{{URL::asset('metronic/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery-multi-select/js/jquery.multi-select.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>

    
<style>
.select2-container{display: block!important;}
.about-header{height: 100%!important;float: left!important;}

</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="section fade">
    <div class="container animatedParent">

             <!--   <ul class="top_c">
                 <li class="active_old"><a href="#"><i class="fa fa-check"></i></a></li>
                 <li class="active"><a href="#">2</a></li>
                 <li><a href="#">3</a></li>
               </ul> -->
              


        <div class="text-center"> 
            <h3 class="header_middle f32">
                Congratulations, your Buy Request has been posted set an Account password and Company information to create a free profile
            </h3>
        </div>
        @if(!empty($quotedata))
        <div class="sect_rq2">
            <div class="row"> 
                <div class="col-sm-4">
                    <p>Name </p> 
                </div>
                <div class="col-sm-4  text-center hidemidlle">
                    <p>:</p> 
                </div>
                <div class="col-sm-4">
                    <p><b>{{$quotedata['firstname']}} {{$quotedata['lastname']}}</b> </p> 
                </div>
            </div><!-- row -->
            <div class="row"> 
                <div class="col-sm-4">
                    <p>E-mail id  </p> 
                </div>
                <div class="col-sm-4  text-center hidemidlle">
                    <p>:</p> 
                </div>
                <div class="col-sm-4">
                    <p><b>{{$quotedata['email']}}</b> </p> 
                </div>
            </div><!-- row -->
            <div class="row">  
                <div class="col-sm-4">
                    <p>Selected Industry </p> 
                </div>
                <div class="col-sm-4  text-center hidemidlle">
                    <p>:</p> 
                </div>
                <div class="col-sm-4">
                    <p><b>{{$quotedata['industry_name']}}</b> </p> 
                </div>
            </div><!-- row -->
            <div class="row">    
                <div class="col-sm-4">
                    <p>Selected Product</p> 
                </div>
                <div class="col-sm-4  text-center hidemidlle">
                    <p>:</p> 
                </div>
                <div class="col-sm-4">
                    <p><b>{{$quotedata['product_name']}}</b> </p> 
                </div>
            </div><!-- row -->
            <div class="row">    
                <div class="col-sm-4">
                    <p>Selected Category</p> 
                </div>
                <div class="col-sm-4  text-center hidemidlle">
                    <p>:</p> 
                </div>
                <div class="col-sm-4">
                    <p><b>{{$quotedata['category_name']}}</b> </p> 
                </div>
            </div><!-- row -->  
        </div><!-- sect_rq2 -->        
         @endif  
             
 
        <div class="h100"></div>

        <div class="stp_3_rqs">
          
          <div class="text-center">    
            <h4 class="stp3_h4">Login Information</h4>
          </div>
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        <div class="col-sm-6">
        <button class="green_btn btn-circle my_clck">Join an Existing profile</button>
        
        </div>
        
        
        <div class="col-sm-6">
            <button class="green_btn btn-circle register active">Create Your Own Profile</button>
        </div>
         
        </div><!-- stp -->
        <div class="h50"></div>
        <div class="stp3_opne">
            <div class="Forms-inputs">
                <form class="horizontal-form" action="{{url()}}/auth/login" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="select-panel">
                    <div class="form-group">
                        <label for="Email" class="sr-only">Email </label>
                        <input type="email" class="form-control" id="Email" name="email" value=" @if(!empty($quotedata)) {{$quotedata['email']}} @endif" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="Password" class="sr-only">Password </label>
                        <input type="password" class="form-control" id="Password" name="password" placeholder="Password" >
                    </div>
                    <label><a href="javascript:;" data-toggle="modal" data-target="#forgot-password-Modal">Forgot Password?</a></label>
                    <h6 style=" text-align: right;"> <a href="http://www.quotetek.com/terms.php" target="_blank">By clicking on Login, you Agree to the Terms and Conditions.</a></h6>

                    <div class="buttons">
                        
                        
                    </div>
                    <div class="text-center ">
                        <a href="{{url('homepage/quote')}}" class="prev-button btn btn-circle btn-danger" type="reset">Back to Step 2</a>
                        <button class="next-button btn" type="submit">Login</button>
                    </div>
                </div>
                </form>
            </div>
            
        </div><!-- stp3_opne -->
        
        <div class="stp3_register" style="display: block;">
            <div class="Forms-inputs">
                <form class="form-horizontal" role="form" method="POST" action="{{url()}}/auth/register">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<div class="col-md-6">
                            <label class="control-label">First Name</label>
							<input type="text" class="form-control" name="firstname" value="{{ old('name') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Last Name</label>
							<input type="text" class="form-control" name="lastname" value="{{ old('name') }}">
                        </div>
					</div>
					<div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">E-Mail Address</label>
                            <input type="email" class="form-control" name="email" value="@if(!empty($quotedata)) {{$quotedata['email']}} @endif">
                        </div>
						<div class="col-md-6">
                            <label for="inputEmail3" class="control-label">Compnay:</label>
                            <select id="select2-button-addons-single-input-group-sm" name="company" class="form-control col-md-12 js-data-products-ajax" ></select>
                        </div>
					</div>
					<div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
						<div class="col-md-6">
                            <label class="control-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<label class="control-label">Address 1</label>
                            <input type="text" name="address1" class="form-control" placeholder="Address 1" />
						</div>
                        <div class="col-md-6">
							<label class="control-label">Address 2</label>
                            <input type="text" name="address2" class="form-control" placeholder="Address 2" />
						</div>
					</div>
                    <div class="form-group">
						<div class="col-md-6">
							<label class="control-label">City</label>
                            <input type="text" name="city" class="form-control" placeholder="City" />
						</div>
                        <div class="col-md-6">
							<label class="control-label">State</label>
                            <input type="text" name="state" class="form-control" placeholder="State" />
						</div>
					</div>
                    <div class="form-group">
						<div class="col-md-6">
							<label class="control-label">Pin code</label>
                            <input type="text" name="zip" class="form-control" placeholder="Pin code" />
						</div>
                        <div class="col-md-6">
							<label class="control-label">Country</label>
                            <input type="text" name="country" class="form-control" placeholder="Country" />
						</div>
					</div>
                    <div class="form-group">
						<div class="col-md-6">
							<label class="control-label">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone" />
						</div>
                        <div class="col-md-6">
							<label class="control-label">Account Type</label>
                            <select name="account_type" class="form-control">
                                <option value="2">Buyer</option>
                                <option value="3">Seller</option>
                            </select>
						</div>
					</div>
                    <div class="text-center">
                        <a href="{{url('homepage/quote')}}" class="prev-button btn btn-circle btn-danger" type="reset">Back to Step 2</a>
                      <button type="submit" class="next-button btn">Register</button>
                    </div> 
				</form>
            </div>
        </div><!-- stp3_register -->

        <div class="h50"></div>
        
        
        
        
    </div><!-- row -->



</div><!-- row -->


    <div class="clearfix"></div>
    <div class="h100"></div>
    <div class="clearfix"></div> 

    
<div class="clearfix"></div>

<script> 

$('.stp_3_rqs .green_btn.my_clck').click(function(){
    $('.stp3_register').slideUp(300);
    $('.stp3_opne').slideDown(300);
    $('.stp_3_rqs .green_btn.register').removeClass('active')
    $(this).addClass('active');
})

$('.stp_3_rqs .green_btn.register').click(function(){
    $('.stp3_opne').slideUp(300);
    $('.stp3_register').slideDown(300);
    $('.stp_3_rqs .green_btn.my_clck').removeClass('active')
    $(this).addClass('active');
})

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

$(".js-data-products-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/homepage/companySearch",
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
@include('home.footerlinks')
@endsection
