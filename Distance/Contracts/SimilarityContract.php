<?php

namespace Distance\Contracts;

/**
 * Similarity Interface, This is the API for all similarity operations
 * @author Kabelo Masemola <kabelo.m@imisglobal.com>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package MariWeb HMI Framework
 * @notes <* ? *>
 */
interface SimilarityContract
{
    public function similarity(&$VectorA, &$VectorB);

}
