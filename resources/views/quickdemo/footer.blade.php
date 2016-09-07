<!-- BEGIN FOOTER -->

<div class="modal fade learn_job_modal" id="signup_warning" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <a style="margin-top: -18px;" href="{{url('/')}}">
        <h1 class="logo-default"><img src="{{url('images/indy_john_crm_logo.png')}}" /></h1>
    </a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
      </div>
      <p>Sorry. This section is not available in the Demo. Please Sign up for a Free Account to access this feature.</p>
      <div class="clearfix"></div>
      <a href="{{url('/')}}" class="btn_red  btn_yellow hvr-bounce-to-right">Sign up For Free</a> </div>
  </div>
</div>
<!-- /.modal --> 

<div class="page-footer">
  <div class="page-footer-inner" vertical-align="middle"> © Indy John Inc. All Rights Reserved. <a href="javascript:void(0);" id="footer-feedback"><b>Feedback</b></a> </div>
  <img class="footer_logo" src="{{URL::asset('livesite/images/powered-by-indy-john.png')}}" height="25px" width="200px">
  <div class="scroll-to-top"> <i class="icon-arrow-up"></i> </div>
</div>

<script>
function getQueryStringValue (key) {  
  return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));  
}  


</script> 
<script>



// for tutorial
$(document).ready(function(){
   var _slides = [
             {
    		 content: '<b>Walk through our tutorial to get a quick overview of how Indy John works.</span>',
    		 selector: '#buyer-tool-main-menu a',
             position: 'right-top',
             title: '<b>WELCOME TO INDY JOHN.</b>',
             onSlide: function(){
                $("#buyer-tool-main-menu").addClass("active");
               	$('#buyer-tool-menu-arrow').addClass('open');
             },
             onNext: function(){
                $("#buyer-tool-main-menu").removeClass("active");
                $('#buyer-tool-menu-arrow').removeClass('open');
                $.tutorialize.next();
             }
    		},
		    {
                content: '<b>Buyers: Get Pricing Options </b><br/><span>Get Product and Service Pricing Options using our Quote-Lead System™.<span><br/><br/><b>Suppliers: Receive New Leads</b><br/><span>Receive more Product and Service Sales Leads using our Quote-Lead System™.</span>',
                selector: '#buyer-tool-main-menu a',
                position: 'right-top',
                title: '<b>QUOTE-LEAD SYSTEM™: PURCHASE, LEASE OR SERVICE ITEMS!</b>',
                onSlide: function(){
                    $("#buyer-tool-main-menu").addClass("active");
               	    $('#buyer-tool-menu-arrow').addClass('open');
                },
                onNext: function(){
                    $("#buyer-tool-main-menu").removeClass("active");
                    $('#buyer-tool-menu-arrow').removeClass('open');
                    $("#team-purchasing").addClass("active");
                    $('#team-purchasing-menu-arrow').addClass('open');
                    $.tutorialize.next();
                }
    		},
    		{
    		 content: 'Feel free to jump Back-and-Forth between buying and selling features.',
    		 selector: '#switch-crm-menu',
    		 position: 'bottom-left',
            title: 'Toggle between SUPPLIER and BUYER MODE',
             onNext: function(){
                    $("#marketplace-main-menu").addClass("active");
                	$('#marketplace-menu-arrow').addClass('open');
                    $.tutorialize.next();
                },
             onPrev: function(){
                    $("#buyer-tool-main-menu").addClass("active");
                    $('#buyer-tool-menu-arrow').addClass('open');
                    $.tutorialize.prev();
                }
    		},
    		{
    		 content: 'Post and Search Items in a New Industrial-Only Market.',
    		 selector: '#marketplace-main-menu',
    		 position: 'right-top',
            title: 'INDY JOHN MARKET',
             onNext: function(){
                    $("#marketplace-main-menu").removeClass("active");
                	$('#marketplace-menu-arrow').removeClass('open');
                    $("#jobs-main-menu").addClass("active");
                    $('#jobs-menu-arrow').addClass('open');
                    $('#jobs-search-menu').addClass('active');
                    $.tutorialize.next();
                },
             onPrev: function(){
                    $("#marketplace-main-menu").removeClass("active");
                	$('#marketplace-menu-arrow').removeClass('open');
                    $.tutorialize.prev();
                }
    		},
    		{
    		 content: 'Post and Search for Industrial Jobs on our Job Board.',
    		 selector: '#jobs-main-menu',
    		 position: 'right-bottom',
            title: 'JOB BOARD',
             onNext: function(){
                    $("#jobs-main-menu").removeClass("active");
                    $('#jobs-menu-arrow').removeClass('open');
                    $('#jobs-search-menu').removeClass('active');
                    $("#compnay-main-menu").addClass("active");
                	$('#compnay-menu-arrow').addClass('open');
                    $.tutorialize.next();
                },
             onPrev: function(){
                    $("#marketplace-main-menu").addClass("active");
                	$('#marketplace-menu-arrow').addClass('open');
                    $("#jobs-main-menu").removeClass("active");
                    $('#jobs-menu-arrow').removeClass('open');
                    $('#jobs-search-menu').removeClass('active');
                    $.tutorialize.prev();
                }
    		},
            {
    		 content: '<b>Join a Company Page</b><br/><span>Search and join an existing company page.</span><br/><br/><b>Claim & Start a new Page</b><br/><span>Administer your company details.</span>',
    		 selector: '#compnay-main-menu',
    		 position: 'right-top',
            title: 'MY COMPANY CENTER',
             onNext: function(){
                    $("#compnay-main-menu").removeClass("active");
                	$('#compnay-menu-arrow').removeClass('open');
                    $("#referrals-main-menu").addClass("active");
                	$('#referrals-main-menu-arrow').addClass('open');
                    $.tutorialize.next();
                },
             onPrev: function(){
                    $("#jobs-main-menu").addClass("active");
                    $('#jobs-menu-arrow').addClass('open');
                    $("#jobs-search-menu").addClass("active");
                    $("#compnay-main-menu").removeClass("active");
                	$('#compnay-menu-arrow').removeClass('open');
                    $.tutorialize.prev();
                }
    		},
            {
    		 content: 'Start Referring and Earning now.',
    		 selector: '#referrals-main-menu',
    		 position: 'right-top',
            title: 'REFER USERS',
             onNext: function(){
                    $("#referrals-main-menu").removeClass("active");
                	$('#referrals-main-menu-arrow').removeClass('open');
                    $.tutorialize.next();
                },
             onPrev: function(){
                    $("#referrals-main-menu").removeClass("active");
                	$('#referrals-main-menu-arrow').removeClass('open');
                    $("#compnay-main-menu").addClass("active");
                	$('#compnay-menu-arrow').addClass('open');                    
                    $.tutorialize.prev();
                }
    		},
    		{
    		 content: 'Gain an edge by upgrading your account',
    		 selector: '#upgrade-supplier-modal',
    		 position: 'bottom-right',
            title: 'UPGRADE YOUR ACCOUNT',
             onNext: function(){
                    $("#account-main-menu").addClass("active");
                	$('#account-main-menu-arrow').addClass('open');
                    $.tutorialize.next();
                },
             onPrev: function(){
                    $("#referrals-main-menu").addClass("active");
                	$('#referrals-main-menu-arrow').addClass('open');
                    $.tutorialize.prev();
                }
    		},
    		{
    		 content: 'Get verified and gain trust Online.',
    		 selector: '#quotetek-user-verification-menu',
    		 position: 'right-top',
            title: 'VERIFY YOUR ACCOUNT',
             onNext: function(){
                    $("#account-main-menu").removeClass("active");
                	$('#account-main-menu-arrow').removeClass('open');
                    $.tutorialize.next();
                },
             onPrev: function(){
                    $("#account-main-menu").removeClass("active");
                	$('#account-main-menu-arrow').removeClass('open');
                    $.tutorialize.prev();
                }
    		  
            },
    		{
    		 content: 'Grow your network by inviting friends and associates.',
    		 selector: '#invite-user-header',
             position: 'bottom-right',
            title: 'INVITE USERS',
             onPrev: function(){
                    $("#account-main-menu").addClass("active");
                	$('#account-main-menu-arrow').addClass('open');
                    $.tutorialize.prev();
                }
    		},
            {
    		 content: 'Manage your profile, company and account details. ',
    		 selector: '#user-profile-header',
    		 position: 'bottom-right',
    		 title: 'QUICKLY MANAGE YOUR ACCOUNT'
    		},
            {
    		 content: 'Streamline your Indy John workflow.',
    		 selector: '#header-quick-start',
    		 position: 'bottom-left',
    		 title: 'QUICK START'
    		}
    ];
    
    
    
    //$.tutorialize.start();
    if(getQueryStringValue("setup") == 'tutorial') 
    {
        $.tutorialize({
         slides: _slides,
         arrowPath: "{{url('tutorialize/arrows/arrow-red.png')}}",
         bgColor: '#ea6f5d',
         buttonBgColor: '#ea6f5d',
         buttonFontColor: '#fff',
         fontColor: '#666',
         padding:'0px',
         overlayMode: 'focus',
         showClose: true,
         theme: 'lined',
         width: 350,
         onStop: function(){
    				window.location.href = "{{url('/')}}";
    			}
        });
       $.tutorialize.start();
    }
            
    //setTimeout(function(){ $.tutorialize.start(); }, 2000); 
});

$(window).resize(function(){
    if ($(window).width() <= 894){  
        $(".responsive-toggler").click(function() { 
    // assumes element with id='button'
    $(".buttons-toggle").toggle();
	$(".page-top").toggle();
});
    }
});
</script> 

<!-- END FOOTER --> 

