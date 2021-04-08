<?php

include 'Figure.php';

class Desk{
    protected $height, $width;
    protected $matrix = [];

    public function __construct($height, $width){
        $this->height = $height;
        $this->width = $width;
        for($i = 0 ; $i < $height ; $i++){
            for($j = 0 ; $j < $width ; $j++){
                $this->matrix[$i][$j] = '_';
            }
        }
    }

    public function AddFigure(Figure $figure){
        foreach ($figure->getPoints() as $v){
           $this->matrix[$v[0]][$v[1]] = '#';
        }
    }
    public function PrintMe($separator = "\n"){
        for($i = 0 ; $i < $this->height ; $i++){
            for($j = 0 ; $j < $this->width ; $j++){
                echo $this->matrix[$i][$j];
            }
            echo $separator;
        }
    }


}