<?php

namespace Tests\Unit;

use App\Cart;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public $cart;

    public function setUp(): void
    {
        $cart = new Cart;

        $item = array(
            'id' => 'sku_123ABC',
            'qty' => 1,
            'price' => 39.95,
            'name' => 'T-Shirt',
            'options' => array('Size' => 'L', 'Color' => 'Red')
        );

        $cart->insert($item);

        $this->cart = $cart;
    }

    /** @test */
    public function we_can_add_an_item_to_the_cart()
    {
        $this->assertCount(1, $this->cart->getItems());
    }

    /** @test */
    public function we_can_count_items()
    {
        $this->assertEquals(1, $this->cart->count());
    }

    /** @test */
    public function we_can_calculate_the_total_amount()
    {
        $this->assertEquals( 39.95, $this->cart->total());
    }
}
