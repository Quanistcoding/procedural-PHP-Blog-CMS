

<?php
if(empty(getenv('db_password'))){
    throw new Exception("environment variable db_password for mySQL servser is not set.");
}
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_password'] = getenv('db_password');
$db['db_name'] = "cms";

foreach($db as $key => $value){
    define(strtoupper($key),$value);
}

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(!$conn){
    die("We are not connected.");
};

function get_all_sql_result($table){
    global $conn;
    $sql = "select * from $table";
    return mysqli_query($conn,$sql);
};






















?>