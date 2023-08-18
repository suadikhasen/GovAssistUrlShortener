<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

/**
 *Url shortener feature test
 */
class UrlShortenerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_required_validation_error(): void
    {
       $response = $this->postJson('api/shorten_url');
       $response->assertUnprocessable();
       $response->assertExactJson([
           'destination' => [
               0 => 'The destination field is required.'
           ]
       ]);
    }

    /**
     * @test
     */
    public function it_should_return_invalid_url_validation_error(): void
    {
        $response = $this->postJson('api/shorten_url',['destination'=>'govassist']);
        $response->assertUnprocessable();
        $response->assertExactJson([
            'destination' => [
                0 => 'The destination field must be a valid URL.'
            ]
        ]);
    }


    /**
     * @test
     */
    public function it_should_create_shorten_url(): void
    {
        $response = $this->postJson('api/shorten_url',['destination'=>'http://google.com']);
        $response->assertCreated();
        $this->assertDatabaseCount('urls',1);
        $this->assertDatabaseHas('urls',['destination'=>'http://google.com']);
    }
}
