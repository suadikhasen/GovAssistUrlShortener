<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UrlShortenerController as ApiUrlShortenerController;

Route::controller(ApiUrlShortenerController::class)->group(function (){
    Route::post('shorten_url','shortenUrl')->name('shorten_url');
});



