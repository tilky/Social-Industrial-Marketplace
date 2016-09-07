

@include('admin.Emailtemplates.header')





<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>





<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Your Temporary Password is: {{$password}}





<br /><br />

<a href="{{url('auth/login')}}">Click here to Log.</a> 

<br /><br />

If you have any questions, Contact <a href="mailto:support@indyjohn.com">Support Team</a>.

</p>



@include('admin.Emailtemplates.footer')

