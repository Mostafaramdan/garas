<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class testLogin extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->post('/dashboard/login', [
            'email' => 'demo@magdsoft.com',
            'password' => '123456'
        ]);
 
        $this->assertStatus(200);
    }
}
