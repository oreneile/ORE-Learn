<?php
/**
 * Neural Network
 *
 * @author Kabelo Masemola <masemolakrp@spaneng.co.za>
 * @copyright Copyright (c) 2016
 * @version 1.0
 * @package Ore 
 * @reference https://en.wikipedia.org/wiki/Cosine_similarity
 * @notes <* ? *>
 */
namespace Classifiers\ANN;


use Classifiers\ANN\Contracts\NetworkContract;
use Matrix\Matrix;

class NeuralNetwork implements NetworkContract
{
    protected $network_parameters = [
        'inputs' => 0,
        'outputs'=> 0,
        'hidden' => []
    ];

    protected $input;
    protected $output;
    protected $layers = [];

    public function __construct($network_parameters)
    {
        $this->network_parameters = $network_parameters;
    }

    /**
     * @description Train the network
     */
    public function train()
    {
        $this->buildNetwork();
    }

    public function run($data)
    {
        // TODO: Implement run() method.
    }

    /**
     * @description the sigmoid activation function
     *
     *            1
     *        ----------
     *          1 + e^-t
     *
     * @param $value
     * @return float
     */
    protected function sigmoid($value)
    {
        return 1/(1 + exp(-$value));
    }

    /**
     * @description the derivative of the sigmoid activation function
     *
     *            e^-t
     *        ----------
     *          (1 + e^-t)^2
     * @param $value
     * @return float
     */
    protected function sigmoidPrime($value)
    {
     return (exp(-$value))/pow((1+exp(-$value)),2);
    }

    protected function buildNetwork(){
        $HlayerCount = count($this->network_parameters['hidden']);
        $W1 = new Matrix($this->network_parameters['inputs'],$this->network_parameters['hidden'][0]);
        $W1->randomize();
        $this->layers[] = $W1;
        unset($W1);
        for($i =0; $i < $HlayerCount; $i++){
            if(isset($this->network_parameters['hidden'][$i+1])){
                $inWeight = new Matrix($this->network_parameters['hidden'][$i],$this->network_parameters['hidden'][$i+1]);
                $inWeight->randomize();
             $this->layers[] = $inWeight;
            }
        }

        $WLast = new Matrix(end($this->network_parameters['hidden']),$this->network_parameters['outputs']);
        $WLast->randomize();
        $this->layers[] = $WLast;
    }

    public function layers()
    {
        return $this->layers;
    }

}