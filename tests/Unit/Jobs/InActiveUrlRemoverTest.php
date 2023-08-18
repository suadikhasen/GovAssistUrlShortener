<?php

namespace Tests\Unit\Jobs;

use App\Jobs\InActiveUrlRemover;
use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 *
 */
class InActiveUrlRemoverTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function should_remove_in_active_urls(): void
    {
        /*Delete all urls */
        Url::query()->delete();

        /*create 100 row data that are not visited for the last 30 days*/
        Url::factory()->count(100)->create([
            'updated_at' => Carbon::now()->subDays(31),
        ]);

        $job = new InActiveUrlRemover();
        $job->handle();

        $this->assertDatabaseCount('urls',0);
    }

    /**
     * @test
     * @return void
     */
    public function should_not_remove_active_urls(): void
    {
        /*Delete all urls */
        Url::query()->delete();

        /*create 100 row data that are not visited for the last 30 days*/
        Url::factory()->count(100)->create([
            'updated_at' => Carbon::yesterday(),
        ]);


        $job = new InActiveUrlRemover();
        $job->handle();

        $this->assertDatabaseCount('urls',100);
    }
}
