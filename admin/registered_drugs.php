<?php
session_start();

if(!isset($_SESSION['ADMIN_ID'])){
	header('location:login.php');
}
$adminId = $_SESSION['ADMIN_ID'];

include('../include/admin_header.php');
include("../include/config.php");
include("../include/select_counts.php");
include("../include/insert_codes.php");
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
						<h2><i class="icon-user"></i> Registered Drugs</h2>
						
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
								$select="select * from drug";
								$i=1;
								$query = mysql_query($select) or die("cannot select data". mysql_error());	
								while($result = mysql_fetch_array($query, MYSQL_ASSOC))
								{
								echo "<tr><td class='center'>".$i."</td>" ."<td class='center'>";								
								echo $result['drugName']."</td><td>".$result['drugDescription']." </td><td>".$result['prescription']." </td>";
								echo "<td class='center'>";
								echo "<a class='btn btn-info' href='edit_drug.php?id=".$result['drugId']. "'><i class='icon-edit icon-white'></i>Edit</a> ";
								echo "<a class='btn btn-danger' href='delete_drug.php?id=".$result['drugId']. "'><i class='icon-trash icon-white'></i>Delete</a>";																
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
			
    
<?php include('../include/admin_footer.php'); ?>
