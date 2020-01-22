<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix'=>'/user','as'=>'ipn.','namespace'=>'Backend\Employer'],function () {
    //Payment IPN
    Route::get('/ipnbtc', 'EmployeeController@ipnBchain')->name('bchain');
    Route::get('/ipnblockbtc', 'EmployeeController@blockIpnBtc')->name('block.btc');
    Route::get('/ipnblocklite', 'EmployeeController@blockIpnLite')->name('block.lite');
    Route::get('/ipnblockdog', 'EmployeeController@blockIpnDog')->name('block.dog');
    Route::post('/ipnpaypal', 'EmployeeController@ipnpaypal')->name('paypal');
    Route::post('/ipnperfect', 'EmployeeController@ipnperfect')->name('perfect');
    Route::post('/ipnstripe', 'EmployeeController@ipnstripe')->name('stripe');
    Route::post('/ipnskrill', 'EmployeeController@skrillIPN')->name('skrill');
    Route::post('/ipncoinpaybtc', 'EmployeeController@ipnCoinPayBtc')->name('coinPay.btc');
    Route::post('/ipncoinpayeth', 'EmployeeController@ipnCoinPayEth')->name('coinPay.eth');
    Route::post('/ipncoinpaybch', 'EmployeeController@ipnCoinPayBch')->name('coinPay.bch');
    Route::post('/ipncoinpaydash', 'EmployeeController@ipnCoinPayDash')->name('coinPay.dash');
    Route::post('/ipncoinpaydoge', 'EmployeeController@ipnCoinPayDoge')->name('coinPay.doge');
    Route::post('/ipncoinpayltc', 'EmployeeController@ipnCoinPayLtc')->name('coinPay.ltc');
    Route::post('/ipncoin', 'EmployeeController@ipnCoin')->name('coinpay');
    Route::post('/ipncoingate', 'EmployeeController@ipnCoinGate')->name('coingate');

    Route::post('/ipnpaytm', 'EmployeeController@ipnPayTm')->name('paytm');
    Route::post('/ipnpayeer', 'EmployeeController@ipnPayEer')->name('payeer');
    Route::post('/ipnpaystack', 'EmployeeController@ipnPayStack')->name('paystack');
    Route::post('/ipnvoguepay', 'EmployeeController@ipnVoguePay')->name('voguepay');
});



Route::get('ad-click/{id}','Backend\Admin\AdvertisementController@adClick');

Route::get('/', 'Frontend\HomeController@index')->name('home'); //Mavo Changed the home page url to be job page
Route::get('/search-by-keyword', 'Frontend\HomeController@searchByKeyWord')->name('search_by_keyword');
Route::get('/job', 'Frontend\HomeController@job')->name('job');
Route::get('/job/view/{id}/{slug}', 'Frontend\HomeController@jobView')->name('job.view');
Route::get('/location_change', 'Frontend\HomeController@locationChangeByAjax')->name('location_change');
Route::get('/search-job', 'Frontend\HomeController@searchJob')->name('search-job');
Route::get('/company-details/{company_id}', 'Frontend\HomeController@companyDetails')->name('company_details');
Route::get('/about', 'Frontend\HomeController@about')->name('about');
Route::get('/blog/{cat_id?}', 'Frontend\HomeController@blog')->name('blog');
Route::get('/blog-details/{id}/{slug}', 'Frontend\HomeController@blogDetails')->name('blog_details');
Route::get('/faq', 'Frontend\HomeController@faq')->name('faq');
Route::get('/contact', 'Frontend\HomeController@contact')->name('contact');
Route::post('/contact','Frontend\HomeController@contactSubmit')->name('contact.submit');

