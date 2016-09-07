@extends('buyer.app')

@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url()}}/user-dashboard">Home</a> </li>
    <li> <a href="{{url()}}/supporttickets">Support Tickets</a> </li>
    <li> <span>View</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom hide_print">
      <div class="row">
        <h3 class="page-title uppercase"> <i class="fa fa-question-circle"></i>  Frequently Asked Questions </h3>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="faq-content-container">
      <div class="faq-content-container">
    <div class="col-md-12">
    <div class="row">
      <div class="col-md-6">
        <div class="faq-section ">
          <h2 class="faq-title uppercase ">Indy John Basics <small class="expand-all">(expand all)</small></h2>
          <div class="collapse in panel-group accordion faq-content" id="accordion1">
           
           
           <div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1"> What Is Indy John?
</a></h4></div><div id="collapse_1" class="panel-collapse collapse"><div class="panel-body"><p> 
Indy John is a social marketplace built for Industrial Buyers and Suppliers. Our platform offers a more efficient way for Industrial people to Buy, Casually Shop and Sell industrial items and services. </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_2"> What is the Quote-Lead System?
</a></h4></div><div id="collapse_2" class="panel-collapse collapse"><div class="panel-body"><p> 
This Indy John feature matches and connects Buyers and Suppliers based on Product-Category keywords, resulting in Pricing Options for Buyers and Increased Selling Opportunities for Suppliers.  We've also thrown in a Buyer Dashboard and Supplier CRM for users, designed to better manage all new Quote-Lead system activity.  See Quote-Lead System - FAQ to learn more.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_3"> How does Indy John work?
</a></h4></div><div id="collapse_3" class="panel-collapse collapse"><div class="panel-body"><p> 
Indy John is easy to use! Whether you're a Buyer or Supplier, or both, create a free account and choose how you want to start using your account. Once you completed the quick sign up process, all users are given a Buyer Dashboard for Purchasing and a Supplier CRM for Supplying. Feel free to use one or both of these features.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_4"> Who can benefit from using Indy John?
</a></h4></div><div id="collapse_4" class="panel-collapse collapse"><div class="panel-body"><p> 
Any Individual or Team looking to increase productivity and organize their Industrial Purchasing and/or Supplying processes.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_5"> What type of items can Indy John help me Buy or Sell?
</a></h4></div><div id="collapse_5" class="panel-collapse collapse"><div class="panel-body"><p> 
We can help you Buy or Sell most items containing technical specifications or physical dimensions.  Our list of products, supplies, consumables and services is extensive and searchable throughout our site.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_6"> Why should I sign up with Indy John?
</a></h4></div><div id="collapse_6" class="panel-collapse collapse"><div class="panel-body"><p> 
We are the only social marketplace focused on the Industrial Buy-Sell experience and we're going to continue introducing new marketing technologies designed to benefit our users.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_7"> How do I start using Indy John?
</a></h4></div><div id="collapse_7" class="panel-collapse collapse"><div class="panel-body"><p> 
No workday is the same, so we've installed a Quick-Start button in your Dashboard-CRM to assist you with work options.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_8"> Does Indy John manage payments between Buyers and Suppliers?
</a></h4></div><div id="collapse_8" class="panel-collapse collapse"><div class="panel-body"><p> 
At this time, Indy John chooses not to manage payments for transactions. We're here to make meaningful and productive connections amongst our users.  However, upon completing transactions, we encourage you to evaluate and leave a user review.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_9"> Can I use Indy John solely for networking and connecting purposes?
</a></h4></div><div id="collapse_9" class="panel-collapse collapse"><div class="panel-body"><p> 
No problem, we'd hope you make us your source to Buy-Sell Industrial but feel free to grow your network using our service.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_10"> How do I gain trust of other users on Indy John?
</a></h4></div><div id="collapse_10" class="panel-collapse collapse"><div class="panel-body"><p> 
We encourage all users to establish their account and become a verified user.  This is one way to ensure you're doing a trustworthy business deal.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_11"> What can Indy John's Search Discovery help me find?
</a></h4></div><div id="collapse_11" class="panel-collapse collapse"><div class="panel-body"><p> 
Our Search Discovery can help you in many ways.  We can help you find Products, People, Companies, and Service Providers.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_12"> What do Indy John's number codes stand for?
</a></h4></div><div id="collapse_12" class="panel-collapse collapse"><div class="panel-body"><p> 
 <ul>
                    <li>IJB - Indy John Buy-Request </li>
                    <li> IJQ - Indy John Quote</li>
                    <li> IJI - Indy John Item</li>
                    <li> IJU - Indy John User</li>
                    <li> IJJ - Indy John Job</li>
                    <li> IJV - Indy John Invoice</li>
                    <li> IJM - Indy John Market Listing</li>
                    <li> IJC - Indy John Company I.D.</li>
                  </ul>                                                 </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_13"> Is there a Mobile Application for Indy John?
