<?php

error_reporting(0);

include_once('config.php');

function connection()
{
    $host = HOST;
    $username = USERNAME;
    $password = PASSWORD;
    $database = DATABASE;

    $connection = new mysqli($host, $username, $password, $database);

    if ($connection->connect_error) {
        echo $connection->connect_error;
    } else {
        return $connection;
    }
}
