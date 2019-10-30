<?php
    Route::group(['prefix' => config('dunbar.endpoint')], function () {
        Route::any('{url?}', 'UdaraJay\Dunbar\Http\Controllers\RequestController@handle')->where('url', '(.*)');
    });
?>
