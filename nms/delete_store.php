<?php
session_start();

if(!isset($_SESSION['NMS_ID'])){
	header('location:login.php');
}
$adminId = $_SESSION['NMS_ID'];

include('../include/nms_header.php');
include("../include/config.php");
include("../include/select_counts.php");
include("../include/insert_codes.php");
include("../include/function.php");

if(isset($_REQUEST['id'])){
	$storeId = $_REQUEST['id'];
}else{
	$storeId='';
}
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Delete</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-picture"></i>Delete</h2>
						
					</div>
					<div class="box-content">
						
					<form class="form-horizontal" action="delete_drug.php" method="post">
						  <fieldset>
												
								
						<?php 
						if(isset($_POST['submit'])){
							
							$drug = $_POST['drugId'];
							
							if(delete_clinic_by_admin($storeId)){
								echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">X</button>
 							<strong>Well done!</strong> You successfully deleted the drug store.
						</div>';
							}else{
								echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Oh snap!</strong> something went wrong.
						</div>';
							}
							
						}else{							
						
						?>						
							<legend>Do you want to delete?</legend>		
							<div class="alert alert-info">
							Are you sure you want to delete <b>
							<?php
							 $details = get_clinicDetails($storeId);
							 echo $details[0].' : '.$details[1];
							 ?>
							 </b>from the list of registered Drug Stores?
							</div>
							<div class="control-group">
								<div class="controls">
								  <input type="hidden" name="storeId" value="<?php echo $storeId; ?>">
								</div>
							  </div>
							  
							<div class="form-actions">
							  <button type="submit" name="submit" class="btn btn-primary">Yes</button>						  
							   <a href="#" class="btn" data-dismiss="modal">No</a>
							</div>
						  </fieldset>
						</form>
						<?php } ?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

    
<?php include('../include/admin_footer.php'); ?>
