<?php

namespace Distance;
use Distance\Contracts\DistanceContract;
use Distance\Contracts\SimilarityContract;
/**
 * Euclidean
 *  d(VectorA,VectorB) = sqrt(sum( (Vax - Vbx)^2 )); where Va and Vb are vector elements and x is element count.
 *
 * @author Kabelo Masemola <masemolakrp@spaneng.co.za>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package Ore 
 * @reference https://en.wikipedia.org/wiki/Euclidean_distance
 * @notes <* ? *>
 */
class EuclideanDistance implements DistanceContract,SimilarityContract
{
    /**
     * This method Accepts two vectors (indexed arrays with numeric values)
     * @param $VectorA
     * @param $VectorB
     * @return double
     */
    public function distance(&$VectorA, &$VectorB = [])
    {
        if(!empty($VectorB)) {


            $ACount = count($VectorA);
            $BCount = count($VectorB);
            //Check if one vector is longer that the another one then pad the extra dimensions with zeros
            if ($ACount !== $BCount) {
                $A = max($VectorA, $VectorB);
                $B = min($VectorA, $VectorB);
                unset($VectorA, $VectorB);
                $VectorA = $A;
                $VectorB = $B;
                $ACount = count($VectorA);
                $BCount = count($VectorB);
                for ($i = 0; $i < ($ACount - $BCount); $i++) {
                    $VectorB[] = 0;
                }
            }
            $result = 0;
            for ($i = 0; $i < $ACount; $i++) {
                $result += pow($VectorA[$i] - $VectorB[$i], 2);
            }
        }else{
            //This is useful if you are not calculating the distance between two vectors,but just the length of one
            $ACount = count($VectorA);
            $result = 0;
            for ($i = 0; $i < $ACount; $i++) {
                $result += pow($VectorA[$i], 2);
            }

        }
        return sqrt($result);

    }

    /**
     * This method Accepts two vectors (indexed arrays with numeric values)
     * @param $VectorA
     * @param $VectorB
     * @return float
     */
    public function similarity(&$VectorA, &$VectorB)
    {
        //A similarity can be viewed as an inverse of a distance, in the euclidean vector space
        //But to avoid inverting a zero, add one.then invert
        return 1/( 1 + $this->distance($VectorA,$VectorB));
    }


}