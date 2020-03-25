<?php

namespace Tests\Feature;

use App\Category;
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

    public function test_a_product_can_belongs_to_a_category(){
        // arrange
        $product = factory(Product::class)->create();
        $category = factory(Category::class)->create();

        // assert
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
            'category_id' => $category->id,
        ]);

        // act
        $product->setCategory($category);

        // assert
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'category_id' => $category->id,
        ]);
    }

    public function test_it_prevent_changing_the_product_category(){
        $product = factory(Product::class)->create();
        $category = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();

        $product->setCategory($category);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('You can not change the product category');

        $product->setCategory($category2);
    }
}
