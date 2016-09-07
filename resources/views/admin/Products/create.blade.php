@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Products</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>  Add Product</div>
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
                {!! Form::open([
                'route' => 'products.store',
                'class' => 'horizontal-form'
                ]) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <span class="required" aria-required="true"> * </span>
                                    <input data-required="1" type="text" name="name" class="form-control" placeholder="Name of market">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Active</label><br/>
                                    <input name="is_active" value="1" type="checkbox" checked class="make-switch form-control" data-size="small">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <span class="required" aria-required="true"> * </span><br/>
                                    <input type="hidden" name="category_id" id="category_id"/>
                                    <div id="categoryTree" class="tree-demo"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a href="{{ URL::to('products') }}" class="btn btn-circle btn-sm">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle blue">
                            <i class="fa fa-check"></i>  Save</button>
                    </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
    /* for show menu active */
    $("#product-main-menu").addClass("active");
    $('#product-main-menu' ).click();
    $('#product-menu-arrow').addClass('open');
    $('#manage-product-menu').addClass('active');
    /* end menu active */

    $( document ).ready(function() {
        //Getting category tree from database
        $.ajax({
            url: "{{ URL::to('cat-tree/0') }}",
            cache: false
        }).done(function( json ) {
                //init js tree
                $('#categoryTree').jstree({
                    'plugins': ["wholerow", "types"],
                    'core': {
                        "themes" : {
                            "responsive": false
                        },
                        'data': json
                    },
                    "types" : {
                        "default" : {
                            "icon" : "fa fa-folder icon-state-warning icon-lg"
                        },
                        "file" : {
                            "icon" : "fa fa-file icon-state-warning icon-lg"
                        }
                    }
                });
                //expand all nodes of js tree.
                setTimeout(function(){
                    $('#categoryTree').jstree("open_all");
                    //assigning click handler to tree node.
                    $('#categoryTree').on('select_node.jstree', function(e,data) {
                        var selectedCat = $('#categoryTree').jstree().get_selected(true)[0];
                        $('#category_id').val(selectedCat.data);
                    });
                },500);
            });
    });
</script>
@endsection
