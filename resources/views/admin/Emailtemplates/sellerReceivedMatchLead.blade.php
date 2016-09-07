@include('admin.Emailtemplates.header')



<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Hello {{$name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Good News from<a href="http://indyjohn.com"> Indy John</a>! We have matched you with a new Buy Request that fits your product offering. </p>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Here are the Buy Request details: </p>


<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="123">Product Type:</td>
    <td width="449">{{$product_type}}</td>
  </tr>
  <tr>
    <td>Industry: </td>
    <td>{{$industries}}</td>
  </tr>
  <tr>
    <td>Name:</td>
    <td>{{$buyer_name}}</td>
  </tr>
   <tr>
    <td>Indy John profile:</td>
    <td>{{$buyer_profile_link}}</td>
  </tr>
</table>



                      <p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;"><a href="{{url()}}/request-product-quotes">Sign in to your Indy John</a> account to learn more details. </p>

@include('admin.Emailtemplates.footer')

                
