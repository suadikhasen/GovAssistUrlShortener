<?php

namespace App\Jobs;

use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InActiveUrlRemover
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $lastVisitDay = Carbon::now()->subDays(30);

        Url::query()
            ->whereDate('updated_at','<=',$lastVisitDay)
            ->delete();
    }
}
