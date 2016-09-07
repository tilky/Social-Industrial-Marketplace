@include('admin.Emailtemplates.header')



<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Hello {{$name}}</h3>



<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

                            Thank you for your patience. Indy John team has completed our verification process. Your company account is now verified. 
	<br />	
    <strong><br>
    Payment Details: </strong>					
				<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="123">Name:</td>
    <td width="449">{{$account_name}} </td>
  </tr>
  <tr>
    <td>Transaction ID: </td>
    <td>{{$transaction_id}} </td>
  </tr>
  <tr>
    <td>Date: </td>
    <td>{{$date}} </td>
  </tr>
  <tr>
    <td>Invoice ID: </td>
    <td>{{$invoice_id}} </td>
  </tr>
</table>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;"> <a href="app.indyjohn.com">Log In</a> to view and print this invoice. </p>
@include('admin.Emailtemplates.footer')                   
