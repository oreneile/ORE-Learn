<?php

/**
 * K nearest Neighbor
 *
 * @author Kabelo Masemola <kabelo.m@imisglobal.com>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package MariWeb HMI Framework
 * @reference https://en.wikipedia.org/wiki/Cosine_similarity
 * @notes <* ? *>
 */
namespace Classifiers\KNN;
use Classifiers\KNN\Contracts\IKNearest;
use Distance\EuclideanDistance;

class KNearestNeighbor implements IKNearest
{
    protected $euclid;
    protected $data_path;
    protected $result_set = [];
    protected $training_data;

    /**
     * KNearestNeighbor constructor.
     */
    public function __construct()
    {
        $this->euclid = new EuclideanDistance();
    }

    public function classify($k, $subject)
    {
        $subjectValues = array_values($subject);

        foreach ($this->training_data as $label =>$data){
            $distance = $this->euclid->similarity($subjectValues,array_values($data));
            $this->result_set[$label] = $distance;
        }

        return $this->k($k);

    }

    public function getResult()
    {
        return $this->result_set;
    }

    public function setDataPath($Path)
    {
        $this->data_path = $Path;
        $this->training_data = json_decode(file_get_contents($this->data_path),true);
    }

    public function setRawData($data)
    {
        $this->training_data = $data;
    }
    public function getDataPath()
    {
        return $this->data_path;
    }

    public function getRawData()
    {
        return $this->training_data;
    }

    protected function k($k){
        arsort($this->result_set);

        $return = [];
        $counter = 0;
        foreach ($this->result_set as $label => $value){
            if($counter < $k){
                $return[$label] = $value;
            }
            $counter++;
        }
        return $return;
    }
    

}