<?php
session_start();

if(!isset($_SESSION['NMS_ID'])){
	header('location:login.php');
}
$adminId = $_SESSION['NMS_ID'];

include('../include/admin_header.php');
include("../include/config.php");
include("../include/insert_codes.php");
include("../include/function.php");
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
						<a href="#">Drug Store</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Drug Store</h2>
					
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="add_store.php" method="post">
						  <fieldset>
							<legend>Add New Store</legend>							
								
						<?php 
						if(isset($_POST['submit'])){
							$cname =  $_POST['cname'];
							$email =  $_POST['email'];											
							$phone =  $_POST['phone'];
							$address =  $_POST['address'];
							$latitude =  $_POST['latitude'];
							$longitude =  $_POST['longitude'];
							$username =  $_POST['username'];
							$password =  md5($_POST['password']);								
							
							$phone = clean($phone);
							
							if(add_drug_store($cname, $email, $phone, $address,$latitude,$longitude,$username,$password,$adminId)){
								echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Well done!</strong> You successfully added a new drug store.
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
								  <input class="input-xlarge focused" id="cname" name="cname" type="text"  data-rel="popover" data-content="This is the name of the clinic/drug store/pharmacy" title="Drug Store">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Email</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="email" type="text" name="email" data-rel="popover" data-content="example@example.com" title="Email">
								</div>
							  </div>
														
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Phone Number</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="phone" type="text" name="phone"  data-rel="popover" value="<?php echo $contactNum; ?>" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
								</div>
							  </div>
							 
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Address</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="address" type="text" name="address"  data-rel="popover" value="<?php echo $contactNum; ?>" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
								</div>
							  </div>
							  
							    <div class="control-group">
								<label class="control-label" for="focusedInput">Latitude</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="lat" type="text" name="latitude"  data-rel="popover" value="<?php echo $contactNum; ?>" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
								</div>
							  </div>
							  
							    <div class="control-group">
								<label class="control-label" for="focusedInput">Longitude</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="long" type="text" name="longitude"  data-rel="popover" value="<?php echo $contactNum; ?>" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
								</div>
							  </div>
							 
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Username</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="uname" type="text" name="username"  data-rel="popover" value="<?php echo $contactNum; ?>" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
								</div>
							  </div>
							 
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Password</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="pass" type="text" name="password"  data-rel="popover" value="<?php echo $contactNum; ?>" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
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
