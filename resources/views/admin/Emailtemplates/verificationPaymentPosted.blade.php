@include('admin.Emailtemplates.header')


<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">
Thank you for choosing to become an Indy John Verified User. <br /><br />
We have received your application fee and will contact you shortly if additional information is needed. <br />
<br />
Please allow 7-10 days for your application to process. 
<br /><br />
<strong>Transaction Details: </strong>
<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="123">Transaction ID:</td>
    <td width="449">{{$transaction_id}}</td>
  </tr>
  <tr>
    <td>Invoice ID: </td>
    <td>{{$invoice_id}}</td>
  </tr>
  <tr>
    <td>Date:</td>
    <td>{{$date}}</td>
  </tr>
</table>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">
View more details and print invoice from your <a href=http://app.indyjohn.com/user/payment-history>Account Payment History.</a>



</p>

@include('admin.Emailtemplates.footer')



