@include('admin.Emailtemplates.header')



<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Hello {{$name}}</h3>



<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">


Thank you for choosing to become a Verified user. 
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Allow 7-10 days for application process. We will contact you  if any additional information is needed. <br /><br />
  <strong>Payment Details:
    
  </strong>
<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="123">Account Name:</td>
    <td width="449">{{$account_name}}</td>
  </tr>
  <tr>
    <td>Transaction ID: </td>
    <td>{{$transaction_id}}</td>
  </tr>
  <tr>
    <td>Date: </td>
    <td>{{$date}}</td>
  </tr>
   <tr>
    <td>Invoice ID: </td>
    <td><a href="{{$invoicr_url}}">{{$invoice_id}}</a></td>
  </tr>
  
</table>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;"><br /><a href="{{$invoicr_url}}" target="_blank">Click here to Print Invoice</a>
                  
</p>
@include('admin.Emailtemplates.footer')