</a></h4></div><div id="collapse_13" class="panel-collapse collapse"><div class="panel-body"><p> 
No, our mobile application is coming soon.  However, IndyJohn.com is a mobile compatible website.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_14"> Is there a Buy-Sell option for companies or groups?
</a></h4></div><div id="collapse_14" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes, we call this option Quote-Lead Teams and it's located in every user's Buyer Dashboard-CRM.  Every user has the ability to start and manage a purchasing or supplying team.  Visit our Quote-Lead Teams FAQ section to learn more.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_15"> Does Indy John offer a solution for Procurement?
</a></h4></div><div id="collapse_15" class="panel-collapse collapse"><div class="panel-body"><p> 
Indy John is an extension of a procurement team; allow us to be your Industrial Pricing tool.  A more advanced Buyer Account is coming soon.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_16"> What is an Indy John Company Page listing?
</a></h4></div><div id="collapse_16" class="panel-collapse collapse"><div class="panel-body"><p> 
It's a listing we showcase inside our Industrial marketplace.  Once your Company Page is created, your listing can be searched and discovered by people looking for your specific company or keywords associated with your Industrial offering.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_17"> How do I start or manage a Company Page listing?
</a></h4></div><div id="collapse_17" class="panel-collapse collapse"><div class="panel-body"><p> 
You can start or join a Company Page listing inside your Dashboard-CRM.  Start by searching and claiming existing Company Page listings - If you're authorized to be an administrator?  Provide us some brief details about your company and we'll add a Company Administrator section to your Dashboard-CRM.  For those who are not authorized to be administrator, you can start the Company Page listing process but will need to recommend an administrator by providing a name and email.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_18"> Can my company Partner or Advertise with Indy John?
</a></h4></div><div id="collapse_18" class="panel-collapse collapse"><div class="panel-body"><p> 
Let's talk, were currently looking for strategic partnerships and limited advertising is now available.  Please visit our Marketing Solutions page for details.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_19"> How do I contact Indy John for user help or to report a problem?
</a></h4></div><div id="collapse_19" class="panel-collapse collapse"><div class="panel-body"><p> 
Create a support ticket inside your Dashboard-CRM or visit our Contact Us page and message us, we'll aim to address all issues in a timely manner.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_20"> How do I stop using Indy John?
</a></h4></div><div id="collapse_20" class="panel-collapse collapse"><div class="panel-body"><p> 
Indy John provides an At-Will service, simply stop using Indy John but we hope you'd reconsider us.                                                    </p></div></div></div> 

           
           
          </div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="faq-section ">
          <h2 class="faq-title uppercase ">User Accounts <small class="expand-all">(expand all)</small></h2>
          <div class="collapse in panel-group accordion faq-content" id="accordion2">
     
     <div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_21"> Does Indy John really offer a free account?
