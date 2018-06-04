<?php

Route::get('test', function () {
    dd(app(App\Tenants\Manager::class)->getTenant());
});