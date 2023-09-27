<?php
$numbers = [];
for($i=0; $i<=10; $i++){
    array_push($numbers,$i);
}

function removedEeven($arr){
    $exitsNum = array_filter($arr, function($n){
        return $n % 2 !== 0;
    });

    return $exitsNum;
}
// removeEevn($numbers);
print_r(removedEeven($numbers));