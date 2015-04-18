<?php
include 'C:\xampp\jpgraph-3.5.0b1\src\jpgraph.php';
include 'C:\xampp\jpgraph-3.5.0b1\src\jpgraph_line.php';
include 'C:\xampp\jpgraph-3.5.0b1\src\jpgraph_date.php';

$var_graph = $_POST["lsCompanyName"];
//echo $var_graph;

$user= 'root';
$pass = '';
$db = 'finance';
$conn=new mysqli('localhost',$user,$pass,$db) or die("unable to connect");
//echo"great work!";

$sql = "select Close,Date from stocks where Company = '$var_graph'";
$data = mysqli_query($conn,$sql) or die();
session_start();
$uname=$_SESSION['user_name'];
//echo $uname;
//$result_id = mysql_query("select OrganizationName from organizationtable where OrganizationName = '$var_graph'") or die(mysql_error());
//$c_id = mysql_fetch_array($result_id, MYSQL_NUM);

//$company_id = $c_id[0];
//$data = mysql_query("select Close,Date from stocks where OrganizationID = '$var_graph'");

$closearray = array();
$datearray = array();

while($row = mysqli_fetch_array($data, MYSQL_NUM))
{
	array_push($closearray, $row[0]);
	array_push($datearray, $row[1]);
}


$max = max($closearray);
//echo $max;
// Some (random) data
$ydata = array(11,3,8,12,5,1,9,13,5,7);
 
// Size of the overall graph
$width=350;
$height=250;
 
// Create the graph and set a scale.
// These two calls are always required
$graph = new Graph(800,600, 'auto');
$graph->SetScale("datlin",0,$max+10);

$graph->yaxis->scale->SetGrace(7);
$graph->img->SetMargin(50,30,40,130);
$graph->SetShadow();

$graph->yaxis->title->Set("Close");
$graph->xaxis->title->Set("Date");
$graph->title->Set($var_graph);

$lplot = new LinePlot($closearray);
$graph->xaxis->SetLabelAngle(90);
$graph->SetTickDensity(TICKD_NORMAL,TICKD_SPARSE);
$graph->xaxis->SetTickLabels($datearray);
$lplot->SetFillColor('red@0.5');
$graph->Add($lplot);
$graph->Stroke(); 

$user= 'root';
$pass = '';
$db = 'testdb';
$conn=new mysqli('localhost',$user,$pass,$db) or die("unable to connect");
//echo"great work!";

$sql = "insert into search(userName,searchValue) values('$uname','$var_graph')" ;
$data = mysqli_query($conn,$sql) or die();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Prediction</title>

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
<?php
include 'C:\xampp\jpgraph-3.5.0b1\src\jpgraph.php';
include 'C:\xampp\jpgraph-3.5.0b1\src\jpgraph_line.php';
include 'C:\xampp\jpgraph-3.5.0b1\src\jpgraph_date.php';

$var_graph = $_POST["lsCompanyName"];
//echo $var_graph;

$user= 'root';
$pass = '';
$db = 'finance';
$conn=new mysqli('localhost',$user,$pass,$db) or die("unable to connect");
//echo"great work!";

$sql = "select Close,Date from stocks where Company = '$var_graph'";
$data = mysqli_query($conn,$sql) or die();
session_start();
$uname=$_SESSION['user_name'];
//echo $uname;
//$result_id = mysql_query("select OrganizationName from organizationtable where OrganizationName = '$var_graph'") or die(mysql_error());
//$c_id = mysql_fetch_array($result_id, MYSQL_NUM);

//$company_id = $c_id[0];
//$data = mysql_query("select Close,Date from stocks where OrganizationID = '$var_graph'");

$closearray = array();
$datearray = array();

while($row = mysqli_fetch_array($data, MYSQL_NUM))
{
	array_push($closearray, $row[0]);
	array_push($datearray, $row[1]);
}


$max = max($closearray);
//echo $max;
// Some (random) data
$ydata = array(11,3,8,12,5,1,9,13,5,7);
 
// Size of the overall graph
$width=350;
$height=250;
 
// Create the graph and set a scale.
// These two calls are always required
$graph = new Graph(800,600, 'auto');
$graph->SetScale("datlin",0,$max+10);

$graph->yaxis->scale->SetGrace(7);
$graph->img->SetMargin(50,30,40,130);
$graph->SetShadow();

$graph->yaxis->title->Set("Close");
$graph->xaxis->title->Set("Date");
$graph->title->Set($var_graph);

$lplot = new LinePlot($closearray);
$graph->xaxis->SetLabelAngle(90);
$graph->SetTickDensity(TICKD_NORMAL,TICKD_SPARSE);
$graph->xaxis->SetTickLabels($datearray);
$lplot->SetFillColor('red@0.5');
$graph->Add($lplot);
$graph->Stroke(); 

$user= 'root';
$pass = '';
$db = 'testdb';
$conn=new mysqli('localhost',$user,$pass,$db) or die("unable to connect");
//echo"great work!";

$sql = "insert into search(userName,searchValue) values('$uname','$var_graph')" ;
$data = mysqli_query($conn,$sql) or die();

?>
<a href="index.html" style="color:blue;font-size:30px;position:absolute;right:10px;top:50px;font-weight:bold;">back to home</a>

</body>
</html>

