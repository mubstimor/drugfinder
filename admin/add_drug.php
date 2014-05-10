<?php
session_start();

if(!isset($_SESSION['ADMIN_ID'])){
	header('location:login.php');
}
$adminId = $_SESSION['ADMIN_ID'];

include('../include/admin_header.php');
include("../include/config.php");
include("../include/function.php");
include("../include/insert_codes.php");
include("../include/select_counts.php");
if(isset($_REQUEST['contactNum'])){
	$contactNum = $_REQUEST['contactNum'];
}else{
	$contactNum ='';
}

?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
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
						<form class="form-horizontal" action="add_drug.php" method="post">
						  <fieldset>
							<legend>Add New Drug</legend>							
								
						<?php 
						if(isset($_POST['submit'])){
							$name =  mysql_real_escape_string($_POST['name']);
							$description =  mysql_real_escape_string($_POST['description']);											
							$prescription =  mysql_real_escape_string($_POST['prescription']);
							
							if(insert_drug_by_admin($name, $description, $prescription, $adminId)){
								echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Well done!</strong> You successfully added a new Drug.
						</div>';
							}else{
								echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Oh snap!</strong> Change a few things up and try submitting again.
						</div>';
							}
							
						}else{  					
							echo "";
						}
						?>							
							
							 <div class="control-group">
								<label class="control-label" for="focusedInput"> Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="name" name="name" type="text"  placeholder="name here..."  data-rel="popover" data-content="This is usually the christian name e.g John" title="First Name">
								</div>
							  </div>
							
							  <div class="control-group">
							  <label class="control-label" for="textarea2">Description</label>
							  <div class="controls">							  
								<textarea class="autogrow" id="messagebox"  placeholder="text here..." name="description" data-rel="popover" data-content="Say forexample: This drug is for 'purpose of drug'" title="Description"></textarea>
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="textarea2">Prescription</label>
							  <div class="controls">							  
								<textarea class="autogrow" id="messagebox"  placeholder="text here..." name="prescription" data-rel="popover" data-content="Say forexample: 1x4 for children below 16yrs, 2x3 for people above 16yrs" title="Prescription"></textarea>
							  </div>
							</div>
							
							<div class="form-actions">
							  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->	
		
    
<?php include('../include/admin_footer.php'); ?>
