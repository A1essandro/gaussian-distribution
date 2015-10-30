<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Random\GaussDistribution;

include 'src/GaussDistribution.php';

$g = new GaussDistribution(0, 5);

$pointsCount = 10000;
$points = new SplFixedArray($pointsCount);

$i = 0;
while ($i < $pointsCount) {
    $points[$i] = new SplFixedArray(2);
    $points[$i][0] = $g->getRandom();
    $points[$i][1] = $g->getRandom();
    $i++;
}

$im = imagecreate(500, 500);
$backgroundColor = imagecolorallocate($im, 0xff, 0xff, 0xff);
$black = imagecolorallocate($im, 0, 0, 0);
$pointColor = imagecolorallocate($im, 0xff, 0, 0);
foreach ($points as $point) {
    imagesetpixel($im, $point[0] + 250, $point[1] + 250, $pointColor);
}
imagepng($im, 'image.png');
imagedestroy($im);

echo 'See image.png';