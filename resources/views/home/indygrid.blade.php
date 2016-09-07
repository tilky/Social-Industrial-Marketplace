@extends('home.app')
@section('content')
@include('home.header')

<!--======================= layout ========================-->

<div class="small-layout animatedParent margintop40" style="background-image: url('{{URL::asset('livesite/images/banners/5.jpg')}}') ;">
    <div class="mask"></div>
    <h1 class="header_middle text-center animated bounceInDown slower">Indy Grid™</h1>
</div>


<!--=======================================================-->




<div class="section mincontainer_height animatedParent">
    <div class="color_bg feedback acount_refer animatedParent">
        <div class="container">
            <h3 class="head_railway padding50 text-center animated shake slower">Coming Soon</h3>

        </div>
    </div>
    <div class="container">

        <div class="col-md-12">



   <p>  <h3> </h3> <p>
   <p>   <p>
            <p>   <p>
                     Here at Indy John, we are working hard to grow our platform with new products and tools aiming to help you streamline your Buy-Sell experience.  However, our user goal remains the same - we want to continue to provide valuable products and tools for our users.  <p />Our most powerful and latest product is now in development -
               <p /><b>Indy Grid™</b>… coming soon!               
          <p /> <p />Thank you for using Indy John and we appreciate your business.  <p>
            - Indy John Team


   <p>  <h3> </h3> <p>


    </div>
</div>

<div class="clearfix"></div>




@include('home.footerlinks')
@endsection
