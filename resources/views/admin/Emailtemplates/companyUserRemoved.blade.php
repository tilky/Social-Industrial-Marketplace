@include('admin.Emailtemplates.header')

<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$company_name}} Administrator,</h3>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">
A user connection has been removed from {$company_name}} Company Page page.
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Please Log In to <a href="{{url()}}/company/all-users"> Indy John</a> to manage Users, and more.
</p>
  
  @include('admin.Emailtemplates.footer')
