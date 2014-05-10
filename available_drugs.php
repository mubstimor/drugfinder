<?php
session_start();

if(!isset($_SESSION['LOGIN_ID'])){
	header('location:login.php');
}
$clientId = $_SESSION['LOGIN_ID'];

include('include/header.php');
include("include/config.php");
include("include/select_counts.php");
include("include/insert_codes.php");
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Drugs</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Drugs registered in the system</h2>
						
					</div>
					<div class="box-content">
						
				
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>No.</th>								  
								  <th>Name</th>								  
								  <th>Description</th>
								  <th>Prescription</th>								  
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
								<?php								
								$select="select * from drug d";
								$i=1;
								$query = mysql_query($select) or die("cannot select data". mysql_error());	
								while($result = mysql_fetch_array($query, MYSQL_ASSOC))
								{
								echo "<tr><td class='center'>".$i."</td>" ."<td class='center'>";								
								echo $result['drugName']."</td><td>".$result['drugDescription']." </td><td>".$result['prescription']." </td>";
								echo "<td class='center'><a class='btn btn-success' href='add_drug_prefilled.php?id=".$result['drugId']. "'><i class='icon-zoom-in icon-white'></i>Add to My Store</a> ";																
								echo "</td>";								
								echo "</tr>";
								$i++;						

								}

								?>
																																																																				
																				
						  </tbody>
					  </table>  
					   
					</div>
				</div><!--/span-->
			
			</div><!--/row-->		
			
    
<?php include('include/footer.php'); ?>
