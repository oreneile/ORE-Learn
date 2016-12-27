<?php
/**
 * Created by PhpStorm.
 * User: kabelo
 * Date: 2016/12/19
 * Time: 2:40 PM
 */

namespace Classifiers\ANN\Contracts;


interface NetworkContract
{
    public function train();
    public function run($data);
}