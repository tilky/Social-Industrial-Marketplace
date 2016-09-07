@include('admin.Emailtemplates.header')



<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Hello {{$name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">


Unfortunately, we were unable to process your payment. 
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Log in and update your payment details so that we can try again. 
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;"><strong>Your Subscription Details:
</strong>
<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="169">Subscription Plan:</td>
    <td width="403"><strong>{{$plan}}</strong></td>
  </tr>
  <tr>
    <td>Date Due:</td>
    <td>{{$date}}</td>
  </tr>
  <tr>
    <td>Amount: </td>
    <td>{{$fees}}</td>
  </tr>
  <tr>
    <td>Invoice ID: </td>
    <td>{{$invoice_id}}</td>
  </tr>
</table>


<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

     <a href="{{url()}}/account-cards" target="_blank">Click here to Log In and Update your Payment Details.</a>


</p>
@include('admin.Emailtemplates.footer')   </p>
