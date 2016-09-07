@include('admin.Emailtemplates.header')


<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">


  
 Welcome and Thank you for signing up with <a href="http://indyjohn.com">Indy John</a>. You are now a member of the first social marketplace dedicated to the Industrial workforce. We hope you enjoy our products and services!  <br />
 <br />
 
 Please verify your e-mail address by clicking the following button:
 <div><!--[if mso]>
  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{url('email/verify')}}?verification_code={{$code}}" style="height:40px;v-text-anchor:middle;width:175px;" arcsize="56%" strokecolor="#e6e6e8" fillcolor="#e7505a">
    <w:anchorlock/>
    <center style="color:#ffffff;font-family:sans-serif;font-size:13px;font-weight:bold;">Verify my E-Mail</center>
  </v:roundrect>
<![endif]--><a href="{{$code}}"
style="background-color:#e7505a;border:1px solid #e6e6e8;border-radius:22px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:175px;-webkit-text-size-adjust:none;mso-hide:all;">Verify my E-Mail</a></div>


<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">
Unable to click the button? Copy this url and paste it in your web browser: <br />
<a href="{{url('email/verify')}}?verification_code={{$code}}" target="_blank">{{url('email/verify')}}?verification_code={{$code}}</a>
  <br />
 <br />
                   If you have any questions, please contact our <a href="mailto:support@indyjohn.com">Support Team</a>.
							


</p>

@include('admin.Emailtemplates.footer')





                       

                          
