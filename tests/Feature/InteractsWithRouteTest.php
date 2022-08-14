<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class InteractsWithRouteTest extends TestCase
{
    use WithFaker;
    private $api_end_point = 'http://127.0.0.1:8000/api/';
    
    // Assert function to test model and brand are required fields to add device 
    public function test_model_and_brand_required_fields_for_adding_devices()
    {
        $model = $this->faker->name;
        $release_date = $this->faker->date('Y/m');
        $response = $this->json('POST', $this->api_end_point.'devices', [
            'release_date' => $release_date
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('model');
        $response->assertJsonValidationErrors('brand');
        $response->assertJson([
            "message" => "The model field is required. (and 1 more error)",
            "errors" => [
                "model" => ["The model field is required."],
                "brand" => ["The brand field is required."]
            ]
        ]);
    }

    // Assert function to test release date is in (Y/m) format 
    public function test_release_date_is_in_valid_format()
    {
        $release_date = $this->faker->dateTimeBetween('-30 days', '+30 days');
        $actual = $release_date->format('Y/m');
        $expected = Carbon::parse($release_date)->format('Y/m');
  
        $this->assertEquals(
            $expected,
            $actual,
            "actual value is equal to expected"
        );  
    }
}
