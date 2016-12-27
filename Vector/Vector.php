<?php


namespace Vector;

use ArrayObject;
use Vector\Exceptions\VectorException;
use Vector\Contracts\VectorContract;
use Distance\EuclideanDistance;

/**
 *
 * @author Kabelo Masemola <kabelo.m@imisglobal.com>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package MariWeb HMI Framework
 * @reference https://en.wikipedia.org/wiki/Matrix_(mathematics)
 * @notes <* ? *>
 */
class Vector extends ArrayObject implements VectorContract
{
    protected $_cols;
    protected $_euclid;

    /**
     * Vector constructor.
     * @param array|null|object $value
     * @param bool $zeroVector
     */
    public function __construct($value, $zeroVector = false)
    {
        $this->_euclid = new EuclideanDistance();
        if ($value instanceof self) {
            parent::__construct($value);
            $this->_cols = $value->_cols;
        } else if (is_numeric($value) && $zeroVector == true) {
            $value2 = [];
            for($i =0;$i< $value;$i++){
                $value2[] = 0;
            }
            parent::__construct($value2);
            $this->_cols = $value;
        } else if (is_array($value)) {
            parent::__construct($value);
            $this->_cols = count($value);
        } else {
            throw new VectorException('Cannot create Vector');
        }

    }

    /**
     * Returns the vector's euclidean norm
     * @return float
     */
    public function length()
    {
        return $this->_euclid->distance($this);
    }

    /**
     * @param VectorContract $vector
     * @return array
     */
    public function vectorAddition(VectorContract $vector)
    {
        if ($this->_cols !== $vector->_cols) {
            if ($this->_cols > $vector->_cols) {
                array_pad($vector, ($this->_cols - $vector->_cols), 0);
                $vector->_cols = $this->_cols;
            } else if ($vector->_cols > $this->_cols) {
                array_pad($this, ($vector->_cols - $this->_cols), 0);
                $this->_cols = $vector->_cols;
            }
        }
        $resultantVector = [];
        for ($i = 0; $i < $this->_cols; $i++) {
            $resultantVector[] = $vector[$i] + $this[$i];
        }
        return new Vector($resultantVector);
    }

    /**
     * @param VectorContract $vector
     * @return array
     */
    public function vectorSubtraction(VectorContract $vector)
    {
        if ($this->_cols !== $vector->_cols) {
            if ($this->_cols > $vector->_cols) {
                array_pad($vector, ($this->_cols - $vector->_cols), 0);
                $vector->_cols = $this->_cols;
            } else if ($vector->_cols > $this->_cols) {
                array_pad($this, ($vector->_cols - $this->_cols), 0);
                $this->_cols = $vector->_cols;
            }
        }
        $resultantVector = [];
        for ($i = 0; $i < $this->_cols; $i++) {
            $resultantVector[] = $this[$i] - $vector[$i];
        }
        return new Vector($resultantVector);
    }

    /**
     * @param VectorContract $vector
     * @return int|mixed
     */
    public function dotProduct(VectorContract $vector)
    {
        if ($this->_cols !== $vector->_cols) {
            if ($this->_cols > $vector->_cols) {
                array_pad($vector, ($this->_cols - $vector->_cols), 0);
                $vector->_cols = $this->_cols;
            } else if ($vector->_cols > $this->_cols) {
                array_pad($this, ($vector->_cols - $this->_cols), 0);
                $this->_cols = $vector->_cols;
            }
        }
        $innerProduct = 0;
        for ($i = 0; $i < $this->_cols; $i++) {
            $innerProduct += $this[$i] * $vector[$i];
        }
        return $innerProduct;

    }

    public function crossProduct(VectorContract $vector)
    {
        // TODO: Implement crossProduct() method.
    }

    /**
     * @param $scalar
     * @return array
     */
    public function scalarMultiplication($scalar)
    {
        $result = [];
        for($i = 0; $i < $this->_cols;$i++){
            $result[$i] = $this[$i]*$scalar;
        }

        return new Vector($result);
    }
    
    public function setVector($value, $zeroVector = false){
        $this->_euclid = new EuclideanDistance();
        if ($value instanceof self) {
            parent::__construct($value);
            $this->_cols = $value->_cols;
        } else if (is_numeric($value) && $zeroVector == true) {
            $value2 = [];
            array_add($value2, $value, 0);
            parent::__construct($value);
            $this->_cols = $value2;
        } else if (is_array($value)) {
            parent::__construct($value);
            $this->_cols = count($value);
        } else {
            throw new VectorException('Cannot create Vector');
        }
    }

}