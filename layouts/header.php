<?php include 'functions.php';?>
<?php if(!isset($_SESSION['id'])) { 
	header('location: login.php');
}
if(isset($_GET['logout']) === true) {
	do_logout();
}
?>
<!DOCTYPE html>
<html lang="en" class="layout-static">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>NVSU COVID SCREENING AND MONITORING SYSTEM</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="assets/parsley/parsley.css" rel="stylesheet" type="text/css">
	<link href="assets/css/custom.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->



</head>