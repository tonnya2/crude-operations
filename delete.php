<?php
if(isset($_GET["id"])){
$id = $_GET["id"];

$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";
$conn = "";

//create connection
$conn = new mysqli($servername,$username, $password, $database);

$sql = "DELETE FROM clients WHERE id=$id";
$conn->query($sql);
}
header("location: index.php");
exit;
?>