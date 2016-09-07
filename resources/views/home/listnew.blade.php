@extends('home.header')

@section('content')

<style>
input, select, textarea {
    width: 100%;
    border: 1px solid #bababa;
    border-radius: 30px;
    padding: 10px;
    padding-left: 20px;
    outline: 0;
    margin-bottom: 30px;
}
</style>
<link href="{{URL::asset('css/style_custom.css')}}" rel="stylesheet">
<!-- Custome Style -->
    <link href="{{URL::asset('css/style.css')}}"" rel="stylesheet" type="text/css" />
    <!-- end Custome Style -->
    

    <link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{URL::asset('metronic/scripts/app.min.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    
    <script src="{{URL::asset('metronic/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery-multi-select/js/jquery.multi-select.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>

<style>
.select2-container{display: block!important;}
.select2-container .select2-selection--single{height: 45px!important;border-radius: 20px;line-height: 40px!important;}
.select2-selection__rendered{height: 45px!important;line-height: 40px!important;}
.select2-selection__arrow{top: 10px!important;}
</style>
    
<div class="section fade">
    <form method="POST" action="{{url('homepage/listnew/save')}}" accept-charset="UTF-8" class="horizontal-form" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="container animatedParent">
        <div class="text-center"> 
            <h3 class="header_middle  ">List a New Product for Sale</h3>
        </div> 
         @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <div class="row">
            <div class="col-sm-4">
                <input type="text" name="name" placeholder="Name">      
            </div>
        
            <div class="col-sm-4">
                <input type="text" name="brand_name" placeholder="Brand Name">      
            </div>
            
            <div class="col-sm-4">
                <input type="text" name="model_number" placeholder="Model Number">      
            </div>
            <div class="col-sm-6 cstm_frm">
                <select id="select2-button-addons-single-input-group-sm" name="product_categories" class="js-data-category-ajax">
                    <option value="">Categories </option>
                </select>
            </div>
            <div class="col-sm-6 cstm_frm">
                <select id="select2-button-addons-single-input-group-sm" name="product_industries" class="js-data-industries-ajax">
                    <option value="">Industries </option>
                </select>
            </div>
            <div class="col-md-12">
                <div class="relative col-md-3 text-center" style="margin-top: 30px;">
                <div class="uploadimage">
                    <img src="{{URL::asset('images/placeholder_png.jpg')}}" width="255" height="218" alt="" id="myImg">
                    <div class="upload_div hvr-rectangle-out">   
                    <input type="file" name="product_img" id="fil_ups">
                        <div> 
                       <a href="#"> 
                      <i><img src="{{URL::asset('images/uploading.png')}}" alt="" ></i>
                      <h4>Upload Image</h4>
                       </a>
                      <div class="check"> <i class="fa fa-check"></i></div>
                    </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-9 frm" style="margin-top: 30px;">
                <textarea name="description" id="" placeholder="Description "></textarea>
            </div><!-- col -->
            </div>
            
        </div><!-- row -->
        <div class="row">
            <div class="col-sm-4">
                <input type="text" name="size" placeholder="Size">
            </div>
            <div class="col-sm-4">
                <input type="text" name="certification" placeholder="Certification">
            </div>
            <div class="col-sm-4 file_up">
                <input type="text" placeholder="Upload PDF">
                <input type="file" name="attachment_path" id="file">
                <i class="fa fa-file-pdf-o up_icon"></i>
            </div> 
        </div><!-- row -->
        <div class="row">
            <div class="col-sm-4">
                <input type="text" name="price" placeholder="Price of Product">
            </div>
            <div class="col-sm-4">
                <input type="text" name="unit_type" placeholder="Unit type of Product">
            </div>
            <div class="col-sm-4">
                <input type="text" name="discount_percent" placeholder="Discount percent of Product">
            </div>
        </div><!-- row -->
        <div class="row">
            <div class="col-sm-6 ">
                <input type="text" name="minimum_quantity" placeholder="Minimum Quantity ">
            </div>
            <div class="col-sm-6">
                <input type="text" name="quantity_available" placeholder="Quantity Available ">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 cstm_frm">
                <select name="condition_quality" placeholder="Condition quality">
                    <option value="">Condition quality</option>
                    <option value="excellent">Excellent</option>
                    <option value="light usage">Light usage</option>
                    <option value="heavy usage">Heavy usage</option>
                    <option value="bad but working">Bad but working</option>
                    <option value="for parts only">For parts only</option>
                </select>
            </div>
            <div class="col-sm-6 cstm_frm">
                <select name="condition" placeholder="Product Condition">
                    <option value="">Product Condition</option>
                    <option value="new">New</option>
                    <option value="used">Used</option>
                    <option value="refurbished">Refurbished</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <h4 class="rq2_h4 f30">Supply & Shipping</h4>
            </div>
            <div class="col-sm-6">
                <p class="bolf_20">Supply Ability</p>
                <p>
                    <textarea name="supply_ability" id="" placeholder="Supply Ability "></textarea>
                </p> 
            </div><!-- col -->
            
            <div class="col-sm-6">
                <p class="bolf_20">Place of Origin</p>
                <p>
                    <textarea name="place_of_origin" id="" placeholder="Place of Origin "></textarea>
                </p>
            </div>
        </div><!-- row -->  
        <div class="row">
            <div class="col-sm-12 text-center">
                <h4 class="rq2_h4 f30">Shipping </h4>
            </div>
            <div class="col-sm-6">
                <p class="bolf_20">Shipping terms </p>
                <p>
                    <textarea name="shipping_terms" id="" placeholder="Shipping terms"></textarea>
                </p> 
            </div><!-- col -->
            <div class="col-sm-6">
                <p class="bolf_20">Package Size</p>
                <p>
                    <textarea name="package_size" id="" placeholder="Package Size "></textarea>
                </p>
            </div>
        </div><!-- row -->
        <div class="h50"></div>
        <div class="row">
            <div class="col-sm-4">
                <input type="text" placeholder="Package Size">
            </div><!-- col -->
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="" class="free_ship">Free Shipping</label>
                    </div>
                    <div class="col-sm-6">
                        <ul class="on_off_btn btn-circle my_on_off">
                        <li id="free_yes"><a href="javascript:void()">yes</a></li>
                        <li id="free_no" class="active"><a href="javascript:void()">No</a></li>
                        </ul>
                        <input type="hidden" id="free_ship" name="free_shipping" value="0" />
                    </div>
                </div>
            </div><!-- col -->
            <div class="col-sm-4 cstm_frm">
                <select id="free_shipping_continents" name="free_shipping_continents">
                    <option value="">free shipping continents </option>
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="Europe">Europe</option>
                    <option value="Asia-China">Asia-China</option>
                    <option value="Asia-India">Asia-India</option>
                    <option value="Asia-Others">Asia-Others</option>
                    <option value="South America">South America</option>
                    <option value="Australia">Australia</option>
                </select>
            </div><!-- col -->
        </div><!-- row -->
        <div class="row">
            <div class="col-sm-4">
                <input type="text" placeholder="shipping fee">
            </div><!-- col -->
        </div><!-- row -->
        <div class="row">
            <div class="col-sm-6">
                <h4 class="rq2_h4 f30 text-center">Payment Terms </h4>
                <p>
                    <textarea name="payment_terms" id="" placeholder="Payment Terms"></textarea>
                </p>
            </div>
            <div class="col-sm-6">
                <h4 class="rq2_h4 f30 text-center">Return Policy? </h4>
                <p>
                    <textarea name="return_policy" id="" placeholder="Return Policy"></textarea>
                </p>
            </div>
        </div>
    </div><!-- c -->
    <div class="clearfix"></div>
    <div class="h50"></div>
    <div class="clearfix"></div> 
    <div class="container">
        <div class="row">
            <div class="text-center">
                <button class="next-button btn btn-circle last_btn" type="submit">Post</button>
                <a href="{{url('/')}}" class="btn btn-circle last_btn">Delete</a>
            </div><!-- row -->
        </div> <!-- container -->
    </div>
    </form>
</div>
<div class="clearfix"></div>
<script>
$(function () {
    $("#fil_ups").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};


$('.stp_3_rqs .green_btn.my_clck').click(function(){
     $('.stp3_opne').slideToggle();
     $('.stp_3_rqs .green_btn').removeClass('active')
     $(this).addClass('active');
})
 $('.on_off_btn btn-circle li').click(function(){
    $(this).parent('ul').find('li').removeClass('active')
    if($(this)[0].id == 'free_yes')
    {
        $('#free_ship').val(1);
    }
    else
    {
        $('#free_ship').val(0);
    }
    $(this).addClass('active')
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

$(".js-data-category-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/homepage/categorySearch",
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
$(".js-data-industries-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/homepage/industrySearch",
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
