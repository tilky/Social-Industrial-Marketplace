@extends('buyer.app')

@section('content')
<style>
.media, .media-body{overflow: visible!important;}
</style>
<!--<link href="{{URL::asset('metronic/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Supplier CRM Buy</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        @if (Session::has('message'))
            <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
        @endif
        <div class="col-md-12">
            <p class="font-wh">You need to buy Supplier package for show supplier CRM. If you want to Buy it, <a href="javascrit:void(0);" onclick="showModal(id)">click here.</a></p>
        </div>
        <!-- responsive -->
        <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Supplier Packages</h4>
            </div>
            <form action="{{url('supplier/package/save')}}" method="post" class="horizontal-form">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Select Package</label>
                                    <select name="supplier_package" class="form-control" placeholder="Condition quality">
                                        <option value="1">Free</option>
                                        <option value="2">Silver Package</option>
                                        <option value="3">Gold Package</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-circle blue">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>    
function showModal(id)
{
    $('#responsive').modal('show');    
}
</script>
<!--<script src="{{URL::asset('metronic/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>-->
@endsection
