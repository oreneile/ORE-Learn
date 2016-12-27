<?php


namespace Matrix;
use ArrayObject;
use Matrix\Contracts\MatrixContract;
use Matrix\Exceptions\MatrixException;
use Utilities\Utils;
/**
 *
 * @author Kabelo Masemola <masemolakrp@spaneng.co.za>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package Ore 
 * @reference https://en.wikipedia.org/wiki/Matrix_(mathematics)
 * @notes <* ? *>
 */

class Matrix extends ArrayObject implements MatrixContract
{

    /**
     * Number of rows in the matrix.
     *
     * @var int
     */
    private $_rows;

    /**
     * Number of columns in the matrix.
     *
     * @var int
     */
    private $_cols;

    /**
     * Matrix constructor.
     * @param array|null|object $value | int $value
     * @param null $cols
     * @throws MatrixException
     */
    public function __construct($value, $cols = null)
    {
        if ($value instanceof self) {
            parent::__construct($value);
            $this->_rows = $value->_rows;
            $this->_cols = $value->_cols;
        } else if (is_array($value) && $cols == null) {
            parent::__construct($value);
            $this->_rows = count($value);
            $this->_cols = count($value[0]);
        } else if (is_numeric($value) && is_numeric($cols)
            && $value > 0 && $cols > 0
        ) {
            $this->_rows = $value;
            $this->_cols = $cols;
            for ($r = 0; $r < $this->_rows; $r++) {
                $this[$r] = [];
                for ($c = 0; $c < $this->_cols; $c++) {
                    $this[$r][$c] = 0;
                }
            }
        } else {
            throw new MatrixException('Cannot create matrix');
        }
    }

    /**
     * Add another matrix or a scalar to this matrix,
     * return a new matrix instance.
     *
     * @param mixed $value Matrix or scalar to add to this Matrix
     * @return Matrix New result matrix
     * @throws MatrixException If matrices do not have the same size
     */
    public function add($value)
    {
        if ($value instanceof self) {
            $matrix = $value;
            if ($this->_rows == $matrix->_rows && $this->_cols == $matrix->_cols) {
                $result = new self($this);
                for ($r = 0; $r < $this->_rows; $r++) {
                    for ($c = 0; $c < $this->_cols; $c++) {
                        $result[$r][$c] += $matrix[$r][$c];
                    }
                }
                return $result;
            }
            throw new MatrixException('Cannot add matrices: matrices do not have the same size');
        } else {
            $result = new self($this);
            for ($r = 0; $r < $result->_rows; $r++) {
                for ($c = 0; $c < $result->_cols; $c++) {
                    $result[$r][$c] += $value;
                }
            }
            return $result;
        }
    }

    /**
     * Subtract another matrix or a scalar to this matrix,
     * return a new matrix instance.
     *
     * @param mixed $value matrix or scalar to subtract to this matrix
     * @return Matrix New result matrix
     * @throws MatrixException If matrices do not have the same size
     */
    public function subtract($value)
    {
        if ($value instanceof self) {
            $matrix = $value;
            if ($this->_rows == $matrix->_rows && $this->_cols == $matrix->_cols) {
                $result = new self($this);
                for ($r = 0; $r < $this->_rows; $r++) {
                    for ($c = 0; $c < $this->_cols; $c++) {
                        $result[$r][$c] -= $matrix[$r][$c];
                    }
                }
                return $result;
            }
            throw new MatrixException('Cannot subtract matrices: matrices do not have the same size');
        } else {
            $result = new self($this);
            for ($r = 0; $r < $result->_rows; $r++) {
                for ($c = 0; $c < $result->_cols; $c++) {
                    $result[$r][$c] -= $value;
                }
            }
            return $result;
        }
    }


    public function randomize()
    {
        for($i = 0; $i < count($this);$i++){
            for($j = 0;$j < count($this[$i]);$j++){
                $this[$i][$j] = Utils::rand(0,1,2);
            }
        }
    }
    
    /**
     * Multiply another matrix or a scalar to this matrix,
     * return a new matrix instance.
     *
     * @param mixed $value matrix or scalar to multiply to this matrix
     * @return Matrix New result matrix
     * @throws MatrixException If matrices are incompatible
     */
    public function multiply($value)
    {
        if ($value instanceof self) {
            $matrix = $value;
            if ($this->_cols != $matrix->_rows) {
                throw new MatrixException('Cannot multiply matrices: incompatible matrices');
            }
            $resultArray = [];
            for ($i = 0; $i < $this->_rows; $i++) {
                for ($j = 0; $j < $matrix->_cols; $j++) {
                    $resultArray[$i][$j] = 0;
                    for ($k = 0; $k < $matrix->_rows; $k++) {
                        $resultArray[$i][$j] += $this[$i][$k] * $matrix[$k][$j];
                    }
                }
            }
            return new self($resultArray);
        } else {
            $result = new self($this->_rows, $this->_cols);
            for ($r = 0; $r < $result->_rows; $r++) {
                for ($c = 0; $c < $result->_cols; $c++) {
                    $result[$r][$c] = $this[$r][$c] * $value;
                }
            }
            return $result;
        }
    }

