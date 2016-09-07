@include('admin.Emailtemplates.header')



<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Hello {{$name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">


Thank you for your payment. Your subscription details are as followed -


   <br />
</p>
<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="123">Subscribed Plan:</td>
    <td width="449">{{$plan}}</td>
  </tr>
  <tr>
    <td>Fee Charged:</td>
    <td>{{$fees}}</td>
  </tr>
  <tr>
    <td>Transaction ID:</td>
    <td>{{$transaction_id}}</td>
  </tr>
  <tr>
    <td>Invoice ID:</td>
    <td><a href="{{$invoicr_url}}">{{$invoice_id}}</a></td>
  </tr>

</table>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">
                              <a href="{{$invoicr_url}}" target="_blank">Click here to Log in and Print this Invoice</a>


</p>
                            <p>@include('admin.Emailtemplates.footer') </p>
