<?php 
    $dsn="mysql:host=localhost;
    dbname=php_crud";
    $user="root";
    $password='';
    $options=[];
    try
    {  
        $connection= new PDO($dsn,$user,$password,$options);//path established saved into a variable
        // echo "Connection Successfull";
    }
    catch (PDOException)
    {
        echo "Connection Failed";
    }
?>
