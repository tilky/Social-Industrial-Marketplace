@include('admin.Emailtemplates.header')


<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>



                           <p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">
							A Supplier has submitted a quote for your Buy Request with the following details:
                        
                        <table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="123"> Supplier Name:</td>
    <td width="449">{{$supplier_name}} </td>
  </tr>
  <tr>
    <td>Supplier E-mail:</td>
    <td>{{$supplier_email}} </td>
  </tr>
  <tr>
    <td>Profile Page:</td>
    <td> {{$profile_link}} </td>
  </tr>
</table>
                        <p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;"><a href="{{$quote_url}}">Log in to view the Full Quote Details</a></p>
				  
@include('admin.Emailtemplates.footer')
                            </p>
