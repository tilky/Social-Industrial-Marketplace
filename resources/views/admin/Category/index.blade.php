@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Categories</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> Manage Categories
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  Categories </div>
                <div class="actions">
                    <a href="javascript:;" id="addRootCategory" class="btn btn-circle btn-sm">
                        <i class="fa fa-plus"></i>  Add Root Category</a>
                    <a href="javascript:;" id="addSubCategory" class="btn btn-circle btn-sm">
                        <i class="fa fa-plus"></i>  Add Sub Category</a>
                    <a href="{{url('category/massImport')}}" class="btn btn-circle btn-sm">
                        <i class="fa fa-plus"></i>  Mass Import Categories</a>
                    <a data-toggle="modal" id="deleteCategory" class="btn btn-circle btn-sm" href="#deleteConfirmation">
                        <i class="fa fa-remove"></i>  Delete Category</a>
                </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="portlet light bordered" id="blockui_sample_1_portlet_body">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-tree font-green-sharp"></i>  
                                    <span class="caption-subject font-green-sharp sbold">Category Tree</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="categoryTree" class="tree-demo"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="portlet light bordered" id="blockui_sample_1_portlet_body">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-plus font-green-sharp"></i>  
                                    <span class="caption-subject font-green-sharp sbold">Add/Edit Category</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                {!! Form::open([
                                'id' => 'categoryForm',
                                'route' => 'categories.store',
                                'class' => 'horizontal-form'
                                ]) !!}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <span class="required" aria-required="true"> * </span>
                                                <input data-required="1" id="name" type="text" name="name" class="form-control" placeholder="Name of category">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Active</label><br/>
                                                <input id="is_active" name="is_active" value="1" type="checkbox" checked class="make-switch form-control" data-size="small">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="parent_id" id="parent_id"/>
                                    <input type="hidden" name="cat_id" id="cat_id"/>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-circle blue">
                                        <i class="fa fa-check"></i>  Save</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>

    jQuery('#deleteConfirmation .modal-footer button').on('click', function (e) {
        var $target = $(e.target); // Clicked button element
        $(this).closest('.modal').on('hidden.bs.modal', function () {
            if($target[0].id == 'confirmDelete'){
                if(!$('#categoryTree').jstree().get_selected(true)[0]){
                    alert('Please select at least one category to delete.')
                }else{
                    //Category selected to delete.
                    var selectedCatId = $('#categoryTree').jstree().get_selected(true)[0].data;
                    $.ajax({
                        url: 'categories/delete/'+selectedCatId,
                        success: function(result) {
                            window.location.reload();
                        }
                    });
                }
            }
        });
    });

    $( document ).ready(function() {
        //Getting category tree from database
        $.ajax({
            url: "cat-tree/0",
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
                    $('#parent_id').val(selectedCat.original.parent_id);
                    $('#name').val(selectedCat.original.text);
                    $('#cat_id').val(selectedCat.data);
                    if(selectedCat.original.is_active == 0){
                        if($('#is_active').bootstrapSwitch('state') == true){
                            $('#is_active').bootstrapSwitch('toggleState');
                        }
                    }else{
                        if($('#is_active').bootstrapSwitch('state') == false){
                            $('#is_active').bootstrapSwitch('toggleState');
                        }
                    }
                });
            },500);
        });
    });

    //Event for add root category button
    $(document).on("click", "#addRootCategory", function () {
        //reset create form
        $('#categoryForm')[0].reset();
        //deselect all elements in tree
        $('#categoryTree').jstree("deselect_all");
        //reset hidden parent id value to null
        $('#parent_id').val(null);
        $('#cat_id').val(null);
    });

    //Event for add root category button
    $(document).on("click", "#addSubCategory", function () {
        //reset create form
        $('#categoryForm')[0].reset();
        //set parent id to current select id
        $('#parent_id').val($('#categoryTree').jstree().get_selected(true)[0].data);
        $('#cat_id').val(null);
    });

</script>
@endsection
