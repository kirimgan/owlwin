<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/employer/login/{hash}', 'Auth\LoginController@hashLogin');

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'isadmin'], function () {
    Route::get('/forms', 'FormsController@index');
    Route::get('/forms/create', 'FormsController@create');
    Route::get('/forms/edit/{id}', 'FormsController@edit');
    Route::post('/forms/makepdf', 'FormsController@makePdf');
    Route::post('/forms/edit/update/{id}', 'FormsController@update');
    Route::get('/forms/view-pdf/{id}', 'FormsController@viewPdf');
    Route::get('/forms/get/{filename}', ['as' => 'forms.getFormImage', 'uses' => 'FormsController@getImage']);
    Route::delete('/forms/delete/{id}', ['uses'=>'FormsController@delete', 'as'=>'forms.destroy']);

    #sponsors crud
    Route::resource('sponsors', 'SponsorController');
    Route::get('/sponsors/view-pdf/{id}', 'SponsorController@viewPdf');

    //Clients routes
    Route::get('/employer/create', 'EmployerController@create');
    Route::post('/employer/store', 'EmployerController@store');
    Route::get('/employer/list', ['uses'=>'EmployerController@showList', 'as'=>'employerList']);
    Route::get('/employer/edit-employer/{id}', 'EmployerController@edit');
    Route::post('/employer/edit-employer/update/{id}', 'EmployerController@update');
    Route::delete('/employer/delete/{id}', ['uses'=>'EmployerController@delete', 'as'=>'employer.destroy']);

    //Locations routes
    Route::get('/locations/create', 'LocationsController@create');
    Route::post('/locations/store', 'LocationsController@store');
    Route::get('/locations/list', 'LocationsController@showList');
    Route::get('/locations/edit-location/{id}', 'LocationsController@edit');
    Route::post('/locations/edit-location/update/{id}', 'LocationsController@update');
    Route::delete('/locations/delete/{id}', ['uses'=>'LocationsController@delete', 'as'=>'location.destroy']);

    //Offers routes
    Route::get('/offers/list/{approved?}', 'OfferController@showList');
    Route::get('/offers/make_approve/{offerId}', 'OfferController@make_approve');
});

Route::group(['middleware' => 'isemployer'], function () {
    Route::get('/student/photo/{filename}', array(
            'as' => 'student.getPhoto', 'uses' => 'HomeController@getImage'
        )
    );
    Route::get('/student/view-pdf/{id}', 'HomeController@viewPdf');
    Route::get('/student/get/{filename}', array(
        'as' => 'student.getSponsorForm', 'uses' => 'HomeController@getSponsorForm'
        )
    );

    Route::post('/offers/add', 'OfferController@add');
    Route::post('/offers/remove', 'OfferController@remove');
    Route::get('/offers/get', 'OfferController@get');
    Route::post('/offers/set_student_unvailable', 'OfferController@setStudentUnvailable');
    Route::get('/offers/students', 'OfferController@students');
    Route::post('/offers/upload_signed_form/{student_id}', 'OfferController@uploadSignedForm');
});
    #signedPdf not in group because employer AND admin can view pdf
    Route::get('/offers/signed/{id}', 'OfferController@getSignedForm')->middleware('auth');