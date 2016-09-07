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
                    <i class="fa fa-gift"></i>  Edit Product </div>
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
                {!! Form::model($product, [
                'method' => 'PATCH',
                'route' => ['products.update', $product->id],
                'class' => 'horizontal-form'
                ]) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('name', 'Name ', ['class' => 'control-label']) !!}
                                    <span class="required" aria-required="true"> * </span>
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Active</label><br/>
                                    @if($product->is_active == 1)
                                        <input name="is_active" value="1" type="checkbox" checked class="make-switch form-control" data-size="small">
                                    @else
                                        <input name="is_active" value="1" type="checkbox" class="make-switch form-control" data-size="small">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <span class="required" aria-required="true"> * </span><br/>
                                    <input type="hidden" name="category_id" id="category_id" value="{{$product->category_id}}"/>
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
            url: "{{ URL::to('cat-tree') }}/{{$product->category_id}}",
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
