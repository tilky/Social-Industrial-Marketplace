<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/home', 'HomeController@index');

Route::get('/', 'HomeController@viewHome');
Route::get('/homepage/quote', 'HomeController@quoteHome');
Route::post('/requestquote/save','HomeController@quoteSave');
Route::get('/homepage/login', 'HomeController@companyView');
Route::post('/singup/first-step/save', 'HomeController@firstStepSingup');
Route::get('/singup/select-industry', 'HomeController@secondStepSingup');
Route::post('/singup/step-two/save', 'HomeController@secondStepSave');
Route::get('/singup/select-about','HomeController@thirdStepSingup');
Route::post('/singup/step-three/save', 'HomeController@thirdStepSave');
Route::get('/singup/select-account','HomeController@fourthStepSingup');
Route::get('/singup/user-type', 'HomeController@secondStepSingup');
Route::get('/select/user-type/{id}', 'HomeController@selectUserType');
Route::get('/singup/company', 'HomeController@selectCompany');
Route::get('/singup/user-picture', 'HomeController@viweUserPicture');
Route::get('/singup/add/company', 'HomeController@addCompany');
Route::get('/singup/company/auth', 'HomeController@viewCompanyAuth');
Route::get('/singup/company/auth/set/{id}', 'HomeController@saveCompanyAuth');
Route::get('/supplier/categpry-industry', 'HomeController@viewSupplierSelect');
Route::post('/company/new/save', 'HomeController@saveNewCompany');
Route::get('/homepage/companySearch', 'HomeController@searchCompanies');
Route::post('/singup/company/save', 'HomeController@saveUserCompany');
Route::get('/homepage/productSearch', 'HomeController@searchProducts');
Route::get('/homepage/categorySearch', 'HomeController@searchCategories');
Route::get('/homepage/industrySearch', 'HomeController@searchIndustries');
Route::get('/marketplace', 'HomeController@marketplaceProducts');
Route::get('/profile-supplier-buyer','HomeController@supplierBuyerProfile');
Route::get('/company-profile','HomeController@companyProfile');
Route::get('/homepage/list-product','HomeController@listProduct');
Route::post('/homepage/listnew/save','HomeController@saveListNewProduct');
Route::get('/homepage/linkedin-button','HomeController@LinkedInLoginUrl');
Route::get('/overview','HomeController@overView');
Route::get('/user-dashboard/linkedin-login','HomeController@LinkedInLogin');
Route::post('/signup/email/verification','HomeController@emailVerificationSend');
Route::get('/verification/link/{code}','HomeController@emailVerificationLink');
Route::get('/email/resend/link','HomeController@emailResendVerificationLink');
// for user,company,product and job external urls
Route::get('/view/company/{external_url}','HomeController@viewCompanyDetail');
Route::get('/view/user/{external_url}','HomeController@viewUserDetail');
Route::get('/view/product/{external_url}','HomeController@viewProductDetail');
Route::get('/view/job/{external_url}','HomeController@viewJobDetail');
Route::get('/quick-demo','HomeController@viewQuickDemo');
Route::get('/indy-grid','HomeController@viewIndyGrid');

// 404 page
Route::get('/page-not-found','HomeController@viewPageNotFound');

// All new route after live zip
Route::get('/supplier-home', 'HomeController@viewSupplierHome');
Route::get('/buyer-features', 'HomeController@viewBuyerFeatures');
Route::get('/supplier-network', 'HomeController@viewSupplierNetwork');
Route::get('/referral-program', 'HomeController@viewReferralProgram');
Route::get('/faq', 'HomeController@viewFaq');
Route::get('/about-us', 'HomeController@viewAboutUs');
Route::get('/news', 'HomeController@viewNews');
Route::get('/investor-outreach', 'HomeController@viewInvestorOutreach');
Route::get('/contact-us', 'HomeController@viewContactUs');
Route::post('/contact-send', 'HomeController@sendContactUs');
Route::get('/industrial-service-provider', 'HomeController@viewIndustrialServiceProvider');
Route::get('/how-it-works', 'HomeController@viewHowItWorks');
Route::get('/marketing-solutions', 'HomeController@viewMarketingSolutions');
Route::get('/advertise-with-us', 'HomeController@viewAdvertiseWithUs');
Route::get('/partner-with-us', 'HomeController@viewPartnerWithUs');
Route::get('/privacy-policy', 'HomeController@viewPrivacyPolicy');
Route::get('/terms', 'HomeController@viewTerms');
Route::get('/students', 'HomeController@viewStudents');
Route::get('industries-list', 'HomeController@industriesList');

Route::get('company/massImport', 'AdminController@viewImportCompanies');
Route::post('importCompanies', 'AdminController@importCompanies');

Route::get('claim-profile/{randomCode}', 'AdminController@claimProfile');
Route::Post('saveResetPassword', 'AdminController@saveResetPassword');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