</a></h4></div><div id="collapse_21" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes, our core marketplace is free to use and most features are included in the free account.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_22"> Which Buy-Sell features are available to me with a free account?
</a></h4></div><div id="collapse_22" class="panel-collapse collapse"><div class="panel-body"><p> 
All features are available to use but limited in some capacity.  Compare our Buyer and Supplier user accounts and decide which best fits your needs.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_23"> Why should I verify my account?
</a></h4></div><div id="collapse_23" class="panel-collapse collapse"><div class="panel-body"><p> 
We encourage all users to establish their account and become a verified user.  This is one way to ensure you're doing a trustworthy business deal.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_24"> How do I verify my account?
</a></h4></div><div id="collapse_24" class="panel-collapse collapse"><div class="panel-body"><p> 
Verification is a simple process done by verifying two forms of identification. Upon completion, a verified seal will be attached to your account and displayed when you connect with other users.  For free members, we charge a small fee for this verification as it includes a comprehensive background check. For upgraded members, verification fee is waived.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_25"> Why should I upgrade my Buyer Account to Buyer+?
</a></h4></div><div id="collapse_25" class="panel-collapse collapse"><div class="panel-body"><p> 
We offer a Buyer+ account for more serious buyers looking to gain faster pricing options and do more with our Indy John Market.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_26"> Does Indy John offer a solution for Procurement?
</a></h4></div><div id="collapse_26" class="panel-collapse collapse"><div class="panel-body"><p> 
Indy John is an extension of a procurement team; allow us to be your Industrial Pricing tool.  A more advanced Buyer Account is coming soon.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_27"> Should I upgrade my Supplier Account status to Silver or Gold?
</a></h4></div><div id="collapse_27" class="panel-collapse collapse"><div class="panel-body"><p> 
We recommend Silver and Gold Accounts for users with higher sales and marketing goals.  Users can also increase selling opportunities in our Indy John Market being a valued member, compare valued accounts to learn more.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_28"> How do I upgrade my user account?
</a></h4></div><div id="collapse_28" class="panel-collapse collapse"><div class="panel-body"><p> 
Every Buyer Dashboard and Supplier CRM has an UPGRADE icon, simply click and select the account that works best for you.  Provide us billing details and continue using Indy John with additional advantages.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_29"> How does a Valued Account pricing compare to competitors?
</a></h4></div><div id="collapse_29" class="panel-collapse collapse"><div class="panel-body"><p> 
We don't have a direct competitor but there are plenty of expensive companies who charge high fees for networking only or cold calling lists.  No company today is doing what Indy John can do for you!                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_30"> Can I use both Buyer Dashboard and Supplier CRM?
</a></h4></div><div id="collapse_30" class="panel-collapse collapse"><div class="panel-body"><p> 
We understand Suppliers may purchase items and Buyers sometimes sell products, feel free to be a dual-user and toggle back and forth between Buying and Selling features.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_31"> How does Indy John secure its members' account information?
</a></h4></div><div id="collapse_31" class="panel-collapse collapse"><div class="panel-body"><p> 
We understand malicious activity is a constant issue. While there is no security measure that is completely impenetrable, Indy John will continue to be proactive in this department and use modern security measures to help protect against malicious actions on your personal information.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_32"> Do assigned Buy Requests and Lead Requests count against my individual account?
</a></h4></div><div id="collapse_32" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes, when Team Managers assign Buy or Lead Requests, they do count towards your individual account terms.                                                    </p></div></div></div> 

     
     
          </div>
        </div>
        </div>
        </div>
        </div>
        <div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
        <div class="faq-section ">
          <h2 class="faq-title uppercase ">Quote-Lead System <small class="expand-all">(expand all)</small></h2>
          <div class="collapse in panel-group accordion faq-content" id="accordion3">
           
           <div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_33"> What is the Quote-Lead System?
