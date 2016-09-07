@include('admin.Emailtemplates.header')




@if($userPic != '')
<center><img src="{{$userPic}}" width="100" height="100" style="border:1px solid black;border-radius: 50% 50%"/><p />
</center>
@endif
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

<center><b>{{$sender_name}}</b> has invited you to join <a href="{{$url}}">IndyJohn.com</a>.</center><br />
<a href="{{$url}}">IndyJohn.com</a> is a Social Marketplace for the Industrial World. Indy John offers a more efficient way for Industrial people to Buy, Casually Shop and Sell industrial items and services. <br /><br />
Indy John is free to use and explore. Upon signing up, please use {{$sender_name}}'s referral code:  <strong>{{$referralCode}}</strong>.<br /><br />

 <div><!--[if mso]>
  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{url('email/verify')}}?verification_code={{$url}}" style="height:40px;v-text-anchor:middle;width:175px;" arcsize="56%" strokecolor="#e6e6e8" fillcolor="#e7505a">
    <w:anchorlock/>
    <center style="color:#ffffff;font-family:sans-serif;font-size:15px;font-weight:bold;">Sign up Now</center>
  </v:roundrect>
<![endif]--><a href="{{$url}}"
style="background-color:#e7505a;border:1px solid #e6e6e8;border-radius:22px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:15px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:175px;-webkit-text-size-adjust:none;mso-hide:all;">Sign up Now</a></div>



<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">


  @include('admin.Emailtemplates.footer')</p>
