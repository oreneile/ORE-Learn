<?php


namespace Distance;
namespace Distance;
use Distance\Contracts\DistanceContract;
use Distance\Contracts\SimilarityContract;

/**
 * Pearson Correlation score
 *
 * @author Kabelo Masemola <kabelo.m@imisglobal.com>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package MariWeb HMI Framework
 * @reference https://en.wikipedia.org/wiki/Pearson_product-moment_correlation_coefficient
 * @notes <* ? *>
 */

class PearsonCorrelation implements SimilarityContract,DistanceContract
{

    public function distance(&$VectorA, &$VectorB)
    {
        // TODO: Implement distance() method.
    }

    public function similarity(&$VectorA, &$VectorB)
    {
        // TODO: Implement similarity() method.
    }
}