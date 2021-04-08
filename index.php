<?php

    include 'classes/Desk.php';

    $desk = new Desk(40,150);
    $desk->AddFigure(new Line(rand(0,40),rand(0,150),rand(0,40),rand(0,150)));
    $desk->AddFigure(new Line(rand(0,40),rand(0,150),rand(0,40),rand(0,150)));
    $desk->AddFigure(new Line(rand(0,40),rand(0,150),rand(0,40),rand(0,150)));
    $desk->AddFigure(new Line(rand(0,40),rand(0,150),rand(0,40),rand(0,150)));
    $desk->AddFigure(new Line(rand(0,40),rand(0,150),rand(0,40),rand(0,150)));
  /*  $desk->AddFigure(new Line(15,122,4,20));
    $desk->AddFigure(new Line(5,5,37,25));
    $desk->AddFigure(new Line(5,10,30,140));
    $desk->AddFigure(new Line(33,0,0,140));*/

    $desk->PrintMe('<br>');