<?php
use Illuminate\Support\Facades\Route;
Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('lessons')->name('lessons.')->group(function () {
        Route::get('/', 'LessonController@index')->name('index');
        Route::get('data', 'LessonController@data')->name('data');
        Route::get('create', 'LessonController@create')->name('create');
        Route::post('create', 'LessonController@store')->name('store');
        Route::get('edit/{teacher}', 'LessonController@edit')->name('edit');
        Route::put('edit/{teacher}', 'LessonController@update')->name('update');
        Route::delete('delete/{teacher}', 'LessonController@delete')->name('delete');
    });
});

