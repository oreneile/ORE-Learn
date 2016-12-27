<?php

namespace Utilities;
/**
 *
 * @author Kabelo Masemola <masemolakrp@spaneng.co.za>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package Ore 
 * @reference https://en.wikipedia.org/wiki/Matrix_(mathematics)
 * @notes <* ? *>
 */

class Utils
{
    public static function rand($min, $max, $decimals = 0) {
        $scale = pow(10, $decimals);
        return mt_rand($min * $scale, $max * $scale) / $scale;
    }

}