Route::get('/not-authorized', 'AdminController@notAuthorized');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::post('authenticate/userCheck', 'Auth\AuthController@userDashboard');
//protecting routes of super admin
Route::group(['middleware' => 'App\Http\Middleware\SuperAdminMiddleware'], function()
{
    Route::get('sa',array('middleware' => 'auth', 'uses' => 'AdminController@index'));

    Route::get('viewtickets', 'SupportTicketsController@viewtickets');
    Route::get('ticketsReply', 'SupportTicketsController@ticketsReply');
    Route::post('/supporttickets/comment/save/{id}', 'SupportTicketsController@saveTicketComment');

    Route::resource('industries', 'IndustriesController');
    Route::get('viewIndustries', 'IndustriesController@viewIndustries');
    Route::get('userIndustries', 'IndustriesController@userIndustries');
    Route::get('productIndustries', 'IndustriesController@productIndustries');
    Route::get('quoteIndustries', 'IndustriesController@quoteIndustries');

    Route::get('company/users','CompanyController@companyUsers');
    Route::get('/company/list','CompanyController@companyList');
    Route::get('/company/urls/','CompanyController@companyURLs');

    Route::get('recentlyReferred/users','ReferralsController@recentlyReferred');
    Route::get('referralsURLs','ReferralsController@referralURLs');

    Route::get('quotetekverify/approve/{id}','QuotetekVerificationController@approveVerification');
    Route::get('quotetekverify/disapprove/{id}','QuotetekVerificationController@disapproveVerification');

    Route::resource('tech-service', 'TechServicesController');
    Route::resource('accreditations', 'AccreditationsController');
    Route::resource('quality-standards', 'QualityStandardController');
    Route::resource('shipping-preferences', 'ShippingPreferenceController');
    Route::resource('markets', 'MarketsController');
    Route::resource('diversity', 'DiversityController');
    Route::resource('categories', 'CategoryController');
    Route::get('/viewCategories', 'CategoryController@viewCategories');
    Route::resource('products', 'ProductController');
    Route::get('/viewProducts', 'ProductController@viewProducts');
    Route::get('/cat-tree/{id}', 'CategoryController@getCategoryTree');//API url to get category in js tree format.
    Route::get('/categories/delete/{id}', 'CategoryController@destroy');//API url to get category in js tree format.
    Route::get('/category/massImport', 'CategoryController@massImport');
    Route::post('/category/saveMassImport', 'CategoryController@saveMassImport');
    Route::resource('company-packages', 'CompanyAccountsController');

    Route::resource('emailtemplates', 'EmailTemplatesController');
    Route::get('email/templates/{template_id}','EmailTemplatesController@EmailTemplate');
    Route::get('email/view/{template_id}','EmailTemplatesController@EmailView');

    // referral payout
    Route::get('referral-payout','ReferralsController@referralPayout');
    Route::get('referral-payout/send/{id}','ReferralsController@referralPayoutSend');
    Route::post('referral-payout/save','ReferralsController@referralPayoutSave');

    Route::get('/users/verififcation','QuotetekVerificationController@usersVerifications');
    Route::get('/verififcation/destroy/{type}/{id}','QuotetekVerificationController@verificationDelete');
    Route::get('/verififcation/approve/{type}/{id}','QuotetekVerificationController@verificationApprove');
    Route::get('/verififcation/disapprove/{type}/{id}','QuotetekVerificationController@verificationDisapprove');
    Route::get('/verififcation/view/{type}/{id}','QuotetekVerificationController@verificationView');
    Route::get('/company/verification','QuotetekVerificationController@companyVerifications');

    Route::get('user/wizard','UsersController@checkWizard');

});

Route::resource('feedback', 'FeedbacksController');

/// Company Routes
Route::group(['middleware' => 'App\Http\Middleware\CompanyMiddleWare'], function()
{
    Route::get('company/view','CompanyController@viewCompnay');
    Route::get('company/users','CompanyController@companyUsers');

});

