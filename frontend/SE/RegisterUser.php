<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Your Profile</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 
</head>
<body>
<!--<a href="index.html" style="color:blue;font-size:30px;position:absolute;right:10px;top:50px;font-weight:bold;">back to home</a>
<div class="col-lg-4" style="position:absolute;top:200px;left:400px;">
                   
	</div>
-->
	<?php
$username = $_POST["newuser"];
$password = $_POST["newpassword"];
$confirm = $_POST["confirmpassword"];

$user= 'root';
$pass = '';
$db = 'testdb';
$conn=new mysqli('localhost',$user,$pass,$db) or die("unable to connect");
echo"great work!";

$sql = "INSERT INTO user_info (Name, Password) VALUES ('$username', '$password')";
if($password!=$confirm)
	echo("Try AGAIN!");
else{
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	echo "You have been registered successfully";
	echo "</br></br>";
	echo "<a href=login.html>Please click here to login</a>";
}
?>
</html>
