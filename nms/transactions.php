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
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Transactions</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Transaction History</h2>
						
					</div>
					<div class="box-content">
						
				
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>No.</th>								  
								  <th>Name</th>								  
								  <th>Drug</th>
								  <th>Quantity</th>								  
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
								<?php								
								$select="select * from clinic c,drug d, drug_distribution ds where c.clinicId=ds.clinicId AND d.drugId=ds.drugId";
								$i=1;
								$query = mysql_query($select) or die("cannot select data". mysql_error());	
								while($result = mysql_fetch_array($query, MYSQL_ASSOC))
								{
								echo "<tr><td class='center'>".$i."</td>" ."<td class='center'>";								
								echo $result['clinicName']."</td><td>".$result['drugName']." </td><td>".$result['carton_quantity']." </td>";
								echo "<td class='center'>";
								echo "<a class='btn btn-success' href='#?id=".$result['clinicId']. "'><i class='icon-zoom-in icon-white'></i>View</a>";
								echo "<a class='btn btn-info' href='edit_store.php?id=".$result['clinicId']. "'><i class='icon-edit icon-white'></i>Edit</a> ";
								echo "<a class='btn btn-danger' href='delete_store.php?id=".$result['clinicId']. "'><i class='icon-trash icon-white'></i>Delete</a>";																
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
