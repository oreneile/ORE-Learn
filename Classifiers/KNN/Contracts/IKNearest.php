<?php

namespace Classifiers\KNN\Contracts;


interface IKNearest
{
    public function classify($k,$subject);
    public function setDataPath($Path);
    public function setRawData($data);
    public function getDataPath();
    public function getRawData();
}
