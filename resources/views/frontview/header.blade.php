<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>QuoteTek Home</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" media="print" href="{{URL::asset('css/bootstrap.min.css')}}">
    <link href="{{URL::asset('css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href="{{URL::asset('css/font-awesome.min.css')}}" rel="stylesheet">
       
    <link href="{{URL::asset('js/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('css/animations.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/prettyPhoto.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/linea.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/owl.theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/ng_responsive_tables.css')}}">
    
      
        
    <script src="{{URL::asset('metronic/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    
    
    
</head>
<!-- END HEAD -->

<body role="document">


<div id="homepage">

                                                                    
      <nav class="navbar custom_nav" data-spy="affix" data-offset-top="80" id="nav">
      <div>
          <div class="logo">    <a href="{{url('user-dashboard')}}"><img src="{{URL::asset('images/logo.png')}}"/></a></div>
        
      </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade searchModal" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
            
          </div>
          <div class="modal-body vericle_table">
              <div class="verticle_mddle">
                  <div class="">
                      <div class="searcform"> 
                          <input type="search" placeholder="Search Product Type or Category"><button type="submit" class="searchweb"><i class="fa fa-search"></i></button>  
                  </div>
                   
                  
                </div>
              </div>
          </div>
         
        </div>
      </div>
    </div>

</div>

<div class="clearfix"></div>
@yield('content')
@include('frontview.footer')

</body>

</html>
