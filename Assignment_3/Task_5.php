<?php

function generatePassword($length){
    $creator = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*-_+=\|:<>/?()[]{}";
    $passwordArr = "";
    for($i=0; $i < $length; $i++){
        $randomNum = rand(0,strlen($creator)-1);
        $passwordArr .= $creator[$randomNum];
    }
    // $password = implode("",$passwordArr);
    // echo $password;
    return $passwordArr;
}

//generatePassword(12);
echo generatePassword(12);


