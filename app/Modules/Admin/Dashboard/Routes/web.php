<?php

Route::group(['prefix' => 'dashboard', 'middleware' => []], function () {
    Route::get('/',['uses' => 'DashboardController@index','as' => 'dashboard.index']);
});