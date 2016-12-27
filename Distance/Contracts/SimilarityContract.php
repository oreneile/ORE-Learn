<?php

namespace Distance\Contracts;

/**
 * Similarity Interface, This is the API for all similarity operations
 * @author Kabelo Masemola <masemolakrp@spaneng.co.za>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package Ore 
 * @notes <* ? *>
 */
interface SimilarityContract
{
    public function similarity(&$VectorA, &$VectorB);

}
