<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/home/{id?}', 'HomeController@index')->name('home');
        Route::get('/ask-question/{id}', 'QuestionsController@ask_question')->name('ask-question');
        Route::get('/consulting/{id?}', 'QuestionsController@index')->name('consulting');
        Route::get('/labor-law', 'CategoriesController@services')->name('labor-law');
        Route::get('/lawyers', 'LawyersController@index' )->name('lawyers');
        Route::get('/print-coupon/{id}', 'ReceptionController@print_coupon')->name('print-coupon')->middleware('auth');
        Route::get('/paperwork', 'PaperController@paperwork' )->name('paperwork');
        Route::get('/pending-payment', 'QuestionsController@pending_payment' )->name('pending-payment');
        Route::get('/payment-systems', function () { return view('payment-systems'); })->name('payment-systems');
        Route::get('/user-reviews/{id}/{category?}', 'ReviewsController@user_reviews')->name('user-reviews');
        Route::get('/review/{id?}', 'ReviewsController@review')->name('review');
        Route::get('/reception', 'ReceptionController@index')->name('reception')->middleware('auth');
        Route::post('/reception-time', 'ReceptionController@reception_time')->name('reception-time')->middleware('auth');
        Route::get('/rate/{id}', 'ReviewsController@rating')->name('rate')->middleware('auth');;
        Route::get('/solved-example/{id?}', 'CategoriesController@single')->name('solved-example');
        Route::get('/theme/{id?}', 'ThemeController@single')->name('theme');
        Route::get('/registration/{id}', 'Auth\RegisterController@phone_view')->name('registration');

        /**
         * My account
         */

        Route::get('/documents/{id}', 'DocumentController@index')->name('documents')->middleware('auth');
        Route::get('/my-advice/{id}', 'QuestionsController@my_advice')->name('my-advice')->middleware('auth');
        Route::get('/office/{id?}', 'UserController@office')->middleware('auth')->name('office');
        Route::get('/settings', 'UserController@settings' )->name('settings')->middleware('auth');

        /**
         * Form views
         */

        Route::get('/problem-desc/{id?}', 'UserController@problem' )->name('problem-desc');
        Route::get('/vacancies', function () { return view('mail.vacancies'); })->name('vacancies');

        /**
         * Pages with editor
         */

        Route::get('/report', 'InfoController@report')->name('report');
        Route::get('/about', 'PageController@about' )->name('about');
        Route::get('/info', 'PageController@info' )->name('info');
        Route::get('/offer-terms', 'PageController@offer_terms' )->name('offer-terms');
        Route::get('/contact', 'InfoController@contact' )->name('contact');

        /**
         * Moderator
         */

        Route::get('/add-lawyer', function () { return view('moderator.add-lawyer'); })->name('add-lawyer');
        Route::get('/feedback-detailed/{id}/{user}', 'QuestionsController@lawyer_feedback' )->name('feedback-detailed');
        Route::get('/moderation', 'QuestionsController@moderation' )->name('moderation');
        Route::get('/moderator-report', 'QuestionsController@deal_report')->name('moderator-report');
        Route::get('/new-deals', 'QuestionsController@new_deals')->name('new-deals');

        /**
         * Lawyer
         */

        Route::get('/offer/{id?}', 'QuestionsController@deal' )->name('offer')->middleware('auth');
        Route::get('/edit-profile/{id}', 'UserController@edit_lawyer')->name('edit-profile')->middleware('auth');
        Route::get('/set-price/{id}', 'QuestionsController@set_price')->name('set-price')->middleware('auth');

        /**
         * Chat
         */

        Route::post('/send-message','ChatController@send_message')->name('send-message');
        Route::get('/chat/{id?}', 'ChatController@index')->name('chat')->middleware('auth');
        Route::get('/conversations/{id}/{user?}','ChatController@conversations')->name('conversations');
        Route::get('/start-chat/{id}/{question?}', 'ChatController@create_conversation')->name('start-chat');
        Route::get('/moder-chat/{id}/', 'ChatController@moder_conversation')->name('moder-chat');

        /**
         * Search
         */


        Route::get('/search', 'HomeController@search')->name('search.result');
        Route::get('/search-review/{id?}', 'ReviewsController@search_review')->name('search-review');
        Route::get('/search-question/{id?}', 'CategoriesController@search_question')->name('search-question');
        Route::get('/search-theme-question/{id?}', 'ThemeController@search_question')->name('search-theme-question');


        /**
         * Forms
         */

        Route::post('/send-vacancies', 'MailController@vacancies')->name('send-vacancies');
        Route::post('/send-question', 'QuestionsController@send_question')->name('send-question');
        Route::post('/upload-document', 'DocumentController@upload_document')->name('upload-document');
        Route::post('/create-deal/{id}', 'QuestionsController@create_deal')->name('create-deal');
        Route::post('/offer-check', 'QuestionsController@offer_check')->name('offer-check');
        Route::post('/set-answer', 'QuestionsController@set_answer')->name('set-answer');
        Route::post('/send-problem', 'MailController@send_problem')->name('send-problem');
        Route::post('/add-review', 'ReviewsController@add_review')->name('add-review');
        Route::post('/create-reception', 'ReceptionController@create_reception')->name('create-reception');
        Route::post('/edit-lawyer-profile', 'UserController@edit_lawyer_form')->name('edit-lawyer-profile')->middleware('auth');
        Route::post('/coupon-upload', 'ReceptionController@coupon_upload')->name('coupon-upload');
        Route::post('/date-questions', 'QuestionsController@date_questions')->name('date-questions');
        Route::post('/more-themes', 'HomeController@more_themes')->name('more-themes');
        Route::post('/success-deal', 'QuestionsController@success_deal')->name('success-deal');
        Route::post('/hide-deal', 'QuestionsController@hide_deal')->name('hide-deal');
        Route::post('/success-review', 'QuestionsController@success_review')->name('success-review');
        Route::post('/hide-review', 'QuestionsController@hide_review')->name('hide-review');
        Route::post('/ajax-papers', 'PaperController@ajax_papers')->name('ajax-papers');
        Route::post('/register-phone', 'Auth\RegisterController@register_phone')->name('register-phone');

        /**
         * Auth
         */

        Auth::routes();
        Route::post('/login', 'Auth\LoginController@authenticate');
        Route::post('/reset', 'Auth\ForgotPasswordController@reset')->name('reset');
        Route::get('/new-password/{id}/{token}', 'Auth\ResetPasswordController@new_password')->name('new_password');
        Route::post('/new_pass/{id}', 'Auth\ResetPasswordController@new_pass')->name('new_pass');

        /**
         * Admin
         */

        Route::group(['middleware' => ['auth' , 'permission:role-list']], function() {
            Route::resource('roles','RoleController');
            Route::resource('users','UserController');
            Route::resource('categories','CategoriesController');
            Route::resource('themes','ThemeController');
            Route::resource('pages','PageController');
            Route::resource('infos','InfoController');
            Route::resource('times','TimeController');
            Route::resource('papers','PaperController');
            Route::resource('questions','QuestionsController');
        });

        /**
         * Modal Forms
         */

        Route::post('/change-login', 'UserController@change_login')->name('change-login');
        Route::post('/change-password', 'UserController@change_password')->name('change-password');
        Route::post('/change-phone', 'UserController@change_phone')->name('change-phone');
        Route::post('/change-email', 'UserController@change_email')->name('change-email');
        Route::post('/change-card', 'UserController@change_card')->name('change-card');
        Route::post('/delete-card', 'UserController@delete_card')->name('delete-card');
        Route::post('/delete-user', 'UserController@delete_user')->name('delete-user');


    });