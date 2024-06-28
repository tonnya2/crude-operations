<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

//create connection
$conn = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$phone_number = "";
$address = "";

$errorMessage = "";
$successMessage = "";
$result = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$name = $_POST["name"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$address = $_POST["address"];

do{
if(empty($name) || empty($email) || empty($phone_number) || empty($address)){
$errorMessage = "All the fields are required";
break;
}
//add new client to the database
$sql = "INSERT INTO clients (name, email, phone_number, address)" . 
"VALUES ('$name', '$email', '$phone_number', '$address')";

$result = $conn->query($sql);

if(!$result){
$errorMessage = "invalid query:" . $conn->error;
break;
}
$name = "";
$email = "";
$phone_number = "";
$address = "";

$successMessage = "Client added correctly";

header("location: index.php");
exit;

}while(false);

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
<div class="container my-S">
    <h2>New Client</h2>
<?php
if(!empty($errorMessage)){
echo" <strong>$errorMessage</strong>";
}

?>
  <form method="post">
<div class="row mb-3">
<label class="col-sm-3 col-form-label">Name</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
</div>
</div>
<div class="row mb-3">
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
<a class="btn btn-outline-primary" href="index.php" type="button">Cancel</a>
</div>
</div>
</form>
</div>
</body>
</html>