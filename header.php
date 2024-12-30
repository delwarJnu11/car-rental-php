<?php session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once "configs/config.php";
    require_once "helpers/helper.php";
    require_once "libraries/library.php";
    require_once "models/model.php";
    require_once "controllers/controller.php";

    if (!isset($_SESSION["uid"])) {
        header("location:$base_url");
    }

    $uid = $_SESSION["uid"];

?>
<!-- data-bs-theme="blue-theme" -->
<!DOCTYPE html>
<html
	lang="en"
	data-bs-theme="blue-theme">

<head>
	<meta charset="utf-8" />
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1" />
	<title>Car Rental Agency Management</title>
	<!--favicon-->
	<link
		rel="icon"
		href="<?php echo $base_url ?>/assets/images/favicon-32x32.png"
		type="image/png" />
	<!-- loader-->
	<link
		href="<?php echo $base_url ?>/assets/css/pace.min.css"
		rel="stylesheet" />
	<script src="<?php echo $base_url ?>/assets/js/pace.min.js"></script>

	<!--plugins-->
	<link
		href="<?php echo $base_url ?>/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css"
		rel="stylesheet" />
	<link
		rel="stylesheet"
		type="text/css"
		href="<?php echo $base_url ?>/assets/plugins/metismenu/metisMenu.min.css" />
	<link
		rel="stylesheet"
		type="text/css"
		href="<?php echo $base_url ?>/assets/plugins/metismenu/mm-vertical.css" />
	<link
		rel="stylesheet"
		type="text/css"
		href="<?php echo $base_url ?>/assets/plugins/simplebar/css/simplebar.css" />
	<!--bootstrap css-->
	<link
		href="<?php echo $base_url ?>/assets/css/bootstrap.min.css"
		rel="stylesheet" />
	<link
		href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap"
		rel="stylesheet" />
	<link
		href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined"
		rel="stylesheet" />
	<!--main css-->
	<link
		href="<?php echo $base_url ?>/assets/css/bootstrap-extended.css"
		rel="stylesheet" />
	<link
		href="<?php echo $base_url ?>/sass/main.css"
		rel="stylesheet" />
	<link
		href="<?php echo $base_url ?>/sass/dark-theme.css"
		rel="stylesheet" />
	<link
		href="<?php echo $base_url ?>/sass/blue-theme.css"
		rel="stylesheet" />
	<link
		href="<?php echo $base_url ?>/sass/semi-dark.css"
		rel="stylesheet" />
	<link
		href="<?php echo $base_url ?>/sass/bordered-theme.css"
		rel="stylesheet" />
	<link
		href="<?php echo $base_url ?>/sass/responsive.css"
		rel="stylesheet" />
	<link
		href="<?php echo $base_url ?>/css/mystyle.css"
		rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

	<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
	<script src="./jquery.js"></script>
</head>

<body>
	<?php include_once "views/layout/navbar.php"?>


	<?php include_once "views/layout/main_sidebar.php"?>


	<!--start main wrapper-->
	<main class="main-wrapper">
		<div class="main-content">