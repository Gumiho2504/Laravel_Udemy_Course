<?php

$x = 10;
if ($x > 0) {
    echo ("true \n");
} else {
    echo ("false \n");
}


$score = 85;
if ($score >= 90) echo ("A");
else if ($score >= 80) echo ("B");
else if ($score >= 70) echo ("C");
else if ($score >= 60) echo ("D");
else echo ("F");


$number =  15;
switch ($number) {
    case $number > 0:
        echo ("Is Positive Number");
        break;
    default:
        echo ("Is Negative Number");
        break;
}
