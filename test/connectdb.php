<?php

$host="us-cdbr-east-05.cleardb.net";
$user="b447b6be6d7215";
$passwd="3427bf27";
$dbname="heroku_4e04d0ad1fcd13d";


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