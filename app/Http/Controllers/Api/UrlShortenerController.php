<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateUrlAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShortenUrlRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *Controller used to handle api routes
 */
class UrlShortenerController extends Controller
{
    /**
     * Shorten the given url
     * @param ShortenUrlRequest $shortenUrlRequest
     * @param CreateUrlAction $createUrlAction
     * @return JsonResponse
     */
    public function shortenUrl(ShortenUrlRequest $shortenUrlRequest, CreateUrlAction $createUrlAction): JsonResponse
    {
        $url = $createUrlAction->execute($shortenUrlRequest->validated());
        return (new UrlResource($url))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
