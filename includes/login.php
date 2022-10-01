<?php
session_start();
include "db.php";
    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
    }else{
        header("Location:../");
    }

    $query = "SELECT * FROM users WHERE user_username = '$username'";
    $query_result = mysqli_query($conn,$query);

    while($row = mysqli_fetch_assoc($query_result)){
        $db_username = $row["user_username"];
        $db_password = $row["user_password"];
        $db_user_id = $row["user_id"];
        $db_user_username = $row["user_username"];
        $db_user_lastname = $row["user_lastname"];
        $db_user_role = $row["user_role"];
    }
    $password = crypt($password,$db_password);

    if($username === $db_username && $password === $db_password){
        $_SESSION["user_id"] = $db_user_id;
        $_SESSION["user_username"] = $db_user_username;
        $_SESSION["user_lastname"] = $db_user_lastname;
        $_SESSION["user_role"] = $db_user_role;
        header("Location:../admin/");
    }else{
        header("Location:../");
    }


?>