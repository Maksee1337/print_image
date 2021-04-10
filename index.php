<?php

 //   include 'classes/Desk.php';
    include 'classes/BitMap.php';

    $bmp = new BitMap(400,300);

    $bmp->AddFigure(new Line(rand(0,400),rand(0,300),rand(0,400),rand(0,300)));
    $bmp->AddFigure(new Line(rand(0,400),rand(0,300),rand(0,400),rand(0,300)));
    $bmp->AddFigure(new Line(rand(0,400),rand(0,300),rand(0,400),rand(0,300)));
    $bmp->AddFigure(new Line(rand(0,400),rand(0,300),rand(0,400),rand(0,300)));

    $bmp->AddFigure(new Circle(rand(0,400),rand(0,300),rand(0,200)));
    $bmp->AddFigure(new Circle(rand(0,400),rand(0,300),rand(0,200)));
    $bmp->AddFigure(new Circle(rand(0,400),rand(0,300),rand(0,200)));

    $bmp->SaveFile('image.bmp');

    echo '<img src="image.bmp"/>';
