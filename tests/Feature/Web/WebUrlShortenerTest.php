<?php

namespace Tests\Feature\Web;

use App\Models\Url;
use App\Models\User;
use App\Services\UrlService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 *
 */
class WebUrlShortenerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function un_authenticated_user_should_not_access_the_page(): void
    {
        $response = $this->get('/url_shortener_dashboard');
        $response->assertRedirectToRoute('login');
    }

    /**
     * @test
     */
    public function authenticated_user_should_access_the_page(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('url_shortener_dashboard');
        $response->assertOk();
        $response->assertViewIs('dashboard');
        $response->assertSeeText('Dashboard');
//        $response->assertSeeText('Enter your URL');

    }

    /**
     * @test
     */
    public function it_should_return_required_validation_error(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/shorten_url');
        $response->assertInvalid([
            'destination' => 'The destination field is required.'
        ]);
    }

    /**
     * @test
     */
    public function it_should_return_invalid_url_validation_error(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/shorten_url',['destination'=>'govassist']);
        $response->assertInvalid([
            'destination' => 'The destination field must be a valid URL.'
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_generate_short_url_for_valid_destination_input()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/shorten_url',['destination'=>'https://govassist.com/']);

        $this->assertDatabaseCount('urls',1);
        $this->assertDatabaseHas('urls',['destination'=>'https://govassist.com/']);

    }

    /**
     * @test
     * @return void
     */
    public function view_count_should_be_increased_and_should_redirect_to_the_original_url()
    {
        $url = Url::factory()->create([
            'slug' => UrlService::generateUniqueSlug()
        ]);

        $response = $this->get(config('app.url').'/'.$url->slug);

        $urlFromDatabase = Url::query()->latest()->first();

        $response->assertRedirect($url->destination);
        $this->assertDatabaseCount('urls',1);
        $this->assertDatabaseHas('urls',['destination'=>$url->destination]);
        $this->assertEquals(1,$urlFromDatabase->views);
    }

}


