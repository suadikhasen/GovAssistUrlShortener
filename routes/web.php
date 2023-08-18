<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortenerController;


//authentication routes
require __DIR__.'/auth.php';


Route::controller(UrlShortenerController::class)->middleware('auth')->group(function () {

    //url shortener dashboard
     Route::get('url_shortener_dashboard','urlShortenerDashboard')->name('url_shortener_dashboard');

    //route used for shortening destination
      Route::post('shorten_url','shortenUrl')->name('shorten_url');

});

//route used for handling the shortened url and the landing page
Route::get('/{url:slug?}',[UrlShortenerController::class,'index'])->name('index');



