<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductController;
use App\Models\Historic;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class BulkProductTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    protected $uploadedFile = __DIR__ . '/../resources/products.csv';

    public function test_should_bulk_create()
    {
        $name = Str::random(8).'.csv';
        $path = sys_get_temp_dir().'/'.$name;

        copy($this->uploadedFile, $path);

        $file = new UploadedFile($path, $name, 'text/csv', null, true);


        $user = User::factory()->create();
        $this->assertDatabaseCount('products', 0);
        $this->withoutExceptionHandling();

        $response = $this->actingAs($user)->call('POST', '/api/products/bulk', [], [], ['filename' => $file]
        );

        $response->assertStatus(201);
        $this->assertDatabaseCount('products', 10);
    }
}
