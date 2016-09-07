<!-- BEGIN PROFILE SIDEBAR -->
<div class="profile-sidebar">
    <!-- PORTLET MAIN -->
    <div class="portlet light profile-sidebar-portlet bordered">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
            @if(Auth::user()->userdetail->profile_picture != '')
            <img src="{{url('')}}/{{Auth::user()->userdetail->profile_picture}}" class="img-responsive" alt=""> 
            @else
            <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" alt="sell" class="img-responsive">
            @endif
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name font-wh"> {{Auth::user()->userdetail->first_name}} {{Auth::user()->userdetail->last_name}}</div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li id="user-profile-view">
                    <a href="{{url('user/view')}}">
                        <i class="fa fa-home"></i>  Overview </a>
                </li>
                <li id="user-profile-view">
                    <a href="{{url('user/profile')}}">
                        <i class="fa fa-user"></i>  Profile </a>
                </li>
                <li id="user-account-view">
                    <a href="{{url('user/account')}}">
                        <i class="icon-settings"></i>  Account Settings </a>
                </li>
                <!--<li id="user-account-view">
                    <a href="{{url('user-details')}}">
                        <i class="icon-user"></i>  User Details </a>
                </li>-->
            </ul>
        </div>
        <!-- END MENU -->
    </div>
    <!-- END PORTLET MAIN -->
    <!-- PORTLET MAIN -->
    <div class="portlet light bordered">
        <div class="font-wh">
            <h4 class="profile-desc-title font-wh">About {{Auth::user()->userdetail->first_name}} {{Auth::user()->userdetail->last_name}}</h4>
            <span class="profile-desc-text font-wh"> {{Auth::user()->userdetail->about}} </span>
            @if(Auth::user()->userdetail->website_url != '')
            <div class="margin-top-20 profile-desc-link">
                <i class="fa fa-globe"></i>  
                <a class="font-wh" href="{{Auth::user()->userdetail->website_url}}">{{Auth::user()->userdetail->website_url}}</a>
            </div>
            @endif
            @if(Auth::user()->userdetail->facebook_url != '')
            <div class="margin-top-20 profile-desc-link">
                <i class="fa fa-facebook"></i>  
                <a class="font-wh" href="{{Auth::user()->userdetail->facebook_url}}">Facebook</a>
            </div>
            @endif
            @if(Auth::user()->userdetail->insta_url != '')
            <div class="margin-top-20 profile-desc-link">
                <i class="fa fa-instagram"></i>  
                <a class="font-wh" href="{{Auth::user()->userdetail->insta_url}}">Instagram</a>
            </div>
            @endif
            @if(Auth::user()->userdetail->pintress_url != '')
            <div class="margin-top-20 profile-desc-link">
                <i class="fa fa-pinterest"></i>  
                <a class="font-wh" href="{{Auth::user()->userdetail->pintress_url}}">Printrest</a>
            </div>
            @endif
            @if(Auth::user()->userdetail->youtube_url != '')
            <div class="margin-top-20 profile-desc-link">
                <i class="fa fa-youtube"></i>  
                <a class="font-wh" href="{{Auth::user()->userdetail->youtube_url}}">Youtube</a>
            </div>
            @endif
        </div>
    </div>
    <!-- END PORTLET MAIN -->
</div>
<!-- END BEGIN PROFILE SIDEBAR -->