</a></h4></div><div id="collapse_33" class="panel-collapse collapse"><div class="panel-body"><p> 
Our system is a more efficient way for Industrial people to Buy and Sell items and services.  We match and connect Buyers and Suppliers based on Product-Category keywords, resulting in pricing options for Buyers and increased selling opportunities for Suppliers.  We've also thrown in a Buyer Dashboard and Supplier CRM for users, designed to better manage all new Quote-Lead system activity.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_34"> What type of items can Indy John help me Buy or Sell?
</a></h4></div><div id="collapse_34" class="panel-collapse collapse"><div class="panel-body"><p> 
We can help you Buy or Sell most items containing technical specifications or physical dimensions.  Our list of products, supplies, consumables and services is extensive and searchable throughout our site.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_35"> As a Buyer, how does the Quote-Lead system work?
</a></h4></div><div id="collapse_35" class="panel-collapse collapse"><div class="panel-body"><p> 
Submit one Buy Request into our system and based on the product-category or service needs, we'll match you with a network of Indy John Suppliers. Then sit back and prepare to compare quotes and get the price you want.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_36"> What is a Buy Request and how does it work?
</a></h4></div><div id="collapse_36" class="panel-collapse collapse"><div class="panel-body"><p> 
A Buy Request allows users to receive comparable pricing options and find suppliers with one submission.  Indy John will match and connect you with suppliers based on product-category keywords.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_37"> Why should I make Indy-John my place for purchasing Industrial products and services?
</a></h4></div><div id="collapse_37" class="panel-collapse collapse"><div class="panel-body"><p> 
Indy John is a money-saver! Industrial items and services are specialized desirables with a wide price range, we can help you receive pricing options and we'll also throw in a dashboard to help you organize all your purchases.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_38"> Does Indy John offer a solution for Procurement?
</a></h4></div><div id="collapse_38" class="panel-collapse collapse"><div class="panel-body"><p> 
Indy John is an extension of a procurement team; allow us to be your Industrial Pricing tool.  A more advanced Buyer Account is coming soon.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_39"> As a Supplier, how does the Quote-Lead system work?
</a></h4></div><div id="collapse_39" class="panel-collapse collapse"><div class="panel-body"><p> 
Inside your Indy John CRM, create individual Lead Requests for your product offering and we'll match you with new incoming Buy Requests. Then simply, respond to your Buy Requests using our built-in quote template.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_40"> What is a Lead Request and how does it work?
</a></h4></div><div id="collapse_40" class="panel-collapse collapse"><div class="panel-body"><p> 
A Lead Request allows users to meet new buyers and increase selling opportunities with one creation.  Create individual Lead Requests and Indy John will match and connect you with incoming Buy Requests based on product-category keywords.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_41"> Why is this system a better alternative to existing selling methods?
</a></h4></div><div id="collapse_41" class="panel-collapse collapse"><div class="panel-body"><p> 
Our system is exactly the opposite of Cold Calling prospects and knocking on doors.  Simply create Lead Requests and we'll bring the Sales Leads to you.  Our system has virtually eliminated the "pursuit" and rewarded you with the "catch"!                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_42"> Is there a Buy-Sell option for companies or groups?
</a></h4></div><div id="collapse_42" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes, we call this option Quote-Lead Teams and it's located in every user's Buyer Dashboard-CRM.  Every user has the ability to start and manage a purchasing or supplying team.  Visit our Quote-Lead Teams FAQ section to learn more.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_43"> Can I use both Buyer Dashboard and Supplier CRM features?
</a></h4></div><div id="collapse_43" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes, we understand most Indy John users will use both Buy-Sell features.  Once you're signed up, feel free to jump back and forth between Buying and Selling.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_44"> Does Indy John manage payments between Buyers and Suppliers?
</a></h4></div><div id="collapse_44" class="panel-collapse collapse"><div class="panel-body"><p> 
At this time, Indy John chooses not to manage payments for transactions. We're simply here to make meaningful and productive connections amongst our users.  However, upon completing transactions, we encourage you to evaluate and leave a user review.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_45"> How can I maximize Buying and Selling opportunities with the Quote-Lead system?
</a></h4></div><div id="collapse_45" class="panel-collapse collapse"><div class="panel-body"><p> 
Compare our valued account and decide which one works best for your professional needs.  Check out our FAQ-User Accounts section to learn more.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_46"> Can my company pay for my Indy John monthly membership?
</a></h4></div><div id="collapse_46" class="panel-collapse collapse"><div class="panel-body"><p> 
Sure, if your part of a Team, this can be done in your Team Billing Section inside your dashboard.  For Individual accounts, that is solely decided by your company.                                                    </p></div></div></div> 

           
           
           
          </div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="faq-section ">
          <h2 class="faq-title uppercase ">Quote-Lead Teams <small class="expand-all" >(expand all)</small></h2>
          <div class="collapse in panel-group accordion faq-content" id="accordion4">
           
           
           <div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_47"> What is Quote-Lead Teams?
