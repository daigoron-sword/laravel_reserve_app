<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagementControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('createSource', ['branch' => 'room']));

        $response->assertStatus(400)
            ->assertViewIs('management.source.create');
    }
}
