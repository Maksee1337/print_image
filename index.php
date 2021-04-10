<?php

 //   include 'classes/Desk.php';
    include 'classes/BitMap.php';

    $bmp = new BitMap(800,600);

   $add_tree = function ($x , $y) use ($bmp){  // рисуем дерево
        $bmp->AddFigure(new Rectangle($x,$y,10,80, 1), CL_BROWN);
        $bmp->AddFigure(new Circle($x+5,$y-20,40, 1), CL_DARKGREEN);
        $bmp->AddFigure(new Circle($x-10,$y-20,5, 1), CL_RED);
        $bmp->AddFigure(new Circle($x+5,$y-40,5, 1), CL_RED);
        $bmp->AddFigure(new Circle($x+18,$y,5, 1), CL_RED);
    };

    $add_bush = function ($x , $y) use ($bmp){  // рисуем куст
        $bmp->AddFigure(new Rectangle($x,$y,80,30, 1), CL_DARKGREEN);
        $bmp->AddFigure(new Circle($x+5,$y+10,20, 1), CL_DARKGREEN);
        $bmp->AddFigure(new Circle($x+5,$y-5,15, 1), CL_DARKGREEN);
        $bmp->AddFigure(new Circle($x+30,$y-14,20, 1), CL_DARKGREEN);
        $bmp->AddFigure(new Circle($x+45,$y-10,28, 1), CL_DARKGREEN);
        $bmp->AddFigure(new Circle($x+65,$y-10,20, 1), CL_DARKGREEN);
        $bmp->AddFigure(new Circle($x+80,$y+5,25, 1), CL_DARKGREEN);
        $bmp->AddFigure(new Circle($x+20,$y-20,3, 1), CL_RED);
        $bmp->AddFigure(new Circle($x+58,$y+3,4, 1), CL_RED);
        $bmp->AddFigure(new Circle($x+18,$y+10,2, 2), CL_RED);
    };

    $add_cloud = function ($x , $y) use ($bmp){  // рисуем тучу
        $bmp->AddFigure(new Rectangle($x,$y,80,30, 1), CL_CLOUD);
        $bmp->AddFigure(new Circle($x+5,$y+10,20, 1), CL_CLOUD);
        $bmp->AddFigure(new Circle($x+5,$y-5,15, 1), CL_CLOUD);
        $bmp->AddFigure(new Circle($x+30,$y-14,20, 1), CL_CLOUD);
        $bmp->AddFigure(new Circle($x+45,$y-10,28, 1), CL_CLOUD);
        $bmp->AddFigure(new Circle($x+65,$y-10,20, 1), CL_CLOUD);
        $bmp->AddFigure(new Circle($x+80,$y+5,25, 1), CL_CLOUD);
    };

    $bmp->AddFigure(new Rectangle(0,$bmp->getHeight()/2,$bmp->getWidth()-1, $bmp->getHeight()/2, 1), CL_GREEN); // трава
    $bmp->AddFigure(new Rectangle(0,0,$bmp->getWidth()-1, $bmp->getHeight()/2, 1), CL_SKYBLUE); // небо
    $bmp->AddFigure(new Circle(740,60,50, 1), CL_YELLOW); // солнце

    $add_tree(100,400);
    $add_tree(500,300);
    $add_bush(600,300);
    $add_bush(200,550);
    $add_cloud(100,100);
    $add_cloud(300,100);
    $add_cloud(500,100);

    $bmp->AddFigure(new Rectangle(0,0,$bmp->getWidth()-1, $bmp->getHeight()-1)); // рамка

    $bmp->SaveFile('image.bmp');

    echo '<img src="image.bmp"/>';
