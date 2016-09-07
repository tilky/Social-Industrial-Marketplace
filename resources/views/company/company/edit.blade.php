@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
            @else
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
            @endif
        </li>
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url()}}/companies">Companies</a>
            <i class="fa fa-circle"></i>  
            @else
            <a href="{{url()}}/companies/{{$company->id}}">Companies</a>
            <i class="fa fa-circle"></i>  
            @endif
        </li>
        <li>
            <span>Edit Company</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-gift color-black"></i>  Edit {{$company->name}}</div>
                <div class="actions">
                    <a href="{{ URL::to('companies/info/') }}/{{$company->id}}" class="btn btn-circle btn-sm">
                        <i class="fa fa-pencil"></i>  Edit Other Info </a>
                </div>
            </div>

            <div class="portlet-body form">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{$company->logo}}" height="200" width="200"/>
                    </div>
                    <form action="{{url()}}/upload/file" class="dropzone dropzone-file-area" id="my-dropzone" style="width:200px; margin-top: 50px;">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <h4 class="">Change Company Logo, Drop files here or click to upload</h4>
                    </form>
                </div>

                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- BEGIN FORM-->
                {!! Form::model($company, [
                'method' => 'PATCH',
                'id' => 'submit-form',
                'route' => ['companies.update', $company->id],
                'class' => 'horizontal-form'
                ]) !!}
                <div class="form-body">
                    <input type="hidden" name="logo" id="logo" value="{{$company->logo}}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Active</label><br/>
                                @if($company->is_Active == 1)
                                <input name="is_Active" value="1" type="checkbox" checked class="make-switch form-control" data-size="small">
                                @else
                                <input name="is_Active" value="1" type="checkbox" class="make-switch form-control" data-size="small">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <span class="required" aria-required="true"> * </span>
                                <input data-required="1" value="{{$company->name}}" type="text" id="name" name="name" class="form-control" placeholder="Name of company">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Custom URL</label>
                                @if($company->package->name == 'Free')
                                    <input readonly data-required="1" value="{{$company->unique_company_url}}" type="text" id="unique_company_url" name="unique_company_url" class="form-control" placeholder="Custom URL">
                                @else
                                    <input data-required="1" value="{{$company->unique_company_url}}" type="text" id="unique_company_url" name="unique_company_url" class="form-control" placeholder="Custom URL">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <span class="required" aria-required="true"> * </span>
                                <input data-required="1" type="text" value="{{$company->phone}}" name="phone" class="form-control" placeholder="Phone number">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <span class="required" aria-required="true"> * </span>
                                <input data-required="1" type="text" value="{{$company->email}}" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Address</label>
                                <span class="required" aria-required="true"> * </span>
                                <textarea data-required="1" type="text"  name="address" class="form-control" placeholder="Address">{{$company->address}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Address2</label>
                                <textarea  name="address2" class="form-control" placeholder="Address 2">{{Request::old('address2')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <span class="required" aria-required="true"> * </span>
                                <input data-required="1" type="text" value="{{$company->city}}" name="city" class="form-control" placeholder="City">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">State</label>
                                <span class="required" aria-required="true"> * </span>
                                <input data-required="1" type="text" value="{{$company->state}}" name="state" class="form-control" placeholder="State">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Zip</label>
                                <span class="required" aria-required="true"> * </span>
                                <input data-required="1" type="text" value="{{$company->zip}}" name="zip" class="form-control" placeholder="Zip">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <span class="required" aria-required="true"> * </span>
                                <input data-required="1" type="text" value="{{$company->country}}" name="country" class="form-control" placeholder="Country">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea data-required="1" type="text" value="{{$company->description}}" name="description" class="form-control" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Establishment Year</label>
                                <input data-required="1" type="text" value="{{$company->establishment_year}}" name="establishment_year" class="form-control" placeholder="Establishment Year">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Export Start Year</label>
                                <input data-required="1" type="text" value="{{$company->export_start_year}}" name="export_start_year" class="form-control" placeholder="Export Start Year">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Number of Employees</label>
                                <select data-required="1" type="text" name="employees_count" class="form-control" placeholder="Establishment Year">
                                    @if($company->employees_count == '1-10')
                                        <option selected value="1-10">1-10</option>
                                    @else
                                        <option value="1-10">1-10</option>
                                    @endif

                                    @if($company->employees_count == '11-50')
                                    <option selected value="11-50">11-50</option>
                                    @else
                                    <option value="11-50">11-50</option>
                                    @endif

                                    @if($company->employees_count == '51-100')
                                    <option selected value="51-100">51-100</option>
                                    @else
                                    <option value="51-100">51-100</option>
                                    @endif

                                    @if($company->employees_count == '101-250')
                                    <option selected value="101-250">101-250</option>
                                    @else
                                    <option value="101-250">101-250</option>
                                    @endif

                                    @if($company->employees_count == '250-1000')
                                    <option selected value="250-1000">250-1000</option>
                                    @else
                                    <option value="250-1000">250-1000</option>
                                    @endif

                                    @if($company->employees_count == '1000+')
                                    <option selected value="1000+">1000+</option>
                                    @else
                                    <option value="1000+">1000+</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Total Sales</label>
                                <input data-required="1" type="text" value="{{$company->total_sales}}" name="total_sales" class="form-control" placeholder="Total Sales">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Trade Capacity</label>
                                <input data-required="1" type="text" value="{{$company->trade_capacity}}" name="trade_capacity" class="form-control" placeholder="Trade Capacity">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Production Capacity</label>
                                <input data-required="1" type="text" value="{{$company->production_capacity}}" name="production_capacity" class="form-control" placeholder="Production Capacity">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">R & D Capacity</label>
                                <input data-required="1" type="text" value="{{$company['r@d_capacity']}}" name="r&d_capacity" class="form-control" placeholder="R D Capacity">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Production Line Count</label>
                                <input data-required="1" type="text" value="{{$company->production_line_count}}" name="production_line_count" class="form-control" placeholder="Production Line Count">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Website</label>
                                <input data-required="1" type="text" value="{{$company->website}}" name="website" class="form-control" placeholder="Website">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Customer Care Contact Name	</label>
                                <input data-required="1" type="text" value="{{$company->customer_care_contact_name}}" name="customer_care_contact_name" class="form-control" placeholder="Customer Care Contact Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Customer Care Email</label>
                                <input data-required="1" type="text" value="{{$company->customer_care_email}}" name="customer_care_email" class="form-control" placeholder="Customer Care Email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Customer Care Phone</label>
                                <input data-required="1" type="text" value="{{$company->customer_care_phone}}" name="customer_care_phone" class="form-control" placeholder="Customer Care Phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Accepted Delivery Terms</label>
                                <textarea data-required="1" type="text" value="{{$company->accepted_delivery_terms}}" name="accepted_delivery_terms" class="form-control" placeholder="Accepted Delivery Terms"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Accepted Payment Currency</label>
                                <input data-required="1" type="text" value="{{$company->accepted_payment_currency}}" name="accepted_payment_currency" class="form-control" placeholder="Accepted Payment Currency">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Accepted Payment Types</label>
                                <input data-required="1" type="text" value="{{$company->accepted_payment_type}}" name="accepted_payment_type" class="form-control" placeholder="Accepted Payment Types">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Languages</label>
                                <input data-required="1" type="text" value="{{$company->languages}}" name="languages" class="form-control" placeholder="Languages">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Average Lead Time</label>
                                <input data-required="1" type="text" value="{{$company->average_lead_time}}" name="average_lead_time" class="form-control" placeholder="Average Lead Time">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-circle green">Submit</button>
                            <a href="{{ URL::to('companies') }}" class="btn btn-circle btn-sm">
                                Cancel </a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
    /* for show menu active */
    $("#compnay-main-menu").addClass("active");
    $('#compnay-main-menu' ).click();
    $('#conpmay-menu-arrow').addClass('open');
    $('#edit-company-menu').addClass('active');
    /* end menu active */
    $(document).on("keyup", "#name", function () {
        if($('#account_id').val() == 1){
            return;
        }
        var val = $('#name').val();
        val = val.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
        $('#unique_company_url').val(val);
    });

    var FormDropzone = function () {
        return {
            //main function to initiate the module
            init: function () {

                Dropzone.options.myDropzone = {
                    dictDefaultMessage: "",
                    serverFileName : "",
                    init: function() {
                        this.on("addedfile", function(file) {
                            console.log('asd');
                            // Create the remove button
                            var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn btn-danger btn-sm btn-block'>Remove</a>");

                            // Capture the Dropzone instance as closure.
                            var _this = this;

                            // Listen to the click event
                            removeButton.addEventListener("click", function(e) {
                                // Make sure the button click doesn't submit the form:
                                e.preventDefault();
                                e.stopPropagation();

                                // Remove the file preview.
                                _this.removeFile(file);
                                //Ajax request to remove file on server.

                                $.ajax({
                                    url: "removeFile/file/"+_this.serverFileName,
                                    cache: false
                                }).done(function( json ) {
                                        $('#logo').val(null);
                                    });
                            });

                            // Add the button to the file preview element.
                            file.previewElement.appendChild(removeButton);
                        });
                    },

                    success: function(file, response){
                        this.serverFileName = response.fileName;
                        $('#logo').val(response.fullURL);
                    },

                    error: function(file, response){
                        alert('Invalid File');
                    }
                }
            }
        };
    }();

    jQuery(document).ready(function() {
        FormDropzone.init();
    });
</script>
@endsection
