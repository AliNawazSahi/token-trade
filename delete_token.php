<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['email'] !== "admin@gmail.com"){
    header("location:  http://localhost/tokentrade/loginsystem/login.php");
    exit;
}

// Database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "tradetoken_db";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}



$ids = $_GET['id'];

// Delete Query

    $deletequery = " DELETE FROM tokens WHERE id={$ids} ";

    $query = mysqli_query($conn, $deletequery);

// Path or Location after deleting Data. 

header("location: http://localhost/tokentrade/admin_dashboard.php");
?>
