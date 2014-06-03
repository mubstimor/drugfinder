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
						<a href="#">License</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> License</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="add_license.php" method="post">
						  <fieldset>
							<legend>Add License for Drug Store</legend>
										
						<?php 
						if(isset($_POST['submit'])){
							$drugstore =  $_POST['store'];
							$startDate =  $_POST['start'];
							$expiryDate =  $_POST['end'];
							
							//format the two dates to a db cron usable format
							$startDate =  date("Y-m-d", strtotime($startDate) );
							$endDate =  date("Y-m-d", strtotime($endDate) );
							
							if($drugstore==''){
								echo '<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">X</button>
								<strong>Oh snap!</strong> No Drug Store was selected.
								</div>';
							}else{								
								
							if(add_license($drugstore,$startDate,$expiryDate)){
								echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Well done!</strong> You successfully added a license to a clinic.
						</div>';
							}
							else{
								echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Oh snap!</strong> Change a few things up and try submitting again or check that the user does not exist in the group.
						</div>';
							}
							
							}//end outer if
							
						}else{  					
							echo "";
						}
						?>	
										
							  
						  <div class="control-group">
								<label class="control-label" for="selectError">Clinic Name</label>
								<div class="controls">
								  <select data-placeholder="Select Group" name="store" id="selectError2" class="group" data-rel="chosen">
								 <option value=""></option>	
                                    <?php 
                                   echo get_drug_stores();
                                    ?>
								  </select>
								</div>
							  </div>

							 <div class="control-group">
							  <label class="control-label" for="date01">Date Effective</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" name="start" id="date" value="" placeholder="mm/dd/yyyy">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Date of Expiry</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker"  name="end" id="date" value="" placeholder="mm/dd/yyyy">
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
