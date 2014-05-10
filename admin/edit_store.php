<?php
session_start();

if(!isset($_SESSION['ADMIN_ID'])){
	header('location:login.php');
}
$adminId = $_SESSION['ADMIN_ID'];

include('../include/admin_header.php');
include("../include/config.php");
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
						<a href="#">Drug store</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Drug Store</h2>
					
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="edit_store.php" method="post">
						  <fieldset>
							<legend> Edit Drug Store</legend>							
								
						<?php 
						if(isset($_POST['submit'])){
							$store = $_POST['storeId'];							
							$cname =  mysql_real_escape_string($_POST['cname']);							
							$email =  $_POST['email'];											
							$phone =  $_POST['phone'];
							$address =  mysql_real_escape_string($_POST['address']);
							$latitude =  $_POST['latitude'];
							$longitude =  $_POST['longitude'];
							
							if(update_clinic($store, $cname, $email, $phone,$address,$latitude,$longitude)){
								echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Well done!</strong> You successfully edited the drug.
						</div>';
							}else{
								echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>Oh snap!</strong> Change a few things up and try submitting again.
						</div>';
							}
							
						}else{  					
							echo "";
						}
						?>							
							
							<?php 
														
							$select = "select * from clinic where clinicId='$storeId'";
							$query=mysql_query($select) or die('<div class="alert alert-success">Clinic not found, <a href="drug_stores.php">click here</a> to view drug stores</div>');
							$count = mysql_num_rows($query);
							
							if($count==0 && $storeId != ''){
							echo '<div class="alert alert-success">Drug store not found, <a href="drug_stores.php">click here</a> to view drug stores</div>';	
							}
							while($result=mysql_fetch_array($query))
							{
							?>							
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput"> Name</label>
								<div class="controls">
								 <input type="hidden" name="storeId" value="<?php echo $storeId; ?>">
								  <input class="input-xlarge focused" id="cname" name="cname" type="text"  data-rel="popover"  value="<?php echo $result['clinicName'];?>" data-content="This is the name of the clinic/drug store/pharmacy" title="Drug Store">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Email</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="email" type="text" name="email" data-rel="popover"  value="<?php echo $result['clinicEmail'];?>" data-content="example@example.com" title="Email">
								</div>
							  </div>
														
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Phone Number</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="phone" type="text" name="phone"  value="<?php echo $result['contactNumber'];?>"  data-rel="popover" value="<?php echo $contactNum; ?>" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
								</div>
							  </div>
							 
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Address</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="address" type="text" name="address"  value="<?php echo $result['address'];?>"  data-rel="popover" value="<?php echo $contactNum; ?>" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
								</div>
							  </div>
							  
							    <div class="control-group">
								<label class="control-label" for="focusedInput">Latitude</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="lat" type="text" name="latitude"  value="<?php echo $result['latitude'];?>" data-rel="popover" value="<?php echo $contactNum; ?>" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
								</div>
							  </div>
							  
							    <div class="control-group">
								<label class="control-label" for="focusedInput">Longitude</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="long" type="text" name="longitude"  data-rel="popover"  value="<?php echo $result['longitude'];?>" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
								</div>
							  </div>
									
							<div class="form-actions">
							  <button type="submit" name="submit" class="btn btn-primary">Update</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
							
							<?php } ?>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->	
		
    
<?php include('../include/admin_footer.php'); ?>
