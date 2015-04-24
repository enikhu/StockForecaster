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
<form  method="POST">
	<?PHP
$user= 'root';
$pass = 'root';
$db = 'testdb';
$conn=new mysqli('localhost',$user,$pass,$db) or die("unable to connect");
//echo"great work!";
 
{
  //echo("<p>Successfully Connected to Database 'testschema'!</p>");
}
$username = $_POST["username"];
$password = $_POST["password"];
$sql = "select Name from user_info where Name= '$username' and Password = '$password'";

if ($result=mysqli_query($conn,$sql)){
    //echo "search successful";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
session_start();
$_SESSION['user_name']=$username;
$rowcount=mysqli_num_rows($result);
if($rowcount!= 0)
{
	echo "<h1 align='center'>Welcome $username!!</h1>";?></br><?php
	
	//echo "<label style='position:absolute;bottom:10;right:10; font-size:20'><a href=http://localhost:1234/PredictionPage.php>Click here to continue</a></label>";
	//echo "<br>";
	}
else
{
	echo "THis account does not exist";
	echo "<a href=http://localhost:1234/login.html >Click here to Login again</a>";
}
$sql1 = "select distinct searchValue from search where userName = '$username'";
//echo "<label><h3>Your Search history:</h3></label>";
//echo "<br>";
$res = mysqli_query($conn,$sql1);
$rs = mysqli_num_rows($res);
?>

<a href="index.html" style="color:blue;font-size:30px;position:absolute;right:10px;top:50px;font-weight:bold;">back to home</a>
<div class="col-lg-4" style="position:absolute;top:200px;left:400px;">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:silver;border:2px solid silver;"">
                            <i class="fa fa-bell fa-fw"></i> Notifications Panel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="border:2px solid silver;">
                            <div class="list-group" style="border:2px solid silver;">
                                <a href="#" class="list-group-item">
							<select>
							
							<?php
								if($rs==0)
	
									echo "<option>No searches yet!</option>";
								else
								{
									while($rc = mysqli_fetch_array($res, MYSQL_NUM))
									{
											echo "<option>$rc[0]</option>";
											//echo "<br>";
	
	
									}
								}
							
							?>
							
							
							</select>
</a>						
<a href="#" class="list-group-item">
						<i class="fa fa-comment fa-fw"></i> 
                            
                                
                                
                                    
							
<select name="lsCompanyName">
								<?php
$abc=5;
$user= 'root';
$pass = 'root';
$db = 'finance';
//echo "<option>".$abc."</option>";
$conn=new mysqli('localhost',$user,$pass,$db) or die("unable to connect");
//echo"great work!";

$sql = "select * from organizationtable";
//selecting database

//looping through all companies in the database to populate the listbox
//$companynames = mysql_query("select OrganizationName from organizationtable ORDER BY OrganizationName") or die(mysql_error());
//running loop for auto refreshing all the companies
$result=mysqli_query($conn,$sql) or die();


while($row= mysqli_fetch_array($result,MYSQL_ASSOC))
	
{
	//echo "<option>".$abc."</option>";
	echo "<option>". $row['OrganizationName'] ."</option>";
}

?>
</select >
</a>

                                             <!-- /.panel-body -->
                    </div>
					
						<input type="submit" formaction="closeGraph.php" value="Raw visualization" />
      						<input type="submit" formaction="result.php" value="Search" />
	</div>
</form>

</html>
