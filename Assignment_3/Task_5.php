<?php

function generatePassword($length){
    $creator = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*-_+=\:<>/?";
    $passwordArr = [];
    for($i=0; $i < $length; $i++){
        $randomNum = rand(0,strlen($creator));
        array_push($passwordArr,$creator[$randomNum]);
    }
    $password = implode("",$passwordArr);
    // echo $password;
    return $password;
}

//generatePassword(12);
echo generatePassword(12);