/// Buyer Seller Common Routes
Route::group(['middleware' => 'App\Http\Middleware\BuyerSellerMiddleWare'], function()
{
    //Route::get('user-dashboard',array('middleware' => 'auth', 'uses' => 'AdminController@index'));

    Route::get('/supportticket/faq', 'SupportTicketsController@faqView');

    Route::get('referral-link','ReferralsController@referaalLink');
    Route::get('add/referral-link/{user_id}','ReferralsController@addReferaalLink');
    Route::post('edit/referral-link/save','ReferralsController@saveEditReferaalLink');
    Route::get('referral-link/about-the-program','ReferralsController@viewAboutProgram');
    Route::get('referral/payment-info','ReferralsController@viewReferralPayment');
    Route::get('referral/generate/income','ReferralsController@referralGenerateIncome');

    Route::get('quotetek/user/verification','QuotetekVerificationController@addUserVerififcation');
    Route::post('quotetek/user/vrification/save','QuotetekVerificationController@saveUserVerification');
    Route::get('quotetek/user/vrification/detail','QuotetekVerificationController@viewUserVerififcation');
    Route::get('verify/proof/add/{id}','QuotetekVerificationController@addProof');

    Route::get('/account-cards','AccountController@viewCardDetail');
    Route::post('/add/user/card','AccountController@saveCardDetail');
    Route::post('/update/user/card','AccountController@updateCardDetail');
    Route::post('/delete/user/card','AccountController@deleteCard');

    Route::get('/account/settings','UsersController@userAccountSettings');
    Route::post('/account/defaultsettings/save','UsersController@saveAccountDefaultSettings');

    Route::resource('marketplaceproducts', 'MarketplaceProductsController');
    Route::get('/market/post-your-product', 'MarketplaceProductsController@create');
    Route::get('/marketplace/mylistings', 'MarketplaceProductsController@index');
    Route::get('/marketplaceproducts/info/{id}', 'MarketplaceProductsController@productAdditionalInfo');
    Route::get('/marketplaceproducts/info/categories/{id}', 'MarketplaceProductsController@addProductCategory');
    Route::get('/marketplaceproducts/info/categoriestree/{id}', 'MarketplaceProductsController@getCategoryTree');
    Route::get('/marketplaceproducts/info/category/search', 'MarketplaceProductsController@searchCategories');
    Route::post('/marketplaceproducts/info/categories/save/{id}', 'MarketplaceProductsController@saveProductCategory');
    Route::get('/marketplaceproducts/info/industries/{id}', 'MarketplaceProductsController@addProductIndustries');
    Route::post('/marketplaceproducts/info/industries/save/{id}', 'MarketplaceProductsController@saveProductIndustries');
    Route::get('/marketplaceproducts/info/industry/search', 'MarketplaceProductsController@searchIndustry');
    Route::get('/marketplaceproducts/gallery/{id}', 'MarketplaceProductsController@productGallery');
    Route::get('/marketplaceproducts/gallery/add/{id}', 'MarketplaceProductsController@addImagesToProductGallery');
    Route::post('/marketplaceproducts/upload/file', 'UploadProductImageController@upload');
    Route::post('/marketplaceproduct/default/upload/image', 'UploadProductImageController@uploadMarketplaceDefault');
    Route::get('/market/removeFile/file/{id}', 'UploadProductImageController@remove');
    Route::post('/marketplaceproducts/upload/gallery/file', 'UploadProductImageController@uploadGallery');
    Route::get('/marketplaceproducts/gallery/remove/{id}', 'UploadProductImageController@removeImagesFromGallery');
    Route::get('/marketplaceproducts/product/addOption/{id}', 'MarketplaceProductsController@addNewOption');
    Route::get('/marketplaceproducts/product/inactive/{id}', 'MarketplaceProductsController@incativeProduct');
    Route::get('/marketplaceproducts/product/active/{id}', 'MarketplaceProductsController@activeProduct');
    Route::get('/marketplaceproducts/product/addSubOption/{main_id}/{id}', 'MarketplaceProductsController@addNewSubOption');
    Route::get('/marketplaceproducts/product/defaultsettings', 'MarketplaceProductsController@addDefaultSettings');
    Route::post('/marketplaceproducts/product/defaultsettings/save', 'MarketplaceProductsController@saveDefaultSettings');
    Route::get('/marketplaceproduct/search', 'MarketplaceProductsController@productSearchView');
    Route::get('/marketplaceproduct/search/result', 'MarketplaceProductsController@productSearchResult');
    Route::post('/marketplaceproducts/search/product', 'MarketplaceProductsController@searchMarketplaceProducts');
    Route::get('/marketplaceproduct/front/view/{id}', 'MarketplaceProductsController@marketplaceFrontProductView');
    Route::post('/marketplaceproduct/request_quote', 'MarketplaceProductsController@marketplaceProductRequestQuote');
    Route::get('tech/specification/options','MarketplaceProductsController@techSpecificationOptions');
    Route::post('/message/send/','MarketplaceProductsController@sendMessage');
    Route::post('/member/message/send/','PurchasingTeamController@sendMessage');


    Route::resource('contactusers', 'ContactUsersController');
    Route::post('/contactusers/search/contact', 'ContactUsersController@searchConatcs');
    Route::get('/contactusers/contact/send/{sender_id}/{request_id}', 'ContactUsersController@requestConatcUser');
    Route::get('/contactusers/contact/pandding', 'ContactUsersController@panddingConatcUser');
    Route::get('/contactusers/contact/approve/{id}', 'ContactUsersController@approvePanddingConatcUser');
    Route::get('/google/contact','ContactUsersController@getGoogleContact');
    Route::get('/user-dashboard/google-response','ContactUsersController@viewGoogleContact');
    Route::get('/invite/google-response','ContactUsersController@viewInviteGoogleContact');
    Route::get('/invite/email','ContactUsersController@viewInviteEmailContact');
    Route::post('/invite/email/contact','ContactUsersController@sendEmailInvitation');
    Route::post('/invite/user/contact','ContactUsersController@sendInvitation');
    Route::get('/user-dashboard/msn-response','ContactUsersController@viewMSNContact');
    Route::get('/invite/msn-response','ContactUsersController@viewInviteMSNContact');
    Route::get('/user-dashboard/yahoo-response','ContactUsersController@viewYahooContact');
    Route::get('/invite/yahoo/url','ContactUsersController@getYahooUrl');
    Route::get('/invite/yahoo-response','ContactUsersController@viewInviteYahooContact');
    Route::get('/contact/invite/send/{id}','ContactUsersController@conactInviteSend');
    Route::get('/contact/invite/remove/{id}','ContactUsersController@conactInviteRemove');
    Route::get('/contact/add','ContactUsersController@viewAddContact');
    Route::post('/contact/add/save','ContactUsersController@saveAddContact');
    Route::get('/contact/pending/invite','ContactUsersController@viewContactPendingInvite');
    Route::get('/contact/invite/join','ContactUsersController@viewContactInviteJoin');
    Route::post('/contact/invite/message','ContactUsersController@sendInviteMessage');
    Route::post('/feedback/message','ContactUsersController@sendFeedbackMessage');
    Route::post('/mail/share/link','ContactUsersController@sendShareLink');
    Route::get('/contact/user/pending','ContactUsersController@viewContactUserPending');
    Route::get('/contact/user/saved','ContactUsersController@viewContactUserSaved');
    Route::get('/company/saved','ContactUsersController@viewCompanySaved');
    Route::get('/company/save/remove/{user_id}/{company_id}','ContactUsersController@removeCompanySaved');
    Route::get('/contact/user/awaiting','ContactUsersController@viewContactUserAwaiting');
    Route::get('/contact/user/invited','ContactUsersController@viewContactUserInvited');

    Route::resource('request-product-quotes', 'QuotesController');
    Route::get('/quote/view-buy-requests','QuotesController@viewBuyRequest');
    Route::get('/quote/buy-request/status/{id}','QuotesController@changeStatusViewBuyRequest');
    Route::post('/quote/expirydate/save','QuotesController@saveExtendExpiry');
    Route::post('/quote/note/save','QuotesController@saveQuoteNote');
    Route::get('/getquote/productSearch', 'QuotesController@searchProducts');
    Route::get('/getquote/categorySearch', 'QuotesController@searchCategories');
    Route::get('/getquote/industrySearch', 'QuotesController@searchIndustries');
    Route::get('/supplier/quote/ignore/{supplier_id}/{quote_id}', 'QuotesController@supplierQuoteIgnore');
    Route::get('/cron/matchlead','QuotesController@matchLeads');
    Route::get('/quote/defaultsettings', 'QuotesController@addDefaultSettings');
    Route::post('/quote/defaultsettings/save', 'QuotesController@saveDefaultSettings');
    Route::get('/getquote/accredationSearch', 'QuotesController@searchAccredations');
    Route::get('/ajax/categoryname/{first_id}/{second_id}', 'QuotesController@ajaxCategoryName');
    Route::get('/buyer/quote/data/{id}', 'QuotesController@ajaxBuyerQuote');
    Route::get('/lead/share/{created_by}/{id}','QuotesController@leadShare');
    Route::post('/leadRequest/sent', 'QuotesController@sentLead');

    Route::resource('supplier-quotes', 'SupplierQuotesController');
    Route::get('/supplier-quotes/create/{buyer_id}/{quote_id}', 'SupplierQuotesController@create');
    Route::get('/supplier-create-quote', 'SupplierQuotesController@createQuoteSuppliear');
    Route::get('/supplierquotes/addproduct/{id}', 'SupplierQuotesController@ajaxAddProduct');
    Route::get('/supplierquote/accept/{quote_id}', 'SupplierQuotesController@quoteAccept');
    Route::get('/buyer/quote/ignore/{buyer_id}/{supplier_quote_id}', 'SupplierQuotesController@buyerQuoteIgnore');
    Route::get('supplier-sent-quote','SupplierQuotesController@supplierSentQuote');
    Route::get('supplier-sent-quote/view/{id}','SupplierQuotesController@supplierSentQuoteView');
    Route::get('/quote/item/add/{id}','SupplierQuotesController@addQuoteItem');
    Route::get('/supplier-quote/item/add/{id}','SupplierQuotesController@addSupplierQuoteItem');
    Route::get('/quote/item/edit/{id}','SupplierQuotesController@editQuoteItem');
    Route::get('/supllier-quote/item/edit/{id}','SupplierQuotesController@editSupplierQuoteItem');
    Route::get('/quote/item/delete/{id}','SupplierQuotesController@deleteQuoteItem');
    Route::get('/supllier-quote/item/delete/{id}','SupplierQuotesController@deleteSupplierQuoteItem');
    Route::post('/quote/item/save','SupplierQuotesController@saveQuoteItem');
    Route::post('/supplier-quote/item/save','SupplierQuotesController@saveSupplierQuoteItem');
    Route::get('/supplier-sent-quote/preview/{id}','SupplierQuotesController@supplierSentQuotePreview');
    Route::get('/supplier-quote/submit/{id}','SupplierQuotesController@submitSupplierQuote');
    Route::get('/supplier-quote/edit/{id}','SupplierQuotesController@editSupplierQuote');

    Route::resource('supplier-leads', 'SupplierLeadsController');
    Route::post('/supplier-lead-catalog/save','SupplierLeadsController@saveCatalog');
    Route::get('supplierlead/status/update/{id}/{status}','SupplierLeadsController@updateStatus');
    Route::get('supplier-lead/upload-catalog','SupplierLeadsController@uploadCatalog');
    Route::get('supplier-lead/upload-catalog/history','SupplierLeadsController@catalogUploadHistory');
    Route::get('supplierlead/categories','SupplierLeadsController@sellerCategories');
    Route::get('supplierlead/categoryPackage','SupplierLeadsController@categoryPackage');

    Route::resource('review', 'ReviewsController');
    Route::get('/review-usersearch','ReviewsController@searchUser');
    Route::get('/review-sent','ReviewsController@reviewLeft');
    Route::get('/review-user/profile/{id}','ReviewsController@reviewUserProfile');
    Route::post('/review/approve/{id}','ReviewsController@approveReview');
    Route::post('/review/reject/{id}','ReviewsController@rejectReview');

    Route::resource('endorsement', 'EndorsementsController');
    Route::get('/endorse-user/{sender_id}/{receiver_id}','EndorsementsController@endorseUser');
    Route::get('/endorse-sent','EndorsementsController@endorseLeft');

    //Route::resource('feedback', 'FeedbacksController');
    Route::get('dashboard/supplier','AdminController@supplierCRM');
    Route::get('dashboard/buyer','AdminController@buyerCRM');
    Route::get('buy/supplier-crm','AdminController@viewSupplierCRM');

    /// user activities route
    Route::resource('user-activity', 'UserActivityController');
    Route::get('dashboard/activity','UserActivityController@ajaxActivity');
    Route::post('supplier/package/save','AdminController@saveSupplierPackage');

    Route::post('report/save','AdminController@saveReport');

    /// Supplying Team
    Route::resource('supplierTeam','SupplierTeamController');
    Route::get('/about-supplying-teams','SupplierTeamController@aboutSupplyingTeams');
    Route::get('/start-supplying-team','SupplierTeamController@startSupplyingTeams');
    Route::get('/edit-supplying-team/{id}', 'SupplierTeamController@editSupplyingTeam');
    Route::post('saveSupplierTeam','SupplierTeamController@saveSupplierTeam');
    Route::get('/manage-my-supplying-teams','SupplierTeamController@manageSupplyingTeams');
    Route::get('viewTeamMembers/{teamId}','SupplierTeamController@viewTeamMembers');
    Route::get('/assign-lead-requests','SupplierTeamController@assignLeadRequest');
    Route::get('/assign-leads', 'SupplierTeamController@assignLeads');
    Route::get('/message-supplying-team', 'SupplierTeamController@messageTeam');

    /// Purchasing Team
    Route::resource('purchasingTeam','PurchasingTeamController');
    Route::get('/about-purchasing-teams', 'PurchasingTeamController@aboutPurchasingTeam');
    Route::get('/start-purchasing-team', 'PurchasingTeamController@startPurchasingTeam');
    Route::get('/edit-purchasing-team/{id}', 'PurchasingTeamController@editPurchasingTeam');
    Route::post('savePurchasingTeam','PurchasingTeamController@savePurchasingTeam');
    Route::get('/manage-my-purchasing-teams', 'PurchasingTeamController@managePurchasingTeams');
    Route::get('viewBuyerTeamMembers/{teamId}','PurchasingTeamController@viewBuyerTeamMembers');
    Route::get('/assigned-buy-requests', 'PurchasingTeamController@assignedBuyRequests');
    Route::get('/assigned-quotes', 'PurchasingTeamController@assignedQuotes');
    Route::get('/message-purchasing-team', 'PurchasingTeamController@messagePurchasingTeam');
    Route::get('/accept-product-quotes-team/{id}', 'PurchasingTeamController@acceptQuoteFromTeam');
    Route::get('/ignore-product-quotes-team/{id}', 'PurchasingTeamController@ignoreQuoteFromTeam');

    /// Team Manager For Supplier
    Route::resource('supplierManager','SupplyingManagerController');
    Route::get('/manage-supplying-teams', 'SupplyingManagerController@manageSupplyingTeams');
    Route::get('/manage-supplying-team-members', 'SupplyingManagerController@manageMembers');
    Route::get('/manager-assign-lead-requests', 'SupplyingManagerController@assignLeadRequests');
    Route::post('/saveLeadRequests', 'SupplyingManagerController@saveLeadRequests');
    Route::get('/search/supplierTeamUsers', 'SupplyingManagerController@searchTeamUser');
    //Route::get('/manager-assign-leads', 'SupplyingManagerController@assignLeads');
    Route::get('/view-assigned-lead-requests', 'SupplyingManagerController@viewAssignedLeadRequests');
    //Route::get('/view-assigned-leads', 'SupplyingManagerController@viewAssignedLeads');
    Route::get('/cancel-lead-request-assignment/{id}', 'SupplyingManagerController@cancelLeadRequestAssignment');
    Route::get('/supplying-team-billing', 'SupplyingManagerController@teamBilling');
    Route::get('/transfer-supplying-team', 'SupplyingManagerController@transferTeam');
    Route::post('/transferManagerForSupplier', 'SupplyingManagerController@transferManager');

    /// Team Manager For Buyer
    Route::resource('purchasingManager','PurchasingManagerController');
    Route::get('/manage-purchasing-teams', 'PurchasingManagerController@managePurchasingTeam');
    //Route::get('/edit-purchasing-team', 'PurchasingManagerController@editPurchasingTeam');
    Route::get('/manage-purchasing-team-members', 'PurchasingManagerController@manageMembers');
    Route::get('/manager-assign-buy-requests', 'PurchasingManagerController@assignBuyRequest');
    Route::post('/saveBuyerRequests', 'PurchasingManagerController@saveBuyerRequests');
    Route::get('/teamUsers/search', 'PurchasingManagerController@searchTeamUser');
    Route::get('/manager-assign-quotes', 'PurchasingManagerController@assignQuotes');
    Route::get('/view-assigned-buy-requests', 'PurchasingManagerController@viewAssignedBuyRequests');
    Route::get('/cancel-buy-request-assignment/{id}', 'PurchasingManagerController@cancelBuyRequestAssignment');
    Route::get('/dismiss-quote-assignment/{id}', 'PurchasingManagerController@cancelBuyRequestAssignment');

    Route::get('/view-assigned-quotes', 'PurchasingManagerController@viewAssignedQuotes');
    Route::post('/saveQuotes', 'PurchasingManagerController@saveQuotes');
    Route::get('/transfer-purchasing-team', 'PurchasingManagerController@transferTeam');
    Route::post('/transferManagerForBuyer', 'PurchasingManagerController@transferManager');
    Route::get('/purchasing-team-billing', 'PurchasingManagerController@teamBilling');
    Route::get('/init-paypal-payment', 'PaypalController@initPayPalPayment');
    Route::get('/cancel-paypal-payment', 'PaypalController@cancelPayPalPayment');
    Route::get('/success-paypal-payment', 'PaypalController@successPayPalPayment');

});
Route::get('/acceptForTeamTransfer', 'PurchasingManagerController@acceptTeamTransfer');
/// Support Ticket for all supeadmin , buyer and supliyer ///
Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function()
{
    Route::get('user-dashboard',array('middleware' => 'auth', 'uses' => 'AdminController@index'));

    Route::get('/company/admin/{id}','CompanyController@companyAdminView');
    Route::post('/company/admin/save','CompanyController@saveCompanyAdmin');
    Route::get('/user/currentCompany','CompanyController@userCompany');
    Route::get('/user/editCompany','CompanyController@userEditCompany');
    Route::get('/user/change-company','CompanyController@userChangeCompany');

    Route::resource('supporttickets', 'SupportTicketsController');
    Route::get('/supporttickets/ticket/status/{ticket_id}/{status}', 'SupportTicketsController@saveTicketStatus');

    Route::resource('companies', 'CompanyController');
    Route::post('/upload/file', 'UploadController@upload');
    Route::post('/upload/gallery/file', 'UploadController@uploadGallery');
    Route::get('/compnay/ownerSearch','CompanyController@ownerSearch');
    Route::get('/companies/removeFile/file/{id}', 'UploadController@remove');
    Route::get('/companies/info/{id}', 'CompanyController@companyAdditionalInfo');
    Route::get('/companies/info/accreditations/{id}', 'CompanyController@addCompanyAccreditation');
    Route::post('/companies/info/accreditations/save/{id}', 'CompanyController@saveCompanyAccreditation');
    Route::get('/companies/info/categories/{id}', 'CompanyController@addCompanyCategory');
    Route::get('/companies/info/category/search', 'CompanyController@searchCategories');
    Route::post('/companies/info/categories/save/{id}', 'CompanyController@saveCompanyCategory');
    Route::get('/companies/info/services/{id}', 'CompanyController@addCompanyServices');
    Route::post('/companies/info/services/save/{id}', 'CompanyController@saveCompanyServices');
    Route::get('/companies/info/quality-standards/{id}', 'CompanyController@addCompanyQualityStandards');
    Route::post('/companies/info/quality-standards/save/{id}', 'CompanyController@saveCompanyQualityStandards');
    Route::get('/companies/info/industries/{id}', 'CompanyController@addCompanyIndustries');
    Route::post('/companies/info/industries/save/{id}', 'CompanyController@saveCompanyIndustries');
    Route::get('/companies/info/markets/{id}', 'CompanyController@addCompanyMarkets');
    Route::post('/companies/info/markets/save/{id}', 'CompanyController@saveCompanyMarkets');
    Route::get('/companies/info/shipping-preferences/{id}', 'CompanyController@addCompanyShippingPreferences');
    Route::post('/companies/info/shipping-preferences/save/{id}', 'CompanyController@saveCompanyShippingPreferences');
    Route::get('/companies/info/company-type/{id}', 'CompanyController@addCompanyTypes');
    Route::post('/companies/info/company-type/save/{id}', 'CompanyController@saveCompanyTypes');
    Route::get('/companies/gallery/{id}', 'CompanyController@companyGallery');
    Route::get('/companies/gallery/add/{id}', 'CompanyController@addImagesToCompanyGallery');
    Route::get('/company/packages', 'CompanyController@viewCurrentPackages');
    Route::get('/company/change/packages', 'CompanyController@viewCurrentPackages');
    Route::get('/companies/gallery/remove/{id}', 'UploadController@removeImagesFromGallery');
    Route::get('/companies/gallery/delete/{id}', 'UploadController@deleteImagesFromGallery');

    Route::get('/user-companysearch','CompanyController@searchCompany');
    Route::post('/user/company-change/save', 'CompanyController@saveCompanyChange');
    Route::get('/company/additional/{id}','CompanyController@additionalCompanyView');
    Route::post('/company/additional/save','CompanyController@saveAdditionalCompany');
    Route::post('/company/certification/save','CompanyController@saveCompanyCertification');
    Route::get('/company/certification/edit/{id}','CompanyController@editCompanyCertification');
    Route::get('/company/certification/confirm/{id}','CompanyController@confirmDeleteCompanyCertification');
    Route::get('/company/certification/delete/{id}','CompanyController@deleteCompanyCertification');
    Route::post('/company/logo/upload','CompanyController@uploadLogo');
    Route::get('/company/logo/remove/{id}','CompanyController@removeCompanyLogo');
    Route::post('/company/background/upload','CompanyController@uploadBackground');
    Route::get('/company/background/remove/{id}','CompanyController@removeCompanyBackground');
    Route::get('/company/profile/{id}','CompanyController@companyProfileView');
    Route::get('/claimCompany/start/{companyId}','CompanyController@claimCompanyStartPage');
    Route::match(array('GET', 'POST'),'/claim/companyOwner','CompanyController@saveCompanyOwner');

    /// Referrals
    Route::resource('referrals', 'ReferralsController');
    Route::get('referral/payment/paypal/add','ReferralsController@addPayplaPayment');
    Route::post('referral/payment/paypal/save','ReferralsController@savePayplaPayment');
    Route::get('referral/payment/paypal/edit/{id}','ReferralsController@editPayplaPayment');
    Route::post('referral/payment/paypal/update','ReferralsController@updatePayplaPayment');
    Route::get('referral/payment/paypal/delete/{id}','ReferralsController@deletePayplaPayment');
    Route::get('referral/payment/cheque/add','ReferralsController@addChequePayment');
    Route::post('referral/payment/cheque/save','ReferralsController@saveChequePayment');
    Route::get('referral/payment/cheque/edit/{id}','ReferralsController@editChequePayment');
    Route::post('referral/payment/cheque/update','ReferralsController@updateChequePayment');
    Route::get('referral/payment/cheque/delete/{id}','ReferralsController@deleteChequePayment');

    /// Qyotetek Verififcation
    Route::resource('quotetekverification', 'QuotetekVerificationController');
    Route::get('company/reference/add/{id}','QuotetekVerificationController@addCompanyReference');
    Route::get('company/reference/edit/{id}/{type}','QuotetekVerificationController@editCompanyReference');
    Route::get('company/reference/delete/{id}/{type}','QuotetekVerificationController@deleteCompanyReference');
    Route::post('company/reference/save','QuotetekVerificationController@saveCompanyReference');
    Route::get('/change/verification/{id}','QuotetekVerificationController@changeVerificationStatus');

    /// Payment
    Route::get('/quotetek/payment/{user_id}/{price}/{payment_type}','AccountController@viewPaymentDetail');
    Route::post('/quotetek/payment/save','AccountController@savePaymentDetail');
    Route::get('quotetek/company/vrification','QuotetekVerificationController@addCompanyVerififcation');
    Route::post('quotetek/company/vrification/save','QuotetekVerificationController@saveCompanyVerification');
    Route::get('quotetek/company/vrification/detail','QuotetekVerificationController@viewCompanyVerififcation');

    /// User Profile
    Route::resource('users','UsersController');
    Route::get('user-details','UsersController@showDetails');
    Route::get('user/buyers','UsersController@BuyerUsers');
    Route::get('user/sellers','UsersController@SellersUsers');
    Route::get('user/compnay/search','UsersController@searchCompanies');
    Route::get('user/industry/search','UsersController@searchIndustries');
    Route::get('user/category/search','UsersController@searchCategories');
    Route::post('user/basicinfo/save','UsersController@saveUserBasicInfo');
    Route::post('user/additional-info/save','UsersController@saveUserAdditionalInfo');
    Route::get('user-additional-details','UsersController@showAdditionalDetails');
    Route::get('user/additionaldetails/add/{lable}','UsersController@addAdditionalDetail');
    Route::get('user/additionaldetails/edit/{lable}/{id}','UsersController@editAdditionalDetail');
    Route::get('user/additionaldetails/delete/{lable}/{id}','UsersController@deteleAdditionalDetail');
    Route::post('user/job/save','UsersController@saveUserJob');
    Route::post('user/education/save','UsersController@saveUserEducation');
    Route::post('user/certification/save','UsersController@saveUserCertification');
    Route::post('user/award/save','UsersController@saveUserAward');
    Route::post('user/memberorganization/save','UsersController@saveUserMemberorganization');
    Route::get('user/job/delete/{id}','UsersController@deleteUserJob');
    Route::get('user/education/delete/{id}','UsersController@deleteUserEducation');
    Route::get('user/certification/delete/{id}','UsersController@deleteUserCertification');
    Route::get('user/award/delete/{id}','UsersController@deleteUserAward');
    Route::get('user/member/delete/{id}','UsersController@deleteUserMemberOrganization');
    Route::get('user/upload/photo','UsersController@addUserPicture');
    Route::get('user/company/select','UsersController@addUserCompany');
    Route::get('user/company/data/{id}','UsersController@ajaxCompanyData');
    Route::get('user/company/create','UsersController@createUserCompany');
    Route::get('user/billing/plans','UsersController@addUserBillingPlan');
    Route::get('user/billing/test','UsersController@testUserBillingPlan');
    Route::post('user/billing/save','UsersController@saveUserBillingPlan');
    Route::get('user/invitation','UsersController@showUserInvitation');
    Route::get('general/search','UsersController@searchResult');
    Route::get('company/search','UsersController@searchCompanyResult');
    Route::get('people/search','UsersController@searchPeopleResult');
    Route::get('product/search','UsersController@searchProductResult');
    Route::get('/profile/complete','UsersController@completeProfile');
    Route::get('/user/picture/remove/{id}','UsersController@removeProfilePicture');
    Route::get('/profile/select-dashboard','UsersController@singupDasphboardSelect');
    Route::post('/profile/select-dashboard/save','UsersController@saveSingupDasphboardSelect');
    Route::post('/reset/password','UsersController@resetUserPassword');
    Route::get('/user/profile','UsersController@profileView');
    Route::get('/user/view','UsersController@userView');
    Route::get('/home/user/profile/{id}','UsersController@userProfileShow');
    Route::get('/user/account','UsersController@accountView');
    Route::post('/user/avtar/save','UsersController@saveProfilePicture');
    Route::get('/user/contactSave/{id}','UsersController@userContactSave');
    Route::get('/user/company/save/{id}','UsersController@userCompanySave');

    Route::get('clear/session/{key}', 'UsersController@clearSessionKey');
    Route::get('clear/pulsate/session', 'UsersController@clearSessionPulsate');

    Route::get('/userProducts/view','UsersController@viewUserProducts');
    Route::get('/userContacts/view','UsersController@viewContactUser');

    Route::get('/user/email-verification','AdminController@viewEmailVerification');
    Route::get('/send/verification/email','AdminController@sendEmailVerification');
    Route::get('/email/verify','AdminController@emailVerification');
    Route::get('/user/linkedin-verification','AdminController@viewLinkedinVerification');
    Route::get('/user-dashboard/linkedin-response','AdminController@linkedinVerification');

    /// Acount
    Route::get('/user/payment-info','AccountController@viewPaymentInfo');
    Route::get('/user/payment-history','AccountController@viewPaymentHistory');
    Route::get('/user/payment-invoice/{id}','AccountController@viewPaymentInvoice');
    Route::get('/user/packages/supplier','AccountController@viewSupplierPackages');
    Route::get('/user/packages/unsubscribe/{subscription_id}','AccountController@unsubscribePackages');
    Route::get('/user/packages','AccountController@viewPackages');
    Route::get('/user/package-invoice/{id}','AccountController@viewPackagesInvoice');
    Route::get('/user/package/view/{id}','AccountController@packageDetail');
    Route::get('/user/packages/add','AccountController@addPackages');
    Route::post('/user/packages/save','AccountController@saveUserPackage');
    Route::get('/user/package/delete/{id}','AccountController@deletePackage');

    Route::get('/user/testmail','AccountController@viewTestMail');
    Route::post('/user/testmail/send','AccountController@sendTestMail');
    Route::get('/account/quotecheckout','AccountController@quotecheckout');
    Route::post('/account/quotecheckout','AccountController@quotecheckout');
    Route::get('/account/checkout','AccountController@checkout');


    /// Jobs
    Route::resource('job','JobsController');
    Route::get('/jobs/search','JobsController@viewSearchJob');
    Route::get('/jobs/search/result','JobsController@jobSearchResult');
    Route::post('/jobs/search/list','JobsController@searchJobsList');
    //Route::get('/jobs/search/result','JobsController@jobsSearchResult');
    Route::get('/job/payment/{id}','JobsController@viewJobPayment');
    Route::post('/job/payment/save','JobsController@saveJobPayment');
    Route::get('/job/success/{id}','JobsController@viewJobSuccess');
    Route::get('/skills-expertise/options','JobsController@getSkillsExpertise');
    Route::get('/job/status/{id}/{status}','JobsController@setStatus');
    Route::get('/job/extend/{id}','JobsController@getJobExtend');
    Route::post('/job/save/extend','JobsController@saveJobExtend');
    Route::get('/job/user/save/{id}/{user_id}','JobsController@saveUserJobs');
    Route::get('/job/user/apply/{id}/{user_id}','JobsController@applyUserJob');
    Route::post('/job/apply/save','JobsController@applyJobSave');
    Route::get('/ajax/job/detail/{id}','JobsController@ajaxGetJobDetails');
    Route::get('/jobs/saved','JobsController@savedJobs');
    Route::get('/job/view/{id}','JobsController@viewJob');
    Route::post('/pending/job/pay','JobsController@payPendingJob');
    Route::get('/job/applicants/{id}','JobsController@viewJobApplicants');
    Route::post('/applicant/note/save','JobsController@applicantNoteSave');
    Route::get('/job/application/view/{id}','JobsController@viewJobApplication');
    Route::get('/applicant/reject/{id}','JobsController@applicationReject');

    // user company routes
    Route::get('company/requests','CompanyController@companyUsersRequest');
    Route::get('company/user/remove/{id}','CompanyController@companyUsersRemove');
    Route::get('company/user/accept/{id}','CompanyController@companyUsersAccept');
    Route::get('company/user/reject/{id}','CompanyController@companyUserReject');
    Route::get('company/all-users','CompanyController@companyAllUser');
    Route::get('start-or-join-company','CompanyController@startOrJoinCompany');

    // for message
    Route::get('/conatct/usersearch', 'MessagesController@searchUser');
    Route::get('/message/delete/{id}', 'MessagesController@DeleteMessage');
    Route::get('/message/atachment/{id}', 'MessagesController@ajaxAttachmentMessage');
    Route::get('/message/sent', 'MessagesController@userSentMessage');
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
        Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
        Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    });

    //feedback
    Route::resource('feedbackList', 'FeedbacksController@feedbackList');

});


