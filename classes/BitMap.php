<?php

include 'Figure.php';

class BitMap{
    private $BitMapFileHeader_Type = 'BM';
    private $BitMapFileHeader_Size = 14+40+100*100*4;
    private $BitMapFileHeader_Reserved1 = 0;
    private $BitMapFileHeader_Reserved2 = 0;
    private $BitMapFileHeader_OffsetBits = 14+40;

    private $BitMapInfoHeader_Size = 40;
    private $BitMapInfoHeader_Width = 100;
    private $BitMapInfoHeader_Height = 100;
    private $BitMapInfoHeader_Planes = 1;
    private $BitMapInfoHeader_BitCount = 32;
    private $BitMapInfoHeader_Compression = 0;
    private $BitMapInfoHeader_SizeImage = 100*100*4;
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
                $this->Image[$i][$j] = ['x' => 0, 'r' => 255, 'g' => 255 , 'b' => 200];
            }
        }
    }

    public function AddFigure(Figure $figure){
        foreach ($figure->getPoints() as $v){
            if($v[0] >= 0 && $v[1] >= 0 && $v[0] < $this->BitMapInfoHeader_Height && $v[1] < $this->BitMapInfoHeader_Width) {
                $this->Image[$v[0]][$v[1]] = ['x' => 0, 'r' => 0, 'g' => 0, 'b' => 0];
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

        for($i = $this->BitMapInfoHeader_Height-1 ; $i >= 0; $i--){
            for($j = 0 ; $j < $this->BitMapInfoHeader_Width ; $j++){
                fwrite($f, pack('c', $this->Image[$i][$j]['b']));
                fwrite($f, pack('c', $this->Image[$i][$j]['g']));
                fwrite($f, pack('c', $this->Image[$i][$j]['r']));
                fwrite($f, pack('c', $this->Image[$i][$j]['x']));
            }
        }
        fclose($f);
    }

}