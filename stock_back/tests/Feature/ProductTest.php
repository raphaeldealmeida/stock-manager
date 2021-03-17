<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    public function test_should_list()
    {
        $user = User::factory()->create();
        Product::factory(10)->create();

        $response = $this->actingAs($user)
                        ->get('/api/products/');

        $response->assertStatus(200);
        $response->assertJsonCount(10);
    }

    public function test_should_create()
    {
        $user = User::factory()->create();
        $data = $this->getData();

        $response = $this->actingAs($user)
            ->post('/api/products/', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', $data);
    }

    public function test_should_edit()
    {
        $user = User::factory()->create();
        $data = $this->getData();
        $product = Product::factory()->create($data);

        $dataEdited = array_merge($data, ['name' => 'Edited Product']);

        $response = $this->actingAs($user)
            ->put('/api/products/1', $dataEdited);

        $response->assertStatus(200);
        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', $dataEdited);
    }

    public function test_should_delete()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create($this->getData());

        $response = $this->actingAs($user)
            ->delete('/api/products/1');

        $response->assertStatus(204);
        $this->assertDatabaseCount('products', 0);
    }

    public function test_should_show()
    {
        $user = User::factory()->create();
        $data = $this->getData();
        $product = Product::factory()->create($data);

        $response = $this->actingAs($user)
            ->get('/api/products/1');

        $response->assertStatus(200);
        $response->assertJson($data);

    }

    private function getData(){
        return [
            'name' => $this->faker->sentence(3, true),
            'price' => $this->faker->randomFloat(2, 1.00,   1000.00),
            'current_quantity' => $this->faker->numberBetween(0, 100),
        ];
    }
}