</a></h4></div><div id="collapse_47" class="panel-collapse collapse"><div class="panel-body"><p> 
This Indy John feature is an extension of our Quote-Lead System - it works exactly the same way but allows for team purchasing and team supplying.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_48"> Who can start a team?
</a></h4></div><div id="collapse_48" class="panel-collapse collapse"><div class="panel-body"><p> 
All users may start and manage a Quote-Lead Team.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_49"> Do assigned Buy Requests and Lead Requests count against my individual account?
</a></h4></div><div id="collapse_49" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes, when Team Managers assign Buy or Lead Requests, they do count towards your individual account terms.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_50"> How do I Start and Manage a purchasing or supplying team?
</a></h4></div><div id="collapse_50" class="panel-collapse collapse"><div class="panel-body"><p> 
This can easily be done inside your Buyer Dashboard or Supplier CRM - Provide us some quick details, add or invite team members and start working as a team.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_51"> What is my role as purchasing team manager?
</a></h4></div><div id="collapse_51" class="panel-collapse collapse"><div class="panel-body"><p> 
Team Managers create or assign Buy Requests, oversee quotes, manage team members and control all team data and details.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_52"> What is my role as supplying team manager?
</a></h4></div><div id="collapse_52" class="panel-collapse collapse"><div class="panel-body"><p> 
Team Managers create Lead Requests, assign incoming leads, manage team members, and control all team data and details.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_53"> How do I become a team member?
</a></h4></div><div id="collapse_53" class="panel-collapse collapse"><div class="panel-body"><p> 
Team Managers can invite or add any Indy John user to join their team - this can also be done manually by Team Managers.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_54"> Can I start or join multiple teams?
</a></h4></div><div id="collapse_54" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_55"> Can I transfer Team Manager status?
</a></h4></div><div id="collapse_55" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes, this is easily done in your Buyer Dashboard or CRM.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_56"> Can I remove myself from a team?
</a></h4></div><div id="collapse_56" class="panel-collapse collapse"><div class="panel-body"><p> 
Indy John doesn't control team details; the relationship is strictly between you and the team manager.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_57"> Can my company pay for my Indy John monthly membership?
</a></h4></div><div id="collapse_57" class="panel-collapse collapse"><div class="panel-body"><p> 
Sure, if your part of a Team, this can be done in your Team Billing Section inside your dashboard.                                                    </p></div></div></div> 

           
           
           
          </div>
        </div>
        </div>
        </div>
        </div>
        <div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
        <div class="faq-section ">
          <h2 class="faq-title uppercase ">Indy John Market <small class="expand-all">(expand all)</small></h2>
          <div class="collapse in panel-group accordion faq-content" id="accordion5">
            
            
            
            
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_58"> What is the Indy John Market?
</a></h4></div><div id="collapse_58" class="panel-collapse collapse"><div class="panel-body"><p> 
Indy John Market is a brand new Industrial-Only market.  All users can Purchase, Sell, or casually shop for products and supplies.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_59"> Does Indy John manage payments between Buyers and Suppliers?
</a></h4></div><div id="collapse_59" class="panel-collapse collapse"><div class="panel-body"><p> 
At this time, Indy John chooses not to manage payments for transactions. We're simply here to make meaningful and productive connections amongst our users.  However, upon completing transactions, we encourage you to evaluate and leave a user review.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_60"> What type of items can I find in the Indy John Market?
</a></h4></div><div id="collapse_60" class="panel-collapse collapse"><div class="panel-body"><p> 
Give us time to build up supplier inventory, but once it's at full capacity you'll be able to find Industrial equipment, instrumentation, tools, supplies, consumables and much more.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_61"> How do I List items in the Indy John Market?
</a></h4></div><div id="collapse_61" class="panel-collapse collapse"><div class="panel-body"><p> 
Located in the Indy John Dashboard-CRM, all users have an Indy John Market area with a few action tasks available for use. Search and Post items directly from your Dashboard-CRM.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_62"> Can anyone post items on the Indy John Market?
</a></h4></div><div id="collapse_62" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes! .. Indy John Market is free to use for all users.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_63"> How much does it cost to post items?
</a></h4></div><div id="collapse_63" class="panel-collapse collapse"><div class="panel-body"><p> 
Casual Buying and Selling can be done with our free account.  Looking to do more? Explore becoming a valued member.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_64"> How many items can I post in Indy John Market?
</a></h4></div><div id="collapse_64" class="panel-collapse collapse"><div class="panel-body"><p> 
Free account users can post up to 30 items per month.  Do you want to post more than 30 items? Please explore becoming an Indy John valued member.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_65"> When does my market listing expire?
</a></h4></div><div id="collapse_65" class="panel-collapse collapse"><div class="panel-body"><p> 
Valued member listings will appear in the market until listing is manually removed. For our free users, we have a 30 day listing expiry date.                                                    </p></div></div></div> 

            
            
          </div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="faq-section ">
          <h2 class="faq-title uppercase ">Indy John Job Board <small class="expand-all">(expand all)</small></h2>
          <div class="collapse in panel-group accordion faq-content" id="accordion6">
            
            <div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_66"> What is the Indy John Job Board?
