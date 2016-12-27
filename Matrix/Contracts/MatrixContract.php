<?php

namespace Matrix\Contracts;

/**
 * Matrix interface
 * @author Kabelo Masemola <masemolakrp@spaneng.co.za>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package Ore 
 * @notes <* ? *>
 */
interface MatrixContract
{
    public function add($value);
    public function subtract($value);
    public function multiply($value);
    public function subMatrix($rowOffset,$colOffset);
    public function determinant();
    public function cofactor();
    public function transpose();
    public function adjugate();
    public function inverse();
    public function getRows();
    public function getCols();
    public function equals(MatrixContract $matrix);
    public function isSquare();
    public function randomize();
}