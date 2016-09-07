



@include('admin.Emailtemplates.header')





<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>



<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">



                            Your Product listing, {{$title}} has received the following inquiry:

                            <br />

</p>

<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >

  <tr>

    <td width="123">Name:</td>

    <td width="449">{{$buyer_name}}</td>

  </tr>

  <tr>

    <td>Phone Number: </td>

    <td>{{$buyer_phone}}</td>

  </tr>

  <tr>

    <td>Message: </td>

    <td>{{$custom_message}}</td>

  </tr>

</table>

<br>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">  

Sign in to your<a href="http://app.indyjohn.com"> Indy John account</a> to read the full message, view their profile and any additional information concerning this lead. </p>



@include('admin.Emailtemplates.footer')

