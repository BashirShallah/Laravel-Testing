<?php

namespace Tests\Unit;

use App\AccountantHelper;
use PHPUnit\Framework\TestCase;

class AccountantTest extends TestCase {

    /** @test */
    function it_can_find_profit(){
        $profit = AccountantHelper::findProfit(100);

        $this->assertEquals(10, $profit);

        $this->assertLessThan(100, $profit);
    }

}
