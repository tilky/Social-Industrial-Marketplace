@include('admin.Emailtemplates.header')





<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$name}},</h3>



<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">A supplier has just posted a product on the Indy John Market that matches your previous buy request. We’re sending this to you just in case you haven’t decided on a supplier and need more options.

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;"><strong>Listing Details: 

</strong>

<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" > Here are their details:

  <tr>

    <td width="123">Listing Title: </td>

    <td width="449">{{$title}} </td>

  </tr>

  <tr>

    <td>Category: </td>

    <td>{{$product_categories}}</td>

  </tr>

  <tr>

    <td>Industry:</td>

    <td>{{$product_industries}} </td>

  </tr>



</table>

		

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;"><strong>Seller Details: 

</strong>

<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >

                              Here are their details:

                              <tr>

                                <td width="123">Seller Name</td>

                                <td width="449">{{$supplier_name}} </td>

                              </tr>

                              <tr>

                                <td>Seller Profile URL</td>

                                <td>{{$seller_profile_link}} </td>

                              </tr>
                              
                              <tr>

                                <td>view more detail</td>

                                <td>{{$product_link}} </td>

                              </tr>

</table>



<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Log in to Indy John to view more details. </p>



						   

@include('admin.Emailtemplates.footer')

