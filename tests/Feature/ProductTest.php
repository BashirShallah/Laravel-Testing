<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = Product::create([
            'name' => 'Car',
            'price' => 100
        ]);
    }

    public function test_user_can_list_products()
    {
        $response = $this->get('/products');

        $response->assertStatus(200)
            ->assertSee('Car');
    }

    public function test_user_can_see_product_details(){
        $response = $this->get('/products/' . $this->product->id);

        $response->assertStatus(200)
            ->assertSee('Car')
            ->assertSee('100');
    }
}
