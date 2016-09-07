@include('admin.Emailtemplates.header')

                           <h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$company_name}} Administrator,
                           </h3>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">A new user has selected {{$company_name}} Company Page for their profile. Would you like to approve their company addition?
                       
                           <br />   <br />
                           <strong>User Details:
                           

                           </strong>
<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="123">Name:</td>
    <td width="449">{{$first_name}} {{$last_name}} </td>
  </tr>
  <tr>
    <td>Date Joined:</td>
    <td>{{$date_joined}} </td>
  </tr>
  <tr>
    <td>E-mail: </td>
    <td>{{$user_email}} </td>
  </tr>
   <tr>
    <td>Phone:</td>
    <td>{{$user_phone}} </td>
  </tr>
   <tr>
    <td>Industry:</td>
    <td>{{$user_industry}} </td>
  </tr>
</table>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">
Actions: 
  <a href="{{$approve_link}}" target="_blank">Approve this User</a>  |   <a href="{{$deny_link}}" target="_blank">Deny this User</a>
        </p>
@include('admin.Emailtemplates.footer')</p>
