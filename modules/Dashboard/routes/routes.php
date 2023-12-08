<?php
use Illuminate\Support\Facades\Route;

//Module Users
Route::group(['namespace' => 'Modules\Dashboard\src\Http\Controllers'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard.index');
    });
});
