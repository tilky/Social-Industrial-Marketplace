
@include('admin.Emailtemplates.header')



<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Hello {{$name}}, </h3>



<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

{{$sender_name}} want's to introduce <a href="{{$url}}">IndyJohn.com</a> to you. <br /><br /> 
<strong>Indy John</strong> is a Social Marketplace for the Industrial World. Our  platform offers a more efficient way for Industrial people to Buy, Casually  Shop and Sell industrial items and services. <br /><br />Our core industrial marketplace is free to use and explore.<br /><br /><a href="{{$url}}">Sign up Now to Begin Exploring.</a>
<br />
<br />
Upon signing up, please use {{$sender_name}}'s referral code:  <strong>{{$$referralCode}}</strong>.</p>

  @include('admin.Emailtemplates.footer')</p>
