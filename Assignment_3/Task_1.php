<?php 
$text = "The quick brown fox jumps over the lazy dog.";

function textManipulator($text){
    $textWithLowerCase = strtolower($text);
    // replaceing string
    $textChange = str_replace("brown", "red", $textWithLowerCase);
    // echo $textChange;
    return $textChange;
}

// textManipulator($text);
echo textManipulator($text);

