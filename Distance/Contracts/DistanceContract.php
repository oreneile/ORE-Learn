<?php

namespace Distance\Contracts;
/**
 * Distance Interface, This is the API for all distance operations
 * @author Kabelo Masemola <kabelo.m@imisglobal.com>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package MariWeb HMI Framework
 * @notes <* ? *>
 */
interface DistanceContract
{
    public function distance(&$VectorA,&$VectorB);
}