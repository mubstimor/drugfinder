<?php
session_start();

if(!isset($_SESSION['LOGIN_ID'])){
	header('location:login.php');
}
$clientId = $_SESSION['LOGIN_ID'];

include('include/header.php');
include("include/config.php");
include("include/insert_codes.php");
include("include/function.php");

?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Contact</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Profile</h2>
					
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="profile.php" method="post">
						  <fieldset>
							<legend> Personal Details</legend>							
								
						<?php 
						if(isset($_POST['submit'])){							
							$fName =  $_POST['fname'];
							$lName =  $_POST['lname'];						
							$phone =  $_POST['phone'];
							$email =  $_POST['email'];
							
							$phone = clean($phone);
							$password = md5($_POST['password']);
							
							if(update_client($email, $fName, $lName, $phone,$password, $clientId)){
								echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Well done!</strong> You successfully updated the contact.
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
							
							$select="SELECT * FROM `client` WHERE clientId='$clientId'";
							$query=mysql_query($select) or die('<div class="alert alert-success">Client not found, <a href="my_contacts.php">click here</a> to view contacts</div>');
							$count = mysql_num_rows($query);
							
							while($result=mysql_fetch_array($query))
							{
							?>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">First Name</label>
								<div class="controls">								
								  <input class="input-xlarge focused" id="fname" name="fname" type="text" value="<?php echo $result['firstName'];?>"  data-rel="popover" data-content="This is usually the christian name e.g John" title="First Name">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Last Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="lname" type="text" name="lname" value="<?php echo $result['lastName'];?>" data-rel="popover" data-content="This is usually the surname e.g Kato" title="Last Name">
								</div>
							  </div>
							  							 
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Phone Number</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="phone" type="text" name="phone" value="<?php echo $result['phoneNumber'];?>"  data-rel="popover" data-content="This is usually in the form 2567xxxxxxxx" title="Phone Number">
								</div>
							  </div>
							  
							    <div class="control-group">
								<label class="control-label" for="focusedInput">Email</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="email" type="text" name="email" value="<?php echo $result['email'];?>"  data-rel="popover" data-content="This is usually in the form example@example.com" title="Email">
								</div>
							  </div>
							  
						   <div class="control-group">
								<label class="control-label" for="focusedInput">Password</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="password" type="password" name="password" value="<?php echo $result['email'];?>"  data-rel="popover" data-content="This is your new password" title="Password">
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
		
    
<?php include('include/footer.php'); ?>