Route::get('{user_type}/login/{provider}', 'Frontend\Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('{user_type}/login/{provider}/callback', 'Frontend\Auth\LoginController@handleProviderCallback')->name('social.login_callback');
Route::group(['middleware'=>'guest'],function(){
    //frontend
    Route::get('register','Frontend\Auth\RegisterController@showRegistrationForm')->name('auth.register');
    Route::post('register','Frontend\Auth\RegisterController@register')->name('auth.register.post');

    Route::get('login','Frontend\Auth\LoginController@showLoginForm')->name('auth.login');
    Route::post('login','Frontend\Auth\LoginController@login')->name('auth.login.post');




// Password Reset Routes...
    Route::get('password/reset', 'Frontend\Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.request');
    Route::post('user/password/email', 'Frontend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
    Route::get('user/password/reset/{token}/{user_type}', 'Frontend\Auth\ForgotPasswordController@resetLink')->name('user.password.reset');
    Route::post('user/password/reset/{user_type}', 'Frontend\Auth\ForgotPasswordController@passwordReset')->name('user.password.update');

    //backend

    Route::get('admin','Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login','Backend\Auth\LoginController@login')->name('admin.login.post');
    Route::post('admin/logout', 'Backend\Auth\LoginController@logout')->name('admin.logout');
});
Route::post('logout', 'Frontend\Auth\LoginController@logout')->name('auth.logout');
Route::get('show-email-verify-form','Frontend\Auth\VerificationController@showEmailVerForm')->name('user.showEmailVerForm');

Route::post('email-verify','Frontend\Auth\VerificationController@emailVerification')->name('user.email-verify');
Route::get('show-sms-verify-form','Frontend\Auth\VerificationController@showSmsVerForm')->name('user.showSmsVerForm');
Route::post('sms-verify','Frontend\Auth\VerificationController@smsVerification')->name('user.smsVerForm');
Route::get('resend-verify','Frontend\Auth\VerificationController@sendVcode')->name('user.sendVcode');

    // Route::group(['prefix'=>'/user','middleware' => ['auth:web'],'namespace'=>'Frontend'],function () {
    Route::group(['prefix'=>'/user','namespace'=>'Frontend'],function () {

        // Route::group(['middleware'=>['email_verified','sms_verified','active_user']],function() {
            Route::get('/dashboard', 'User\HomeController@index')->name('user.dashboard');
            Route::get('/profile', 'User\HomeController@profile')->name('user.profile');

            Route::get('/popupdisable', 'User\HomeController@disable')->name('user.disablePopUp'); // elis

            Route::get('location-change','User\HomeController@locationChangeByAjax')->name('user.location_change');
            Route::post('/profile/update', 'User\HomeController@profileUpdate')->name('user.profile.update');
            Route::get('/change-pass', 'User\HomeController@changePass')->name('user.change_pass');
            Route::post('/change-pass', 'User\HomeController@changePassStore')->name('user.change_pass.store');
            // Route::get('/application/{monthly?}', 'User\HomeController@myApplication')->name('user.application');
              Route::get('/resume', 'User\HomeController@resume')->name('user.resume');
            // Route::get('/resume', 'User\HomeController@resume')->name('user.resume.free'); //elis
            Route::get('/resume/{id}/{slug}', 'User\HomeController@resumeOne')->name('user.resumeOne'); //elis
            Route::get('/resume-view', 'User\HomeController@resumeView')->name('user.resume_view');

            Route::post('/resume/update-summary', 'User\HomeController@resumeUpdateSummary')->name('user.resume.update_summary');

            Route::post('/resume/add-experience', 'User\HomeController@resumeAddExperience')->name('user.resume.add_experience');
            Route::post('/resume/edit-experience/{id}', 'User\HomeController@resumeEditExperience')->name('user.resume.edit_experience');
            Route::post('/resume/delete-experience/{id}', 'User\HomeController@resumeDeleteExperience')->name('user.resume.delete_experience');

            Route::post('/resume/add-education', 'User\HomeController@resumeAddEducation')->name('user.resume.add_education');
            Route::post('/resume/edit-education/{id}', 'User\HomeController@resumeEditEducation')->name('user.resume.edit_education');
            Route::post('/resume/delete-education/{id}', 'User\HomeController@resumeDeleteEducation')->name('user.resume.delete_education');

            Route::post('/resume/add-skill', 'User\HomeController@resumeAddSkill')->name('user.resume.add_skill');
            Route::post('/resume/edit-skill/{id}', 'User\HomeController@resumeEditSkill')->name('user.resume.edit_skill');
            Route::post('/resume/delete-skill/{id}', 'User\HomeController@resumeDeleteSkill')->name('user.resume.delete_skill');

            Route::post('/resume/add-language', 'User\HomeController@resumeAddLanguage')->name('user.resume.add_language');
            Route::post('/resume/edit-language/{id}', 'User\HomeController@resumeEditLanguage')->name('user.resume.edit_language');
            Route::post('/resume/delete-language/{id}', 'User\HomeController@resumeDeleteLanguage')->name('user.resume.delete_language');


            Route::post('/resume/upload', 'User\HomeController@resumeUploadFile')->name('user.resume.upload');
            // Route::post('/resume/upload-file', 'User\HomeController@resumeUploadFile')->name('user.resume.apply.job');
            
            // Route::get('/apply-job/{id}', 'User\HomeController@applyJob')->name('user.apply_job');
            // Route::post('/apply-job/{id}', 'User\HomeController@applyJobStore')->name('user.apply_job.store'); 

            // ALTERNATE METHODS ELIS 20/01/2020 8:18PM

            Route::get('/application/form/{id}','User\HomeController@formApplication')->name('application.form');
            Route::post('/application/formdata/{id}','User\HomeController@userData')->name('upload.form');
           


        });

    // });


    Route::group(['prefix'=>'/kmrc'],function () {


        
            // Route::get('/dashboard', 'Frontend\Kmrc\HomeController@index')->name('dashboard');
            // Route::get('/profile', 'User\HomeController@profile')->name('user.profile');
            // Route::get('location-change','User\HomeController@locationChangeByAjax')->name('user.location_change');
            // Route::post('/profile/update', 'User\HomeController@profileUpdate')->name('user.profile.update');
            // Route::get('/change-pass', 'User\HomeController@changePass')->name('user.change_pass');
            // Route::post('/change-pass', 'User\HomeController@changePassStore')->name('user.change_pass.store');
            // Route::get('/application/{monthly?}', 'User\HomeController@myApplication')->name('user.application');
            //   Route::get('/resume', 'User\HomeController@resume')->name('user.resume');
            // // Route::get('/resume', 'User\HomeController@resume')->name('user.resume.free'); //elis
            // Route::get('/resume/{id}/{slug}', 'User\HomeController@resumeOne')->name('user.resumeOne'); //elis
            // Route::get('/resume-view', 'User\HomeController@resumeView')->name('user.resume_view');

            // Route::post('/resume/update-summary', 'User\HomeController@resumeUpdateSummary')->name('user.resume.update_summary');

            // Route::post('/resume/add-experience', 'User\HomeController@resumeAddExperience')->name('user.resume.add_experience');
            // Route::post('/resume/edit-experience/{id}', 'User\HomeController@resumeEditExperience')->name('user.resume.edit_experience');
            // Route::post('/resume/delete-experience/{id}', 'User\HomeController@resumeDeleteExperience')->name('user.resume.delete_experience');

            // Route::post('/resume/add-education', 'User\HomeController@resumeAddEducation')->name('user.resume.add_education');
            // Route::post('/resume/edit-education/{id}', 'User\HomeController@resumeEditEducation')->name('user.resume.edit_education');
            // Route::post('/resume/delete-education/{id}', 'User\HomeController@resumeDeleteEducation')->name('user.resume.delete_education');

            // Route::post('/resume/add-skill', 'User\HomeController@resumeAddSkill')->name('user.resume.add_skill');
            // Route::post('/resume/edit-skill/{id}', 'User\HomeController@resumeEditSkill')->name('user.resume.edit_skill');
            // Route::post('/resume/delete-skill/{id}', 'User\HomeController@resumeDeleteSkill')->name('user.resume.delete_skill');

            // Route::post('/resume/add-language', 'User\HomeController@resumeAddLanguage')->name('user.resume.add_language');
            // Route::post('/resume/edit-language/{id}', 'User\HomeController@resumeEditLanguage')->name('user.resume.edit_language');
            // Route::post('/resume/delete-language/{id}', 'User\HomeController@resumeDeleteLanguage')->name('user.resume.delete_language');


            // Route::post('/resume/upload', 'User\HomeController@resumeUploadFile')->name('user.resume.upload');
            // // Route::post('/resume/upload-file', 'User\HomeController@resumeUploadFile')->name('user.resume.apply.job');
            // Route::get('/apply-job/{id}', 'User\HomeController@applyJob')->name('user.apply_job');
            // Route::post('/apply-job/{id}', 'User\HomeController@applyJobStore')->name('user.apply_job.store');

      

    });




    Route::group(['prefix'=>'/admin','middleware' => ['auth:admin'],'namespace'=>'Backend\Admin'],function () {
        Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');



        ////////////////////Manage Job ////////////////////////////////
        Route::get('/jobs', 'JobController@index')->name('admin.job');
        Route::get('/jobs/create', 'JobController@create')->name('admin.job.create');// el fix
        Route::post('/jobs/store', 'JobController@store')->name('admin.job.store');// el fix
        Route::get('/jobs/{id}/view', 'JobController@view')->name('admin.job.view');
        Route::get('view-cv/{candidate_id}','JobController@viewCv')->name('admin.view-cv');
        Route::get('/download/{id}','JobController@downloadDocs')->name('admin.download-doc');// el fix
        
        Route::get('/jobs/{id}/edit', 'JobController@edit')->name('admin.job.edit');
        Route::post('/jobs/{id}/update', 'JobController@update')->name('admin.job.update');
        Route::get('/jobs/{id}/change-status', 'JobController@changeStatus')->name('admin.job.change-status');
         Route::get('/jobs/{id}/destroy', 'JobController@destroy')->name('admin.job.delete');// elis

        // CREATE USER
        Route::get('/users/create', 'JobController@createNewUser')->name('backend.admin.createUser');
        Route::post('/users/store', 'JobController@storeNewUser')->name('backend.admin.store'); // elis
        Route::get('/users/delete', 'JobController@deleteUser')->name('backend.admin.delete'); //elis

        ////////////////////Package ////////////////////////////////
        Route::get('/package', 'PackageController@index')->name('admin.package');
        Route::post('/package', 'PackageController@store')->name('admin.package.store');
        Route::post('/package/{id}/update', 'PackageController@update')->name('admin.package.update');

        ////////////////////Location ( country ) ////////////////////////////////
        Route::get('/country', 'LocationController@index')->name('admin.location');
        Route::post('/country', 'LocationController@store')->name('admin.location.store');
        Route::post('/country/{id}/update', 'LocationController@update')->name('admin.location.update');
        ////////////////////Location ( state ) ////////////////////////////////
        Route::get('/state/{country_id}', 'LocationController@stateIndex')->name('admin.state');
        Route::post('/state/{country_id}', 'LocationController@stateStore')->name('admin.state.store');
        Route::post('/state/{country_id}/{id}/update', 'LocationController@stateUpdate')->name('admin.state.update');
        ////////////////////Location ( city ) ////////////////////////////////
        Route::get('/city/{state_id}', 'LocationController@cityIndex')->name('admin.city');
        Route::post('/city/{state_id}', 'LocationController@cityStore')->name('admin.city.store');
        Route::post('/city/{state_id}/{id}/update', 'LocationController@cityUpdate')->name('admin.city.update');

        Route::get('/location-shortable/{type}', 'LocationController@shortable')->name('admin.location_shortable');
        ////////////////////Job Attribute////////////////////////////////
        Route::get('/job-attribute/{type}', 'JobAttributeController@index')->name('admin.job_attribute');
        Route::post('/job-attribute/{type}', 'JobAttributeController@store')->name('admin.job_attribute.store');
        Route::post('/job-attribute/{type}/{id}/update', 'JobAttributeController@update')->name('admin.job_attribute.update');
        Route::post('/job-attribute/{type}/{id}/delete', 'JobAttributeController@delete')->name('admin.job_attribute.delete');
        ////////////////////Manage Employer////////////////////////////////
        Route::get('employer', 'EmployerController@index')->name('admin.employer');
        Route::get('employer/{employer}/view', 'EmployerController@view')->name('admin.employer.view');
        Route::get('employer-banned', 'EmployerController@banusers')->name('admin.employer.ban');
        // Route::get('employer-banned/{type}', 'EmployerController@banusersWithFilters')->name('admin.employer.banFilter');

        Route::get('employer/mail/{employer}', 'EmployerController@email')->name('admin.employer.email');
        Route::post('employer/send-mail', 'EmployerController@emailSendToEmployee')->name('admin.employer.send.mail');
        Route::post('employer/pass-change/{employer}', 'EmployerController@userPasschange')->name('admin.employer.passchange');
        Route::post('employer/{employer}/details_update', 'EmployerController@detailsUpdate')->name('admin.employer.details_update');

        Route::get('employer/broadcast', 'EmployerController@broadcast')->name('admin.employer.broadcast');
        Route::post('employer/broadcast/email', 'EmployerController@broadcastEmail')->name('admin.employer.broadcast.email');
        Route::get('location-change','EmployerController@locationChangeByAjax')->name('admin.location_change');
        ////////////////////Manage Users////////////////////////////////
        Route::get('users', 'UserController@index')->name('admin.users');
        Route::get('user/{user}', 'UserController@view')->name('admin.user.view');

        
        Route::get('activate/{user}', 'UserController@activate')->name('admin.activate');  //elis
        Route::get('deactivate/{user}', 'UserController@deactivate')->name('admin.deactivate'); //elis
        Route::get('delete/{user}', 'UserController@forceDelete')->name('admin.delete'); //elis    download.csv
        Route::post('download/csv', 'UserController@downloadApplicantCSV')->name('download.csv'); //elis
        
        Route::get('user-banned', 'UserController@banusers')->name('admin.user.ban');
        // Route::get('user-banned', 'UserController@banusersWithFilters')->name('admin.user.banFilter');

        Route::get('mail/{user}', 'UserController@email')->name('admin.email');
        Route::post('send-mail', 'UserController@emailSendToUser')->name('admin.send.mail');
        Route::post('user/pass-change/{user}', 'UserController@userPasschange')->name('admin.user.passchange');
        Route::post('user/{user}/details_update', 'UserController@detailsUpdate')->name('admin.user.details_update');

        Route::get('broadcast', 'UserController@broadcast')->name('admin.broadcast');
        Route::post('broadcast/email', 'UserController@broadcastEmail')->name('admin.broadcast.email');
        ////////////////////Payment////////////////////////////////


        Route::get('gateway', 'GatewayController@index')->name('admin.gateway');

        Route::post('gatewayListUpdate/{id}', 'GatewayController@update')->name('gateway.list.update');
        Route::get('payment-log', 'GatewayController@paymentLog')->name('admin.payment_log');


        /////////////////////// Manage Advertisement //////////////////////////////
        Route::get('advertisement', 'AdvertisementController@index')->name('admin.advertisement');
        Route::get('advertisement/create', 'AdvertisementController@create')->name('admin.advertisement.create');
        Route::post('advertisement', 'AdvertisementController@store')->name('admin.advertisement.store');
        Route::get('advertisement/{id}/edit', 'AdvertisementController@edit')->name('admin.advertisement.edit');
        Route::post('advertisement/{id}/update', 'AdvertisementController@update')->name('admin.advertisement.update');
        ////////////////////Setting////////////////////////////////
        Route::get('general-settings', 'Settings\GeneralSettingController@generalSetting')->name('backend.admin.general_setting');
        Route::post('general-settings', 'Settings\GeneralSettingController@generalSettingUpdate')->name('backend.admin.general_setting.update');

        Route::get('email-setting', 'Settings\GeneralSettingController@emailSetting')->name('backend.admin.email_setting');
        Route::post('email-setting', 'Settings\GeneralSettingController@emailSettingUpdate')->name('backend.admin.email_setting.update');

        Route::get('sms-setting', 'Settings\GeneralSettingController@smsSetting')->name('backend.admin.sms_setting');
        Route::post('sms-setting', 'Settings\GeneralSettingController@smsSettingUpdate')->name('backend.admin.sms_setting.update');



        Route::get('logo-and-fav-setting', 'Settings\GeneralSettingController@logoAndFavicon')->name('backend.admin.logo_and_fav_setting');
        Route::post('logo-and-fav-setting', 'Settings\GeneralSettingController@logoAndFaviconUpdate')->name('backend.admin.logo_and_fav_setting.update');



        /////////////////////// Web Setting //////////////////////////////

        Route::get('/web-setting/{page}/{section}','WebSettingController@sectionEdit')->name('admin.web_setting.section');
        Route::post('/web-setting/{page}/{section}','WebSettingController@sectionUpdate')->name('admin.web_setting.section.store');
        /***************** Home ********************/
        ///////Slider
        Route::post('/web-settings/home/slider/store','WebSettingController@homeSliderStore')->name('admin.web_setting.home.slider.store');
        Route::post('/web-settings/home/slider/{id}/update','WebSettingController@homeSliderUpdate')->name('admin.web_setting.home.slider.update');
        Route::post('/web-settings/home/slider/{id}/delete','WebSettingController@homeSliderDelete')->name('admin.web_setting.home.slider.delete');
        ///////overview_left
        Route::post('/web-settings/home/overview-left/store','WebSettingController@homeOverviewLeftStore')->name('admin.web_setting.home.overview_left.store');
        Route::post('/web-settings/home/overview-left/{id}/update','WebSettingController@homeOverviewLeftUpdate')->name('admin.web_setting.home.overview_left.update');
        Route::post('/web-settings/home/overview-left/{id}/delete','WebSettingController@homeOverviewLeftDelete')->name('admin.web_setting.home.overview_left.delete');
        ///////overview_right
        Route::post('/web-settings/home/overview-right/store','WebSettingController@homeOverviewRightStore')->name('admin.web_setting.home.overview_right.store');
        Route::post('/web-settings/home/overview-right/{id}/update','WebSettingController@homeOverviewRightUpdate')->name('admin.web_setting.home.overview_right.update');
        Route::post('/web-settings/home/overview-right/{id}/delete','WebSettingController@homeOverviewRightDelete')->name('admin.web_setting.home.overview_right.delete');
        ///////Team
        Route::post('/web-settings/home/team/store','WebSettingController@homeTeamStore')->name('admin.web_setting.home.team.store');
        Route::post('/web-settings/home/team/{id}/update','WebSettingController@homeTeamUpdate')->name('admin.web_setting.home.team.update');
        Route::post('/web-settings/home/team/{id}/delete','WebSettingController@homeTeamDelete')->name('admin.web_setting.home.team.delete');
            /*
             * Social
             */
        Route::post('/web-settings/home/team-social/{team_id}/store','WebSettingController@homeTeamSocialStore')->name('admin.web_setting.home.team_social.store');
        Route::post('/web-settings/home/team-social/{team_id}/{id}/update','WebSettingController@homeTeamSocialUpdate')->name('admin.web_setting.home.team_social.update');
        Route::post('/web-settings/home/team-social/{team_id}/{id}/delete','WebSettingController@homeTeamSocialDelete')->name('admin.web_setting.home.team_social.delete');
        ///////testimonial
        Route::post('/web-settings/home/testimonial/store','WebSettingController@homeTestimonialStore')->name('admin.web_setting.home.testimonial.store');
        Route::post('/web-settings/home/testimonial/{id}/update','WebSettingController@homeTestimonialUpdate')->name('admin.web_setting.home.testimonial.update');
        Route::post('/web-settings/home/testimonial/{id}/delete','WebSettingController@homeTestimonialDelete')->name('admin.web_setting.home.testimonial.delete');
        ///////whyPeople like
        Route::post('/web-settings/home/why-people-like/store','WebSettingController@homeWhyPeopleLikeStore')->name('admin.web_setting.home.why_people_like.store');
        Route::post('/web-settings/home/why-people-like/{id}/update','WebSettingController@homeWhyPeopleLikeUpdate')->name('admin.web_setting.home.why_people_like.update');
        Route::post('/web-settings/home/why-people-like/{id}/delete','WebSettingController@homeWhyPeopleLikeDelete')->name('admin.web_setting.home.why_people_like.delete');
        ///////Brand Section
        Route::post('/web-settings/home/brand/store','WebSettingController@homeBrandStore')->name('admin.web_setting.home.brand.store');
        Route::post('/web-settings/home/brand/{id}/update','WebSettingController@homeBrandUpdate')->name('admin.web_setting.home.brand.update');
        Route::post('/web-settings/home/brand/{id}/delete','WebSettingController@homeBrandDelete')->name('admin.web_setting.home.brand.delete');
        ///////social Section
        Route::post('/web-settings/home/social/store','WebSettingController@homeSocialStore')->name('admin.web_setting.social.store');
        Route::post('/web-settings/home/social/{id}/update','WebSettingController@homeSocialUpdate')->name('admin.web_setting.social.update');
        Route::post('/web-settings/home/social/{id}/delete','WebSettingController@homeSocialDelete')->name('admin.web_setting.social.delete');

        /***************** Faq ********************/
        Route::post('/web-settings/faq/store','WebSettingController@faqStore')->name('admin.web_setting.faq.store');
        Route::post('/web-settings/faq/{id}/update','WebSettingController@faqUpdate')->name('admin.web_setting.faq.update');
        Route::post('/web-settings/faq/{id}/delete','WebSettingController@faqDelete')->name('admin.web_setting.faq.delete');
        //blog
        Route::get('/post-category', 'PostController@category')->name('admin.cat');
        Route::post('/post-category', 'PostController@UpdateCategory')->name('update.cat');
        Route::get('blog', 'PostController@index')->name('admin.blog');
        Route::get('blog/create', 'PostController@create')->name('blog.create');
        Route::post('blog/create', 'PostController@store')->name('blog.store');
        Route::delete('blog/delete', 'PostController@destroy')->name('blog.delete');
        Route::get('blog/edit/{id}', 'PostController@edit')->name('blog.edit');
        Route::post('blog-update', 'PostController@updatePost')->name('blog.update');
    });
    Route::group(['prefix'=>'/employer','middleware' => ['auth:employer'],'namespace'=>'Backend\Employer'],function () {

        Route::group(['middleware'=>['email_verified','sms_verified','active_user']],function() {
            Route::get('/', 'EmployeeController@index')->name('employer.dashboard');
            Route::get('profile','EmployeeController@profile')->name('employer.profile');
            Route::get('location-change','EmployeeController@locationChangeByAjax')->name('employer.location_change');
            Route::post('profile/update','EmployeeController@profileUpdate')->name('employer.profile.update');
            Route::post('profile/social/store','EmployeeController@profileSocialStore')->name('employer.profile.social.store');
            Route::post('profile/social/update','EmployeeController@profileSocialUpdate')->name('employer.profile.social.update');
            Route::post('profile/social/delete','EmployeeController@profileSocialDelete')->name('employer.profile.social.delete');
            Route::get('job-list','EmployeeController@jobs')->name('employer.job_list');
            Route::get('job/{id}/edit','EmployeeController@jobEdit')->name('employer.job.edit');
            Route::get('job/{id}/view','EmployeeController@jobView')->name('employer.job.view');

            Route::get('jobs/make-short-list/{apply_id}','EmployeeController@jobMakeShortList')->name('employer.job.view-make-short-list');
            Route::get('jobs/make-select/{apply_id}','EmployeeController@jobMakeSelect')->name('employer.job.view-make-select');
            Route::get('view-cv/{candidate_id}/{apply_id}','EmployeeController@viewCv')->name('employer.view-cv');

            Route::post('job/{id}/update','EmployeeController@jobUpdate')->name('employer.job.update');
            Route::get('job-post','EmployeeController@jobPostCreate')->name('employer.job_post')->middleware('post_job');
            Route::post('job-post','EmployeeController@jobPostStore')->name('employer.job_post.store');
            //payment
            Route::post('payment/data-insert', 'EmployeeController@paymentDataInsert')->name('employer.payment.data-insert');
            Route::get('payment/preview', 'EmployeeController@paymentPreview')->name('employer.payment.preview');
            Route::post('payment/confirm', 'EmployeeController@paymentConfirm')->name('employer.payment.confirm');


            Route::get('plan','EmployeeController@plan')->name('employer.plan');
        });

    });
    Route::post('admin/user-profile/change-password','ProfileController@changePasswordStore')->name('admin.user_profile.change_password.store');


