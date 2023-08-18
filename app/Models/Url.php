<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Url model
 *
 * @property int $id
 * @property string $destination
 * @property string $slug
 * @property int $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $shortened_url
 * @method static \Database\Factories\UrlFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Url newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Url newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Url query()
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereViews($value)
 * @mixin \Eloquent
 */
class Url extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $appends = ['shortened_url'];
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'destination',
        'slug',
        'views',
    ];

    /**
     * Accessor for the appended shortened url property
     * @return string
     */
    public function getShortenedUrlAttribute(): string
    {
        return config('app.url').'/'.$this->slug;
    }


}
