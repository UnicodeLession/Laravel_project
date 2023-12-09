<?php
use Illuminate\Support\Facades\Route;

//Module Users
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
});
