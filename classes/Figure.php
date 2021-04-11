<?php


abstract class Figure{
    protected $posX, $posY, $fill; //начальное положение фигуры
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

        // $arr[] = [$this->x1,$this->y1];
        // $arr[] = [$this->x2,$this->y2];

        for($i = 0 ; $i < $l ; $i++){
            $arr[] = [$this->y1+$dirY*$i, $this->x1+$dirX*$i];
        }
        return $arr;
    }
}

class Circle extends Figure{
    protected $r;
    public function __construct($x, $y, $r, $fill = 0){ // создание фигуры
        $this->posX = $x; $this->posY = $y;
        $this->r = $r; $this->fill = $fill;
    }
    public function getPoints(){  // получить все точки фигуры
        $arr = null;
        $add_point = function ($i, $j) use (&$arr){
            $arr[] = [$this->posY + $i, $this->posX + $j];
            $arr[] = [$this->posY - $i, $this->posX + $j];
            $arr[] = [$this->posY + $i, $this->posX - $j];
            $arr[] = [$this->posY - $i, $this->posX - $j];
        };
       if($this->fill == 0) { // только контур
           for ($i = 0; $i < $this->r + 1; $i++) {
               for ($j = 0; $j < $this->r + 1; $j++) {
                   if ($i * $i + $j * $j - $this->r * $this->r >= 0 && $i * $i + $j * $j - $this->r * $this->r < $this->r * 2) {
                       //   printf('%.2f , %.2f ;  %.2f<br>', $i*$i+$j*$j, $this->r*$this->r, $i*$i+$j*$j - $this->r*$this->r);
                       $add_point($i,$j);
                   }
               }
           }
       }else{   // полное заполнение
           for ($i = 0; $i < $this->r + 1; $i++) {
               for ($j = 0; $j < $this->r + 1; $j++) {
                   if ($i * $i + $j * $j < $this->r * $this->r) {
                        $add_point($i,$j);
                   }
               }
           }

       }
       //var_dump($arr);
        return $arr;
    }
}

class Rectangle extends Figure{
    protected $sizeX, $sizeY;
    public function __construct($posX, $posY,  $width,$height, $fill = 0){ // создание фигуры
        $this->sizeX = $width; $this->sizeY = $height;
        $this->posX = $posX; $this->posY = $posY;
        $this->fill = $fill;
    }
    public function getPoints()
    {  // получить все точки фигуры
        $arr = null;
        if ($this->fill == 0) { // только контур
            for ($i = 0; $i < $this->sizeX; $i++) {
                $arr[] = [$this->posY, $this->posX + $i];
                $arr[] = [$this->posY + $this->sizeY, $this->posX + $i];
            }
            for ($i = 0; $i < $this->sizeY; $i++) {
                $arr[] = [$i + $this->posY, $this->posX];
                $arr[] = [$i + $this->posY, $this->posX + $this->sizeX];
            }
        }else { // полное заполнение
            for ($j = 0; $j <$this->sizeY  ; $j++) {
                for ($i = 0; $i < $this->sizeX; $i++) {
                    $arr[] = [$this->posY + $j, $this->posX + $i];
                }
            }
        }
        return $arr;
    }
}