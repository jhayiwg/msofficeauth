<?php

Route::group(
    ['namespace' => '\LaraOffice\MsOfficeAuth\Controllers', 'middleware' => ['web']],
    function () {
        Route::get('/office/signin', 'OfficeController@signin');
        Route::get('/office/auth', 'OfficeController@callback');
        Route::get('/office/signout', 'OfficeController@signout');
    }
);