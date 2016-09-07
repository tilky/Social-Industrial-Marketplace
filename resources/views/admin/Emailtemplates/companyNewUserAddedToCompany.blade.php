@include('admin.Emailtemplates.header')


<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

A new user has been added to {{$company_name}} Company Page.</p>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;"> <strong>User Details: </strong></p>

<table width="582" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="123">Name:</td>
    <td width="449"> {{$first_name}} {{$last_name}} </td>
  </tr>
  <tr>
    <td>Date Joined: </td>
    <td>{{$date_joined}} </td>
  </tr>
 
</table>


<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Please Log In to <a href="{{url()}}/company/all-users">Indy John</a> to manage Users and more.</p>

@include('admin.Emailtemplates.footer')


                         
                    
					
