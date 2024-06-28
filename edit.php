<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";
$conn = "";

//create connection
$conn = new mysqli($servername,$username, $password, $database);

$id = "";
$name = "";
$email = "";
$phone_number = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){

//GET method: show the data of the client

if(!isset($_GET["id"])){
header("location: index.php");
exit;
}
$id = $_GET["id"];

//read the row of the selected clients from the database
$sql = "SELECT * FROM clients WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if(!$row){
header("location: index.php");
exit;
}

$name = $row["name"];
$email = $row["email"];
$phone_number = $row["phone_number"];
$address = $row["address"];
}
else{
//POST method: update the data of the client
$name = $_POST["name"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$address = $_POST["address"];

do{
if(empty($name) || empty($email) || empty($phone_number) || empty($address)){
$errorMessage = "All the fields are required";
break;
}
$sql = "UPDATE clients
       SET name = '$name', 
        email = '$email', phone_number = '$phone_number', address = '$address'" . 
        "WHERE id = '$id'";

$result = $conn->query($sql); 

if(!$result){
$errorMessage = "Invalid query: " . $conn->error;
break;
}

$successMessage = "Client updated correctly";

header("location: index.php");
exit;


}while(true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container my-5">
    <h2>New Client</h2>
<?php
if(!empty($errorMessage)){
echo" <strong>$errorMessage</strong>";
}

?>
  <form method="post">
<div>
<input type="hidden" name="id" value="<?php echo $id; ?>"
</div>
<div class="row mb-3">
<label class="col-sm-3 col-form-label">Name</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
</div>
</div>
<div class="row mb-3" >
<label class="col-sm-3 col-form-label">Email</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
</div>
</div>
<div class="row mb-3">
<label class="col-sm-3 col-form-label">Phone_number</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="phone_number" value="<?php echo $phone_number; ?>">
</div>
</div>
<div class="row mb-3">
<label class="col-sm-3 col-form-label">Address</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
</div>
</div>
<?php
 echo"<strong>$successMessage</strong>";
?>
<div class="row mb-3">
<div class="offset-sm-3 col-sm-3 d-grid">
<button type="submit" class="btn btn-primary">Submit</button><br>
<div class="offset-sm-3 d-grid">
<a class="btn btn-primary" href="index.php" type="button">Cancel</a>
</div>
</div>
</form>
</div>
</body>
</html>