<?php

namespace Distance\Contracts;
/**
 * Distance Interface, This is the API for all distance operations
 * @author Kabelo Masemola <masemolakrp@spaneng.co.za>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package Ore 
 * @notes <* ? *>
 */
interface DistanceContract
{
    public function distance(&$VectorA,&$VectorB);
}