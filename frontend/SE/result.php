<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Result</title>

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
<a href="index.html" style="color:blue;font-size:30px;position:absolute;right:10px;top:50px;font-weight:bold;">back to home</a>

<div align="center">
	<iframe src= "<?php echo "Normalized".$_POST['lsCompanyName'].".html"; ?>" height="400px" width="900px" scrolling="no" style="background-color: 						Snow;position:relative;top:130px" seamless >
	</iframe>
</div>
	<div class="col-lg-4" style="position:absolute;top:600px;left:30px;">
                    <div class="panel panel-default">
						<a href = "predicted_value.html" class="btn btn-lg btn-success btn-block">
								<i class="fa fa-shopping-cart fa-fw"></i><center>Prediction Algorithm -1</center>
								</a>
					</div>
	</div>
	<div class="col-lg-4" style="position:absolute;top:600px;left:850px;">
                    <div class="panel panel-default">
						<a href="<?php echo "predicted_value.php?comp="."predNormalized".$_POST['lsCompanyName'].".html"; ?>" class="btn btn-lg btn-success btn-block">
								<i class="fa fa-shopping-cart fa-fw"></i><center>Prediction Algorithm -2</center>
								</a>
					</div>
	</div>
</body>
</html>
