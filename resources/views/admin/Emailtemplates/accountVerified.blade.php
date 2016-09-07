@include('admin.Emailtemplates.header')



<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Hello {{$name}}</h3>



<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">


                        
                            Thank you for your patience. Indy John team has processed your verification application.
                            Your account has now been verified.
                            <br />
                            <br>
  Account Details: <br />
                            <strong>Account Name:</strong> {{$account_name}} <br />
<strong>Transaction ID:</strong> {{$transaction_id}} </p>
<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Log in to <a href="http://indyjohn.com">Indy John</a> to view verification invoice and transaction details.			 
</p>
@include('admin.Emailtemplates.footer')
