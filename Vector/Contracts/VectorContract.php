<?php

namespace Vector\Contracts;

/**
 * Vector Interface
 * @author Kabelo Masemola <kabelo.m@imisglobal.com>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package MariWeb HMI Framework
 * @notes <* ? *>
 */
interface VectorContract
{
    public function length();
    public function vectorAddition(VectorContract $vector);
    public function vectorSubtraction(VectorContract $vector);
    public function dotProduct(VectorContract $vector);
    public function crossProduct(VectorContract $vector);
    public function scalarMultiplication($scalar);
    public function setVector($value, $zeroVector);

}