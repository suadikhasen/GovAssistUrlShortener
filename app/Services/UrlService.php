<?php

namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Str;

/**
 *Additional service methods
 */
class UrlService
{
    /**
     * generate unique slug
     * @return string
     */
    public static  function generateUniqueSlug(): string
  {
      $string = Str::random(5);
      if (Url::query()->where('slug',$string)->exists())
         self::generateUniqueSlug();
      return $string;
  }
}
