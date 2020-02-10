<?php
// $keywords = "one,            two   , three      ,                   four";
// $keyword_array=explode(",", $keywords);

// print_r($keyword_array); 

//should just output 
/* 
Array 
( 
    [0] => one 
    [1] => two 
    [2] => three 
    [3] => four 
) 
*/ 

$str = "Hello Friend";

// $arr1 = str_split($str);
$arr2 = explode(" ", $str);

print_r($arr1);
print_r($arr2);

?>