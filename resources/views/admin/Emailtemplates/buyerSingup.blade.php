@include('admin.Emailtemplates.header')


<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

                     Welcome and Thank you for signing up with <a href="http://indyjohn.com">Indy John</a>. You are now a member of the first social marketplace dedicated to the Industrial workforce. We hope you enjoy our products and services! 
                        
                          <br /><br />
                           Thank you for signing up for an account on Indy John. Indy John is the new way to connect Buyers with Suppliers of Industrial Products and Services.
                           </p>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Please verify your e-mail by clicking the following link: <br />
                                {{url('quotetekverification')}}

</p>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">							 Begin Exploring at <a href="http://indyjohn.com">Indy John</a> Now.
</p>
<p>@include('admin.Emailtemplates.footer') </p>
