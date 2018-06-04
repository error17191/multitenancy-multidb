<?php


Route::get('home', 'HomeController@index')->name('home');

Route::get('test', function () {
    dd(app(App\Tenants\Manager::class)->getTenant());
});