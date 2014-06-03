<?php
session_start();

if(!isset($_SESSION['NMS_ID'])){
	header('location:login.php');
}
$adminId = $_SESSION['NMS_ID'];

include('../include/nms_header.php');
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
						<a href="#">Stock</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Stock</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="record_stock.php" method="post">
						  <fieldset>
							<legend> Record Stock</legend>
										
						<?php 
						if(isset($_POST['submit'])){
							$drugId =  $_POST['drug'];
							$serial =  $_POST['serial'];
							$quantity =  $_POST['boxnum'];
							$expiryDate =  $_POST['end'];
														
							$expiryDate =  date("Y-m-d", strtotime($expiryDate) );
							
							if($drugId==''){
								echo '<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">X</button>
								<strong>Oh snap!</strong> No Drug was selected.
								</div>';
							}else{								
								
							if(add_drug_stock($drugId,$serial,$expiryDate,$quantity)){
								echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Well done!</strong> You successfully recorded the drug\'s stock.
						</div>';
							}
							else{
								echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Oh snap!</strong> Change a few things up and try submitting again.
						</div>';
							}
							
							}//end outer if
							
						}else{  					
							echo "";
						}
						?>	
										
							  
						  <div class="control-group">
								<label class="control-label" for="selectError">Drug Name</label>
								<div class="controls">
								  <select data-placeholder="Select Group" name="drug" id="selectError2" class="group" data-rel="chosen">
								 <option value=""></option>	
                                    <?php 
                                   echo get_drugs();
                                    ?>
								  </select>
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="focusedInput"> Serial Number</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="name" name="serial" type="text"  placeholder="xjjdhdci..."  data-rel="popover" data-content="This is usually the christian name e.g John" title="First Name">
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput"> Number of Boxes</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="name" name="boxnum" type="text"  placeholder="xx"  data-rel="popover" data-content="This is usually the christian name e.g John" title="First Name">
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
