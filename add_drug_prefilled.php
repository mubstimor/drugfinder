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
if(isset($_REQUEST['id'])){
	$drugId = $_REQUEST['id'];
}else{
	$drugId='';
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
						<form class="form-horizontal" action="add_drug_prefilled.php" method="post">
						  <fieldset>
							<legend> Add Drug to My Store</legend>							
								
						<?php 
						if(isset($_POST['submit'])){
							$drugId = $_POST['drugId'];
							$price =  $_POST['price'];
							
							if(assign_drug_to_clinic($clientId,$drugId,$price)){
								echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Well done!</strong> You successfully added the drug to your store.
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
							
							$select="SELECT * FROM drug WHERE drugId='$drugId'";
							$query=mysql_query($select) or die('<div class="alert alert-success">Drug not found, <a href="my_drugs.php">click here</a> to view drugs in your store</div>');
							$count = mysql_num_rows($query);
							
							if($count==0){
							echo '<div class="alert alert-success">Drug not found, <a href="my_drugs.php">click here</a> to view drugs in your store</div>';	
							}
							while($result=mysql_fetch_array($query))
							{
							?>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Drug Name</label>
								<div class="controls">
								 <input type="hidden" name="drugId" value="<?php echo $drugId; ?>">
								  <input class="input-xlarge focused" id="name" name="name" type="text" disabled value="<?php echo $result['drugName'];?>"  data-rel="popover" data-content="This is usually the christian name e.g John" title="First Name">
								</div>
							  </div>
							  
							  <div class="control-group">
							  <label class="control-label" for="textarea2">Description</label>
							  <div class="controls">							  
								<textarea class="autogrow" id="messagebox"  placeholder="text here..." name="description" disabled data-rel="popover" data-content="Say forexample: This drug is for 'purpose of drug'" title="Description"><?php echo $result['drugDescription'];?></textarea>
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="textarea2">Prescription</label>
							  <div class="controls">							  
								<textarea class="autogrow" id="messagebox"  placeholder="text here..." name="prescription" disabled data-rel="popover" data-content="Say forexample: 1x4 for children below 16yrs, 2x3 for people above 16yrs" title="Prescription"><?php echo $result['prescription'];?></textarea>
							  </div>
							</div>							  
							  
								<div class="control-group">
									  <label class="control-label" for="textarea2">Dosage Price</label>
									  <div class="controls">							  
										<textarea class="autogrow" id="messagebox"  placeholder="text here..." name="price" data-rel="popover" data-content="Say forexample: 2000 for children dosage, 4000 for adult dosage" title="Pricing"></textarea>
									  </div>
								</div>
									
							<div class="form-actions">
							  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
							
							<?php } ?>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->	
		
    
<?php include('include/footer.php'); ?>
