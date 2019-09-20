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

Route::group(['namespace' => 'Web'], function () {
    Route::get('/', 'PageController@getIndexPage')->name('index');
    Route::get('/tour', 'PageController@getTourPage')->name('tour');
    Route::get('/entryForm', 'PageController@getEntryForm')->name('entryForm');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/approval', 'HomeController@approval')->name('approval');

    Route::middleware(['approved'])->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    });

});



Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['role:super-admin','auth']], function () {
    Route::resource('studio', 'StudioController');

    Route::get('studioPDF/{studio}', 'StudioController@studioPDF')->name('studioPDF');
    Route::get('studiosPDF', 'StudioController@studiosPDF')->name('studiosPDF');
    Route::get('downloadMusic', 'StudioController@downloadMusic')->name('downloadMusic');





    Route::put('studio/{studio}','StudioController@updateStudio')->name('updateStudio');

    Route::resource('performanceCategory', 'PerformanceCategoryController');
    Route::resource('competitionDetail', 'CompetitionDetailController');
    Route::resource('slider', 'SliderController');
    Route::resource('result', 'ResultController');
    Route::resource('discount', 'DiscountController');
    Route::resource('nationalCosts', 'NationalCostController');
    Route::get('dashboard/performerEntry/{performerEntry}.{studio}','DashboardController@getPerformerEntry')->name('dashboard.performerEntry');


    Route::get('dashboard/event/performerEntry/{id}','DashboardController@getEventPerformerEntry')->name('dashboard.eventPerformerEntry');
    Route::get('downloadEventMusic/{event}', 'DashboardController@downloadEventMusic')->name('downloadEventMusic');


    Route::post('dashboard/orderPerformerEntry/','DashboardController@orderPerformerEntry')->name('orderPerformerEntry');


});


Route::name('studio.')->group(function () {
    Route::group(['namespace' => 'Studio', 'prefix' => 'studio', 'middleware' => ['role:studio','approved','auth']], function () {
        Route::resource('studio', 'StudioController');


        //Contestent
        Route::resource('performer', 'PerformerController');

        Route::resource('performerEntry', 'PerformerEntryController');
        Route::post('performer/importExcel','PerformerController@importExcel')->name('importExcel');

        Route::get('downloadExcel', 'PerformerController@downloadExcel')->name('downloadExcel');

        Route::get('performerEntry/create/{id}','PerformerEntryController@create')->name('performerEntry.create');

        Route::get('performerEntry/duplicate/{performerEntry}', 'PerformerEntryController@duplicate')->name('performerEntry.duplicate');
        Route::post('performerEntry/duplicateCreate', 'PerformerEntryController@duplicateCreate')->name('performerEntry.duplicateCreate');

        Route::get('checkout', 'PerformerEntryController@checkout')->name('checkout');
        //payment form
        Route::get('/payment', 'PaymentController@index');
        // route for processing payment
        Route::post('paypal', 'PaymentController@payWithpaypal')->name('paypal');
        // route for check status of the payment
        Route::get('status/', 'PaymentController@getPaymentStatus')->name('status');

        Route::get('dashboard/studioPerformerEntry/{paidPerformerEntry}','PerformerEntryController@getStudioPerformerEntry')->name('dashboard.studioPerformerEntry');

        Route::get('generatePdf', 'PerformerEntryController@generatePdf')->name('generatePdf');
    });
});
