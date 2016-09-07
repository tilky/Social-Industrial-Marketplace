
@include('admin.Emailtemplates.header')


<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">




                          
                            Your product is now listed in the Indy John Market.
                            Here are it's details: <BR />

<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="123">Product Title:</td>
    <td width="449">{{$product_title}}</td>
  </tr>
  
  <tr>
    <td>Product Link: </td>
    <td><a href="{{$link}}">{{$link}} </a></td>
  </tr>
</table>

           <p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Have any questions?  Contact the <a href="mailto:support@indyjohn.com">Support Team.</a></p>
						   
@include('admin.Emailtemplates.footer')
						   
