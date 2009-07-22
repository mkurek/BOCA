<?php
session_start();
    $pool = '0123456789abcdefghijklmnopqrstuvwxyz';
    $img_width = 120;
    $img_height = 30;

    $str = '';
    for ($i = 0; $i < 7; $i++){
        $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
    }

    $string = $str;
    $_SESSION['captcha'] = $string;

    $im = imagecreate($img_width, $img_height);

    $bg_color     = imagecolorallocate($im,163,163,163);
    $font_color   = imagecolorallocate($im,252,252,252);
    $grid_color   = imagecolorallocate($im,31,0,0);
    $border_color = imagecolorallocate ($im, 174, 174, 174);

    imagefill($im,1,1,$bg_color);

    for($i=0; $i<1600; $i++){

        $rand1 = rand(0,$img_width);
        $rand2 = rand(0,$img_height);
        imageline($im, $rand1, $rand2, $rand1, $rand2, $grid_color);

    }

    $x = rand(5, $img_width/(7/2));

    imagerectangle($im, 0, 0, $img_width-1, $img_height-1, $border_color);

    for($a=0; $a < 7; $a++){

        imagestring($im, 5, $x, rand(6 , $img_height/5), substr($string, $a, 1), $font_color);
        $x += (5*2); #odstęp

    }

    header("Content-type: image/gif");
    imagegif($im);
    imagedestroy($im);

?>