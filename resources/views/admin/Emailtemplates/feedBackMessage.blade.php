
@include('admin.Emailtemplates.header')


<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello  Indy John Team,</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;"> Someone has left us feedback: 

</p>
<table width="582" height="101" border="0" style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;" >
  <tr>
    <td width="120">Sender:</td>
    <td width="649">{{$sender_name}}</td>
  </tr>
  <tr>
    <td>Subject:</td>
    <td>{{$subject}}</td>
  </tr>
  <tr>
    <td>Feedback:</td>
    <td>{{$custome_message}}</td>
  </tr>
 
</table>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">&nbsp;</p>

@include('admin.Emailtemplates.footer')

