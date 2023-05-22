<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $service = new UserService();
        $result = $service->listUser(array('id'=>1));
        $this->assertTrue(TRUE);
        // $response = $this->get('/');

        // $response->assertStatus(200);
    }
}
