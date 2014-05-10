<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Home - DrugFinder NMS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Drug Finder, an app to enable people find drugs in drug stores around them.">
	<meta name="author" content="Jimmy Muyimbwa">

	<!-- The styles -->
	<link id="bs-css" href="../css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
		<link href="../css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../css/charisma-app.css" rel="stylesheet">
	<link href="../css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='../css/fullcalendar.css' rel='stylesheet'>
	<link href='../css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='../css/chosen.css' rel='stylesheet'>
	<link href='../css/uniform.default.css' rel='stylesheet'>
	<link href='../css/colorbox.css' rel='stylesheet'>
	<link href='../css/jquery.cleditor.css' rel='stylesheet'>
	<link href='../css/jquery.noty.css' rel='stylesheet'>
	<link href='../css/noty_theme_default.css' rel='stylesheet'>
	<link href='../css/elfinder.min.css' rel='stylesheet'>
	<link href='../css/elfinder.theme.css' rel='stylesheet'>
	<link href='../css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='../css/opa-icons.css' rel='stylesheet'>
	<link href='../css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>

<body>
	<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php"> <img alt="Drugfinder Logo" src="../img/logo20.png" /> <span>DrugFinder</span></a>
				
							
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>						
						<li><a href="admin_logout.php">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
		
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<li><a class="ajax-link" href="index.php"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>						
						<li><a class="ajax-link" href="search_drug.php"><i class="icon-lock"></i><span class="hidden-tablet"> Add Drug</span></a></li>
						<li><a class="ajax-link" href="add_store.php"><i class="icon-eye-open"></i><span class="hidden-tablet"> Distribute Drug</span></a></li>
						<li><a class="ajax-link" href="search_drug.php"><i class="icon-lock"></i><span class="hidden-tablet"> Record Stock</span></a></li>
						
						
						<li class="nav-header hidden-tablet">View Information</li>
						<li><a class="ajax-link" href="registered_drugs.php"><i class="icon-align-justify"></i><span class="hidden-tablet"> Drugs</span></a></li>
						<li><a class="ajax-link" href="drug_stores.php"><i class="icon-calendar"></i><span class="hidden-tablet"> Drug Stores</span></a></li>
						<li><a class="ajax-link" href="drug_stores.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Transaction History</span></a></li>
						
					
						<li class="nav-header hidden-tablet">Contact Drug Stores</li>
						<li><a class="ajax-link" href="client_queries.php"><i class="icon-folder-open"></i><span class="hidden-tablet"> Message History</span></a></li>
					</ul>
					
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php } ?>