</a></h4></div><div id="collapse_66" class="panel-collapse collapse"><div class="panel-body"><p> 
Were focused on building a great industrial marketplace for our users but we also want to add helpful resources for our users. So, were introducing a brand new Job Board focused on Industrial jobs. All users can Explore, Search, and Post Industrial jobs.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_67"> How do I get started using the Job Board?
</a></h4></div><div id="collapse_67" class="panel-collapse collapse"><div class="panel-body"><p> 
You'll find a Job Center menu in each user Dashboard-CRM. Posting and Searching jobs can be initiated from there, also look for our green Indy John tab located throughout our site to begin job actions.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_68"> As a Job Seeker, why should I use Indy John to search jobs?
</a></h4></div><div id="collapse_68" class="panel-collapse collapse"><div class="panel-body"><p> 
We're dedicated to Industrial jobs and nothing else!  When our new job board is at full capacity, you'll be able to Search and quickly Apply for specific positions or skillsets desired by potential employers. Plus, you'll be able to manage all applying data in your free user dashboard.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_69"> As an Employer, why is Indy John the right place to post my job openings?
</a></h4></div><div id="collapse_69" class="panel-collapse collapse"><div class="panel-body"><p> 
Our system matches Employers with Applicants based on specific Industrial expertise and skillsets.  You'll have the ability to recruit and decide between worthy industrial-minded applicants. We'll also allow you to manage all this new applicant data in our Job Center.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_70"> Why is this Job Board different from other job posting sites?
</a></h4></div><div id="collapse_70" class="panel-collapse collapse"><div class="panel-body"><p> 
We're dedicated to Industrial employment opportunities and we're a lot cheaper than other professional and technical job sites! Your company job posting would also be available and displayed to a large Industrial audience.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_71"> How much does it cost to use the Job Board?
</a></h4></div><div id="collapse_71" class="panel-collapse collapse"><div class="panel-body"><p> 
Free to search and apply for jobs.  To post a job - we charge $30.00 for a 30 day listing.              </br>                 * Our Valued Accounts include job credits, 1 Credit = 1 Job posting                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_72"> When does my job listing expire?
</a></h4></div><div id="collapse_72" class="panel-collapse collapse"><div class="panel-body"><p> 
Valued member job credit listings will appear in the market until job posting is manually removed. Free users that posted with job listing fee, those listings will expire after 30 days.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_73"> Where do I manage all job data?
</a></h4></div><div id="collapse_73" class="panel-collapse collapse"><div class="panel-body"><p> 
It's easy, all job details and applicant management can be done in your user dashboard.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_74"> Is there a solution for Company Administrators?
</a></h4></div><div id="collapse_74" class="panel-collapse collapse"><div class="panel-body"><p> 
No, all users can post and manage employment opportunities and candidates inside their Dashboard-CRM.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title"></h4>

            
            
            
          </div>
        </div>
        </div>
        </div>
        </div>
      </div>
   </div>
       <div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
        <div class="faq-section ">
          <h2 class="faq-title uppercase ">Social <small class="expand-all">(expand all)</small></h2>
          <div class="collapse in panel-group accordion faq-content" id="accordion7">
          
           <div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_75"> Can I use Indy John solely for networking and connecting purposes?
