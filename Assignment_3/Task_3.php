<?php
$grades = [85, 92, 78, 88, 95];

function descendingSort($arr){
    // copy of main array
    $copyOfOrginalArr = $arr;
    rsort($copyOfOrginalArr);
    // print_r($CopyArray);
    
    return $copyOfOrginalArr;
}
// print_r($grades);
// descendingSort($grades);

print_r(descendingSort($grades));