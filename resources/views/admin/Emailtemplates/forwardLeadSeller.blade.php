@include('admin.Emailtemplates.header')

<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello {{$forward_to_name}},</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">
{{$sender_name}} finds you as a good match for a Buy Request, and has forwarded you a potential lead.<br />

                            <b><br />Lead details :</b>
							
<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="141">Product/Category:</td>
    <td width="431">{{$product_category}}</td>
  </tr>
   <tr>
    <td>Submission Date:</td>
    <td> {{$date_submitted}}</td>
  </tr>
                        <tr>
    <td>Submitted by:</td>
    <td> {{$person_name}}</td>
  </tr>
                          <tr>
    <td>Category selected:</td>
    <td> {{$categories}}</td>
  </tr>
                         <tr>
    <td>Industry Selection:</td>
    <td>{{$indutries}}</td>
  </tr>
</table>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">If you are new to Indy John, please visit and <a href="http://indyjohn.com">Sign up for Indy John</a>. It's free to receive new leads!
  
</p>
						 
@include('admin.Emailtemplates.footer')
