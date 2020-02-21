<?php

// Given an array, find the integer that appears an odd number of times.
// There will always be only one integer that appears an odd number of times.

function findIt(array $seq) : int
{
  $associativeArray = array_count_values($seq);

  foreach ($associativeArray as $key => $value){
    if ($value%2 != 0){
      echo $key;
      return $key;
    }
  }   
}

findIt([20,1,-1,2,-2,3,3,5,5,1,2,4,20,4,-1,-2,5]); // 5
echo "\n";
findIt([1,1,2,-2,5,2,4,4,-1,-2,5]); //-1
echo "\n";
findIt([20,1,1,2,2,3,3,5,5,4,20,4,5]); // 5
echo "\n";
findIt([10]); //10
echo "\n";
findIt([1,1,1,1,1,1,10,1,1,1,1]); //10

?>