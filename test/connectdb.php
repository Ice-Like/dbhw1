<?php

$host="localhost";
$user="root";
$passwd="";
$dbname="mmisdb";


$connect = mysqli_connect ( $host , $user ,$passwd , $dbname );
//檢查連接
if (! $connect )
{
    die( "連接錯誤: " . mysqli_connect_error ());
}

function closedb()
{
    global $connect;
    $connect->close();
}


function execute_sql($sql)
{
    global $connect;

    if ($connect->query($sql) === TRUE) {
        echo "Transaction 成功";
        } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
        }

}


?>