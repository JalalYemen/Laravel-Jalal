<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::view('/', 'index')->name('index');
Route::view('/profile', 'pages-profile')->name('pages-profile');
Route::view('/charts', 'charts-chartsjs')->name('charts-chartsjs');
Route::view('/forms', 'forms-basic-inputs')->name('forms-basic-inputs');
Route::view('/icons', 'icons-feather')->name('icons-feather');
Route::view('/maps', 'maps-google')->name('maps-google');
Route::view('/blank', 'pages-blank')->name('pages-blank');
Route::view('/invoice', 'pages-invoice')->name('pages-invoice');
Route::view('/settings', 'pages-settings')->name('pages-settings');
Route::view('/sign-in', 'pages-sign-in')->name('pages-sign-in');
Route::view('/sign-up', 'pages-sign-up')->name('pages-sign-up');
Route::view('/ui-alerts', 'pages-ui-alerts')->name('pages-ui-alerts');
Route::view('/ui-buttons', 'pages-ui-buttons')->name('pages-ui-buttons');
Route::view('/ui-cards', 'pages-ui-cards')->name('pages-ui-cards');
Route::view('/ui-general', 'pages-ui-general')->name('pages-ui-general');
Route::view('/ui-grid', 'pages-ui-grid')->name('pages-ui-grid');
Route::view('/ui-typography', 'pages-ui-typography')->name('pages-ui-typography');
