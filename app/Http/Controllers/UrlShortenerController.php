<?php

namespace App\Http\Controllers;

use App\Actions\CreateUrlAction;
use App\Http\Requests\ShortenUrlRequest;
use App\Models\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 *Url shortener controller
 */
class UrlShortenerController extends Controller
{

    /**
     * Redirect to the original url :if there is the url parameter and the slug is not expired
     * Redirect to home page if there is no url parameter or if the short url is expired
     * @param Url|null $url
     * @return RedirectResponse|View
     */
    public function index(Url $url=null): RedirectResponse|View
    {
        /**
         * check if the url is not exist , then redirect to home page
         */
        if (!$url){
            if (auth()->check()){
                return redirect('url_shortener_dashboard');
            }
            return view('welcome');
        }
        /*increment views column and redirect to the original url*/
        $url->increment('views');
        return redirect()->away($url->destination);
    }

    /**
     * Used to shorten url
     * @param ShortenUrlRequest $shortenUrlRequest
     * @param CreateUrlAction $createUrlAction
     * @return RedirectResponse
     */
    public function shortenUrl(ShortenUrlRequest $shortenUrlRequest,CreateUrlAction $createUrlAction): RedirectResponse
    {
        $url = $createUrlAction->execute($shortenUrlRequest->validated());
        return redirect()->to('url_shortener_dashboard')->with('success','Link generated successfully.');
    }

    /**
     * Url shortener dashboard.
     * @return View
     */
    public function urlShortenerDashboard(): View
    {
        /*fetch latest 10 links. */
        $links = Url::query()->latest()->limit(10)->get();
        return view('dashboard',compact('links'));
    }
}
