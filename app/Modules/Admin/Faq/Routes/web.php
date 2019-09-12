<?php

Route::group(['prefix' => 'faqs', 'middleware' => []], function () {
    Route::get('/', 'FaqController@index')->name('faqs.index');
    Route::post('/', 'FaqController@store')->name('faqs.create');
    Route::get('/{faq}', 'FaqController@show')->name('faqs.read');
    Route::put('/{faq}', 'FaqController@update')->name('faqs.update');
    Route::delete('/{faq}', 'FaqController@destroy')->name('faqs.delete');
});