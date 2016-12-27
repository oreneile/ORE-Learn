<?php

include('vendor/autoload.php');

use Classifiers\KNN\KNearestNeighbor;
use Classifiers\ANN\NeuralNetwork;
use Utilities\Utils;
///**
// * K-Nearest Neighbor
// */
//$knn = new KNearestNeighbor();
//$knn->setDataPath(__DIR__.'/data/critics.json');
//
//$subject = [
//    "Lady in the Water"=> 1.5,
//    "Snakes on a Plane"=> 4.0,
//    "The Night Listener"=> 1.0,
//    "Superman Returns"=> 3.0,
//    "You, Me and Dupree"=> 3.5
//];
//
//$value = $knn->classify(1,$subject);
//$v = $knn->getResult();
//dump(pow(2,2));
//
//
//
///**
// * K-mean clusters
// */
//
//
//
//
///**
// * Artificial Neural Network
// */

$network_parameters = [
    'inputs' => 2,
    'outputs'=> 1,
    'hidden' => [3]
];



$ann = new NeuralNetwork($network_parameters);
$ann->train();
$serial = file_get_contents('serial.txt');
dump(unserialize($serial));
