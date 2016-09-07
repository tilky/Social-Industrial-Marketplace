
@include('admin.Emailtemplates.header')


<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">                            Your account has been created for <a href="http://indyjohn.com">Indy John</a> use. Here are your account details:<br /><br />         Email : {{$email}}

                      <br />      Password : *HIDDEN*

                     <br /><br />       
If you have any questions, please contact <a href="mailto:support@indyjohn.com">Indy John Support</a>. </p>

@include('admin.Emailtemplates.footer')

