<?php 
session_start();

if(!isset($_SESSION['LOGIN_ID'])){
	header('location:login.php');
}
$clientId = $_SESSION['LOGIN_ID'];

include('include/header.php');
include("include/config.php");
include("include/insert_codes.php");
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Drug</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Drug</h2>					
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="search_results.php" method="GET">
						  <fieldset>
							<legend>Search Drug</legend>
													
						<div class="alert alert-success">
							<!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
							<h4 class="alert-heading">Search for Drug First!</h4>
							<p>Before you add a new drug, we kindly request that you first search the system to verify whether the same drug has not been added before!</p>
						</div>
						
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Drug Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="drugname" name="drugname" type="text"  data-rel="popover" data-content="This is usually a name you've chosen e.g Customers" title="Drug Name">
								</div>
							  </div>
						
							<div class="form-actions">
							  <button type="submit" name="submit" value='1' class="btn btn-primary">Search</button>							  
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->		
    
<?php include('include/footer.php'); ?>
