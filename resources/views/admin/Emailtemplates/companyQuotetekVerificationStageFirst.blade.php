@include('admin.Emailtemplates.header')



<h3 style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 2em; font-weight: normal; margin: 0 auto 10px; padding: 0;">

Hello {{$company_name}} Administrator,</h3>

<p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6em; font-weight: normal; margin: 0 auto 10px; padding: 0;">


Thank you for your interest in getting your Company page Verified on Indy John.
 <br /> <br />
Please allow 7-10 days for application process. We will contact you if any more information is needed. 
 <br />
 <br /> 
                           <strong>Transaction Details: </strong><br />    Account Name: {{$account_name}}
                         <br />    Transaction ID: {{$transaction_id}}
                         <br />    Date: {{$date}}
                         <br />    Invoice ID: {{$invoice_id}}
                            </p>
@include('admin.Emailtemplates.footer')
