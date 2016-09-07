@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url()}}/companies">Companies</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Packages</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> Error
</h3>
<div class="row">
    <div class="col-md-12">
        <p>opps some thing went wrong</p>
    </div>
</div>
@endsection
