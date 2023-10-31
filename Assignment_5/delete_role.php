<?php
session_start();
if($_SESSION['role'] != "admin"){
    header("Location: index.php");
}
$fileName = "./data/users.json";
$users = json_decode(file_get_contents($fileName), true);
$newUser = [];
function emaliFilter($email,$users){
    return $users[$email];
}
if(isset($_GET['email'])){
    $GetEmail = $_GET['email'];
    foreach($users as $email => $userData){
        if($GetEmail !== $email){
            $newUser[$email] = $userData;
            file_put_contents($fileName, json_encode($newUser, JSON_PRETTY_PRINT));
            header("Location: manage_role.php");
        }
    }
}

?>