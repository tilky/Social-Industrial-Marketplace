

@include('admin.Emailtemplates.header')





<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Hello, %Recepient%</h3>





  <p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

 

 %SenderFirstName%  %SenderLastName% has shared an Indy John link with you. 

  <br />  <br />

{{$share_link}}   

<br /><br />

{{$custom_message}} <br>

- {{$SenderFirstName}}  {{$SenderLastName}}

</p>



@include('admin.Emailtemplates.footer')



