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

if(isset($_REQUEST['drugname'])){
	$drugname = $_REQUEST['drugname'];
}else{
	$drugname='';
}
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Search Results</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Search Results for <?php echo $drugname; ?> </h2>
						
					</div>
					
					<div class="box-content">
						
				<?php
					 if(count_searchResults($drugname)==0)
					 {
					 	echo '<div class="alert alert-info">Oh snap! Your search did not return any results.<a href="add_drug.php">Click here</a> to add a new one.</div>';
						}else
							{
						 ?>
						 
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>No.</th>								  
								  <th>Name</th>								  
								  <th>Description</th>
								  <th>Prescription</th>								  
								  <th>Status</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
								<?php								
								$select="select * from drug where drugName Like'%$drugname%'";
								$i=1;
								$query = mysql_query($select) or die("cannot select data". mysql_error());	
								while($result = mysql_fetch_array($query, MYSQL_ASSOC))
								{
								echo "<tr><td class='center'>".$i."</td>" ."<td class='center'>";								
								echo $result['drugName']."</td><td>".$result['drugDescription']." </td><td>".$result['prescription']." </td>";
								echo "<td class='center'>";														
									echo "<span class='label label-warning'>Already exists</span>";																							
								echo "</td>";								
								echo "</tr>";
								$i++;						

								}

								?>
																																																																				
																				
						  </tbody>
					  </table>  
					
					  <?php } ?>
					     
					</div>
				</div><!--/span-->
			
			</div><!--/row-->		
			
    
<?php include('../include/footer.php'); ?>
