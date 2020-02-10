<?php
$json = '{"a":"noma","b":2,"c":3,"d":4,"e":5}';

$result = json_decode($json);
$result1 = json_decode($json, true);

// print_r(gettype($result));
// print_r(gettype($result1));
// print_r($result1);

// for ($i = 0; $i < count($result1); $i++) {
//   $result1["a"] = str_replace($item, str_repeat("*", strlen("noma")), $result1);
// }

foreach ($result1 as $key => $val) {
    // print_r(strlen($item));
    if ($val === 'noma') {
        $result1[$key] = str_replace($val, str_repeat("*", 4), $result1);
    }
    // print_r($val);
    // $result1[$key] = $val;
}

// $result1['a']='pidor';
// print_r(gettype($result1));
print_r($result1);
