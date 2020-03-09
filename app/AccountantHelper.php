<?php

namespace App;

class AccountantHelper {

    function findProfit($amount){
        $profitPercent = 10;

        return $profitPercent * $amount / 100;
    }

}
