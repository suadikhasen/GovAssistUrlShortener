<?php

namespace App\Actions;

use App\Models\Url;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 *Action to creat url.
 */
class CreateUrlAction
{
    /**
     * @param array $data
     * @return Builder|Model
     */
    public function execute(array $data): Model|Builder
    {
       return Url::query()->create($data);
    }
}
