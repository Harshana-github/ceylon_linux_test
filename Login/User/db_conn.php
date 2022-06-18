<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "purchase_order_bulk_conversion";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}