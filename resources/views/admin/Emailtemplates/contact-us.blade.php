@include('admin.Emailtemplates.header')



<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Hello Indy John Team,</h3>


<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

A visitor has contacted us using the contact form. 


<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Query Details: 
<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="123">Name:</td>
    <td width="449">{{$name}}</td>
  </tr>
  <tr>
    <td>E-mail </td>
    <td>{{$email}}</td>
  </tr>
  <tr>
    <td>Department: </td>
    <td>{{$department}}</td>
  </tr>
   <tr>
    <td>Message: </td>
    <td>{{$description}}</td>
  </tr>
  
</table>





</p>
@include('admin.Emailtemplates.footer')