    /**
     * Return a new sub matrix from this matrix.
     *
     * @param int $rowOffset Row offset to avoid
     * @param int $colOffset Col offset to avoid
     * @return Matrix The new sub matrix
     */
    public function subMatrix($rowOffset, $colOffset)
    {
        $subArray = [];
        for ($r = 0, $sR = 0; $r < $this->_rows; $r++) {
            if ($r != $rowOffset) {
                $subArray[$sR] = [];
                for ($c = 0, $sC = 0; $c < $this->_cols; $c++) {
                    if ($c != $colOffset) {
                        $subArray[$sR][$sC] = $this[$r][$c];
                        $sC++;
                    }
                }
                $sR++;
            }
        }
        return new self($subArray);
    }

    /**
     * Computes the matrix's determinant.
     *
     * @return float The matrix's determinant
     * @throws MatrixException If matrix is not a square
     */
    public function determinant()
    {
        if (!$this->isSquare()) {
            throw new MatrixException('Cannot compute determinant of non square matrix!');
        }
        if ($this->_rows == 2) {
            return $this[0][0] * $this[1][1] - $this[0][1] * $this[1][0];
        } else {
            $out = 0;
            for ($c = 0; $c < $this->_cols; $c++) {
                if ($this[0][$c])
                    $out += pow(-1, $c + 2) * $this[0][$c] * $this->subMatrix(0, $c)->determinant();
            }
            return $out;
        }
    }

    /**
     * Compute cofactor matrix from this one,
     * return a new matrix instance.
     *
     * @return Matrix The new computed matrix
     */
    public function cofactor()
    {
        $cofactorArray = [];
        for ($c = 0; $c < $this->_cols; $c++) {
            $cofactorArray[$c] = [];
            for ($r = 0; $r < $this->_rows; $r++) {
                if ($this->_cols == 2) {
                    $cofactorArray[$c][$r] = pow(-1, $c + $r) * $this->subMatrix($c, $r)[0][0];
                } else {
                    $cofactorArray[$c][$r] = pow(-1, $c + $r) * $this->subMatrix($c, $r)->determinant();
                }
            }
        }
        return new self($cofactorArray);
    }

    /**
     * Gets a new transposed matrix from this one,
     * return a new matrix instance.
     *
     * @return Matrix The new transposed matrix
     */
    public function transpose()
    {
        $resultArray = [];
        for ($i = 0; $i < $this->_cols; $i++) {
            for ($j = 0; $j < $this->_rows; $j++) {
                $resultArray[$i][$j] = $this[$j][$i];
            }
        }
        return new self($resultArray);
    }

    /**
     * Adjugate the matrix,
     * return a new matrix instance.
     *
     * @return Matrix The computed matrix
     */
    public function adjugate()
    {
        return $this->cofactor()->transpose();
    }

    /**
     * Inverse this matrix if and only if the determinant is not null,
     * return a new matrix instance.
     *
     * @return Matrix The inverted matrix
     * @throws MatrixException If determinant is null
     */
    public function inverse()
    {
        $det = $this->determinant();
        if ($det == 0) {
            throw new MatrixException('Cannot invert matrix: determinant is nul!');
        }
        return $this->adjugate()->multiply(1 / $det);
    }

    /**
     * Returns human readable matrix string like a pseudo table.
     *
     * @return string The matrix
     */
    public function __toString()
    {
        $out = '';
        for ($r = 0; $r < $this->_rows; $r++) {
            for ($c = 0; $c < $this->_cols; $c++) {
                if ($c) {
                    $out .= "\t";
                }
                $out .= $this[$r][$c];
            }
            $out .= "\n";
        }
        return $out;
    }

    /**
     * Get the number of rows.
     *
     * @return int The number of rows
     */
    public function getRows()
    {
        return $this->_rows;
    }

    /**
     * Get the number of columns.
     *
     * @return int The number of columns
     */
    public function getCols()
    {
        return $this->_cols;
    }

    /**
     * Checks if two matrices are equal in value.
     *
     * @param MatrixContract $matrix The second matrix
     * @return boolean
     */
    public function equals(MatrixContract $matrix)
    {
        if ($this->_rows != $matrix->_rows || $this->_cols != $matrix->_cols) {
            return false;
        }
        for ($r = 0; $r < $this->_rows; $r++) {
            for ($c = 0; $c < $this->_cols; $c++) {
                if ($this[$r][$c] != $matrix[$r][$c]) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Return true if the matrix is a square matrix.
     *
     * @return boolean
     */
    public function isSquare()
    {
        return $this->_rows == $this->_cols;
    }

  
}