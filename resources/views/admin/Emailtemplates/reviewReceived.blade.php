@include('admin.Emailtemplates.header')



<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Hello {{$name}}</h3>



<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">



You have received a new review from<strong> {{$sender_first_name}} {{$sender_last_name}} </strong>on <a href="app.indyjohn.com">Indy John</a>.</p>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;"> <a href="app.indyjohn.com">Log-in to View and Approve your review.</a></p>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">  Remember to network more efficiently by sharing your Indy John profile with your friends and associates. <a href="{{$profile_link}}.">Visit your Profile.</a></p>
@include('admin.Emailtemplates.footer')

