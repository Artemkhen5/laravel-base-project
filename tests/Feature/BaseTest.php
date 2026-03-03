<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

abstract class BaseTest extends TestCase
{
    use DatabaseTransactions;

    protected string $model;
    protected string $route;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function testCorrectMethodIndex(): void
    {
        $this->model::factory(3)->create([
            'user_id' => $this->user->id,
        ]);
        $response = $this->get(route($this->route . '.index'));
        $response->assertStatus(200)->assertJsonCount(3);
    }

    public function testCorrectMethodIndexWithRange(): void
    {
        $this->model::factory(3)->create([
            'user_id' => $this->user->id,
        ]);
        $response = $this->get(route($this->route . '.index', ['range' => json_encode([0, 1])]));
        $response->assertStatus(200)->assertJsonCount(2);
        $response->assertHeader('X-Limit', 2);
        $response->assertHeader('X-Offset', 0);
    }

    public function testCorrectMethodIndexWithSort(): void
    {
        $models = $this->model::factory(3)->create([
            'user_id' => $this->user->id,
        ]);
        $response = $this->get(
            route($this->route . '.index', ['sort' => json_encode(['id', 'desc'])]),
        );
        $response->assertStatus(200);
        $this->assertEquals($models->last()->id, $response->json()[0]['id']);
    }
}
