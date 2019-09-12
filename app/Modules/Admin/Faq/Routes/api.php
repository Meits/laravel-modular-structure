<?php

Route::group(['prefix' => 'faqs', 'middleware' => []], function () {
    Route::get('/', 'Api\FaqController@index')->name('faqs.index');
    Route::post('/', 'Api\FaqController@store')->name('faqs.create');
    Route::get('/{faq}', 'Api\FaqController@show')->name('faqs.read');
    Route::put('/{faq}', 'Api\FaqController@update')->name('faqs.update');
    Route::delete('/{faq}', 'Api\FaqController@destroy')->name('faqs.delete');
});