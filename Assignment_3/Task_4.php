<?php
$studentGrades = [
    ["Math" => 70, "English" => 90, "Science" => 80],
    ["Math" => 60, "English" => 70, "Science" => 50],
    ["Math" => 90, "English" => 40, "Science" => 60]
];


function avarageGrade($arr) {
    $resultArr = [];

    //converting value to single value
    function gradeReduce($carry, $item) {
        return $carry + $item;
    }

    foreach ($arr as $item) {
        //adding result in $resultArr array
        array_push($resultArr ,ceil(array_reduce($item, "gradeReduce") / 3));
    }
    $counter = 0;
    foreach($resultArr as $item) {
        $counter++;
        echo "stduent {$counter} result is {$item}"."\n";
    }
}

avarageGrade($studentGrades);