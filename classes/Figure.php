<?php


abstract class Figure{
    protected $posX, $posY; //начальное положение фигуры
    abstract function getPoints();  // получить все точки фигуры
}

class Line extends Figure{
    protected $x1, $y1, $x2, $y2;
    public function __construct($x1, $y1, $x2, $y2){ // создание фигуры
        $this->x1 = $x1; $this->y1 = $y1;
        $this->x2 = $x2; $this->y2 = $y2;
    }
    public function getPoints(){  // получить все точки фигуры
        $arr = null;

        $dx = $this->x2 - $this->x1;
        $dy = $this->y2 - $this->y1;
        $l = sqrt($dx*$dx+$dy*$dy);

        $dirX = $dx / $l;
        $dirY = $dy / $l;

        $arr[] = [$this->x1,$this->y1];
        $arr[] = [$this->x2,$this->y2];

        for($i = 0 ; $i < $l ; $i++){
            $arr[] = [$this->x1+$dirX*$i, $this->y1+$dirY*$i];
        }
        return $arr;
    }
}

