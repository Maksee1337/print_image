<?php

include 'Figure.php';


define('CL_WHITE', 0);
define('CL_BLACK', 1);
define('CL_GREEN', 2);
define('CL_RED', 3);
define('CL_YELLOW', 4);
define('CL_SKYBLUE', 5);
define('CL_BROWN', 6);
define('CL_DARKGREEN', 7);
define('CL_CLOUD', 8);


class BitMap{

    private $colors = [
        CL_BLACK => [0,0,0,0],
        CL_WHITE => [0,255,255,255],
        CL_RED => [0,255,0,0],
        CL_GREEN => [0,0,128,0],
        CL_YELLOW => [0,255,255,0],
        CL_SKYBLUE => [0,135,206,235],
        CL_BROWN => [0,139,69,19],
        CL_DARKGREEN => [0,0,100,0],
        CL_CLOUD => [0,175,238,238],
        ];

    private $BitMapFileHeader_Type = 'BM';
    private $BitMapFileHeader_Size;
    private $BitMapFileHeader_Reserved1 = 0;
    private $BitMapFileHeader_Reserved2 = 0;
    private $BitMapFileHeader_OffsetBits = 14+40;

    private $BitMapInfoHeader_Size = 40;
    private $BitMapInfoHeader_Width;
    private $BitMapInfoHeader_Height;
    private $BitMapInfoHeader_Planes = 1;
    private $BitMapInfoHeader_BitCount = 32;
    private $BitMapInfoHeader_Compression = 0;
    private $BitMapInfoHeader_SizeImage;
    private $BitMapInfoHeader_XpelsPerMeter = 2795;
    private $BitMapInfoHeader_YpelsPerMeter = 2795;
    private $BitMapInfoHeader_ColorsUsed = 0;
    private $BitMapInfoHeader_ColorsImportant = 0;
    private $ColorTable;
    private $Image = null;

    public function __construct($width, $height){
        $this->BitMapInfoHeader_Width = $width;
        $this->BitMapInfoHeader_Height = $height;
        $this->BitMapInfoHeader_SizeImage = $height*$width*4;
        $this->BitMapFileHeader_Size = 14+40+$this->BitMapInfoHeader_SizeImage;
        for($i = 0 ; $i < $this->BitMapInfoHeader_Height ; $i++){
            for($j = 0 ; $j < $this->BitMapInfoHeader_Width ; $j++){
                $this->Image[$i][$j] = CL_WHITE;
            }
        }
    }

    public function getHeight(){
        return $this->BitMapInfoHeader_Height;
    }
    public function getWidth(){
        return $this->BitMapInfoHeader_Width;
    }

    public function AddFigure(Figure $figure, $color = CL_BLACK){
        foreach ($figure->getPoints() as $v){
            if($v[0] >= 0 && $v[1] >= 0 && $v[0] < $this->BitMapInfoHeader_Height && $v[1] < $this->BitMapInfoHeader_Width) {
                $this->Image[$v[0]][$v[1]] = $color;
            }
        }
    }
    public function SaveFile($filename = "1.bmp"){
        $f = fopen($filename,'wb');

        fwrite($f, $this->BitMapFileHeader_Type, 2);
        fwrite($f, pack('V', $this->BitMapFileHeader_Size));
        fwrite($f, pack('v', $this->BitMapFileHeader_Reserved1));
        fwrite($f, pack('v', $this->BitMapFileHeader_Reserved2));
        fwrite($f, pack('V', $this->BitMapFileHeader_OffsetBits));
        fwrite($f, pack('V', $this->BitMapInfoHeader_Size));
        fwrite($f, pack('V', $this->BitMapInfoHeader_Width));
        fwrite($f, pack('V', $this->BitMapInfoHeader_Height));
        fwrite($f, pack('v', $this->BitMapInfoHeader_Planes));
        fwrite($f, pack('v', $this->BitMapInfoHeader_BitCount));

        fwrite($f, pack('V', $this->BitMapInfoHeader_Compression));
        fwrite($f, pack('V', $this->BitMapInfoHeader_SizeImage));
        fwrite($f, pack('V', $this->BitMapInfoHeader_XpelsPerMeter));
        fwrite($f, pack('V', $this->BitMapInfoHeader_YpelsPerMeter));
        fwrite($f, pack('V', $this->BitMapInfoHeader_ColorsUsed));
        fwrite($f, pack('V', $this->BitMapInfoHeader_ColorsImportant));
        $arr = null;
        for($i = $this->BitMapInfoHeader_Height-1 ; $i >= 0; $i--){
            for($j = 0 ; $j < $this->BitMapInfoHeader_Width ; $j++){
                $arr[] = pack('c', $this->colors[$this->Image[$i][$j]]['3']);
                $arr[] = pack('c', $this->colors[$this->Image[$i][$j]]['2']);
                $arr[] = pack('c', $this->colors[$this->Image[$i][$j]]['1']);
                $arr[] = pack('c', $this->colors[$this->Image[$i][$j]]['0']);
            }
            fwrite($f,  implode('', $arr),$this->BitMapInfoHeader_Width*4);
            $arr = null;

        }
        fclose($f);
    }

}