<?php

namespace Distance;


use Distance\Contracts\DistanceContract;
use Distance\Contracts\SimilarityContract;
use Vector\Vector;
use Distance\EuclideanDistance;

/**
 * Cosine Similarity
 * cos(theta) = A•B / |A||B|
 * '•' means inner product
 *
 * @author Kabelo Masemola <kabelo.m@imisglobal.com>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package MariWeb HMI Framework
 * @reference https://en.wikipedia.org/wiki/Cosine_similarity
 * @notes <* ? *>
 */
class CosineSimilarity implements DistanceContract,SimilarityContract
{
    protected $_euclid;
    /**
     * CosineSimilarity constructor.
     */
    public function __construct()
    {
        $this->_euclid = new EuclideanDistance();
    }


    /**
     * This method Accepts two vectors (indexed arrays with numeric values)
     * @param $VectorA
     * @param $VectorB
     * @return double
     */
    public function distance(&$VectorA, &$VectorB)
    {
        return 1-$this->similarity($VectorA,$VectorB);
    }

    /**
     * @param $VectorA
     * @param $VectorB
     * @return double
     */

    public function similarity(&$VectorA, &$VectorB)
    {
        $VectorA = new Vector($VectorA); 
        $VectorB = new Vector($VectorB);
        $innerProduct = $VectorA->dotProduct($VectorB);
        $normA = $VectorA->length();
        $normB = $VectorB->length();
        $normProduct = $normA*$normB;
        return $innerProduct/$normProduct;
    }
}