</a></h4></div><div id="collapse_75" class="panel-collapse collapse"><div class="panel-body"><p> 
No problem, we'd hope you make us your source to Buy-Sell Industrial but feel free to grow your network using our service.                                                    </p></div></div></div> 

<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_76"> Can I Endorse and Review other Indy John users?
</a></h4></div><div id="collapse_76" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes, we encourage all users to endorse and review.  This will help us build a better network of valuable users.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_77"> Can I screen my reviews before they appear on my profile?
</a></h4></div><div id="collapse_77" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes, this is done inside your Dashboard-CRM.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_78"> How do I invite friends and associates to Indy John?
</a></h4></div><div id="collapse_78" class="panel-collapse collapse"><div class="panel-body"><p> 
An upgrade icon is installed in every Dashboard-CRM, choose what invite method you want to use and begin compiling a list of referring earning opportunities.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_79"> Can I Direct-Message other Indy John users?
</a></h4></div><div id="collapse_79" class="panel-collapse collapse"><div class="panel-body"><p> 
Yes, all messaging activity is organized inside your Dashboard-CRM.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_80"> How do I sign up for the Referral Program?
</a></h4></div><div id="collapse_80" class="panel-collapse collapse"><div class="panel-body"><p> 
It's easy.  Once you're signed up with Indy John, we'll generate you a referral code to pass along or you can simply share your Indy John profile link with friends and associates.  When your referrals decide to become a valued member, you start earning payouts.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_81"> How much can I earn by referring others?
</a></h4></div><div id="collapse_81" class="panel-collapse collapse"><div class="panel-body"><p> 
You can earn up to $100 per paid account that you refer. If they sign up, but choose a free account, our system will make a record and your referral bonus will be paid when they become a paying customer.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_82"> How do I manage my referrals and payouts?
</a></h4></div><div id="collapse_82" class="panel-collapse collapse"><div class="panel-body"><p> 
This is easily done inside your Dashboard-CRM. Each Dashboard-CRM has a Referral Program menu with details on how to manage your referrals and payouts.                                                    </p></div></div></div> 
<div class="panel panel-default"> <div class="panel-heading"> <h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_83"> How fast will I receive my referral payouts?
</a></h4></div><div id="collapse_83" class="panel-collapse collapse"><div class="panel-body"><p> 
Referral payouts will be made up to 45 days from time your candidate's first valued account payment.  All payout data will be managed inside your Dashboard-CRM.                                                    </p></div></div></div> 

            
          </div>
        </div>
        </div>
        </div>
        </div>
    </div>
  </div>
</div>
<script>
	$(document).on('click', "small.expand-all", function() {
	$(this).addClass('expand-open');
	$(this).removeClass('expand-all');
	$(this).parent().parent().find('.accordion-toggle').removeClass('collapsed');
	$(this).parent().parent().find('.panel-collapse').addClass('in');
	$(this).parent().parent().find('.panel-collapse').css("height", "auto");;
});

	$(document).on('click', "small.expand-open", function() {
	$(this).removeClass('expand-open');
	$(this).addClass('expand-all');
	$(this).parent().parent().find('.accordion-toggle').addClass('collapsed');
	$(this).parent().parent().find('.panel-collapse').removeClass('in');
});

</script>
<script>

/* for show menu active */
$("#support-tickets-main-menu").addClass("active");
$('#support-tickets-main-menu' ).click();
$('#support-tickets-menu-arrow').addClass('open')
$('#support-ticket-faq-menu').addClass('active');
/* end menu active */
</script>
@endsection

