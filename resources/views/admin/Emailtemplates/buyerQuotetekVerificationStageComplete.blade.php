@include('admin.Emailtemplates.header')


<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">
Thank you for choosing to become an Indy John Verified User. <br />
Indy John has completed your verification application and your account has been verified.  <br /><br />
Transaction Details: <br />

<br />Transaction ID: 
<br />Date: 
<br />Invoice ID:
<br /><br />
Login to your <a href="http://www.indyjohn.com">Indy John</a> account and visit the <a href=http://app.indyjohn.com/user/payment-history> Account Transaction History. </a></p>

@include('admin.Emailtemplates.footer')

