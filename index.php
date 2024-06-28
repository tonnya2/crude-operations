<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body></body>
<div class="container my-5">
    <h2>List Of Clients</h2>
    <a class="btn btn-primary" href="create.php" role="button">New Client</a><br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";
$conn = "";
//create connection
$conn = new mysqli($servername,$username, $password, $database);

//check  connection
if($conn->connect_error){
die("connection failed: " . $conn->connect_error);
}

//read all row from databse table
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

if(!$result){
die("invalid query: . $conn->error"); 
}
//read data of each row
while($row = $result->fetch_assoc()){
echo"

 <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone_number]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr> 
";

}

?>
               
        </tbody>
    </table>

</div>
</body>

</html>