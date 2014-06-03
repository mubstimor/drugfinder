<?php
session_start();

if(!isset($_SESSION['ADMIN_ID'])){
	header('location:login.php');
}
$adminId = $_SESSION['ADMIN_ID'];

include('../include/admin_header.php');
include("../include/config.php");
require('../include/select_counts.php');

?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
			</div>
			<div class="sortable row-fluid">
				<a data-rel="tooltip" title="" class="well span3 top-block" href="#">
					<span class="icon32 icon-red icon-user"></span>
					<div>Total Drugs</div>
					<div><?php //echo count_values($clientId, 'group'); ?></div>					
				</a>

				<a data-rel="tooltip" title="" class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-star-on"></span>
					<div>Unavailable Drugs</div>
					<div><?php //echo count_values($clientId, 'contact'); ?></div>				
				</a>
			
			<!-- 
				<a data-rel="tooltip" title="$34 new sales." class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-cart"></span>
					<div>Balance</div>
					<div>Ushs. <?php //echo count_balance($clientId); ?> </div>					
				</a>
			 -->
			
				<a data-rel="tooltip" title="" class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-envelope-closed"></span>
					<div>Client Queries</div>
					<div><?php //echo count_values($clientId, 'message'); ?></div>					
				</a>
			</div>
			
					<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i> Introduction</h2>
						
					</div>
					<div class="box-content">
						<h1>DrugFinder <small> let people find drugs in your store.</small></h1>
						<p>DrugFinder is a system designed specifically to solve the problems being faced while looking for drugs. This seamless solution provides Pharmacists with the most effective marketing tool in the market today. </p>
						<p>This administrative component is designed to enable the Pharmacies/Hospitals/clinics/drug store managers look up for records that are stored in real time. </p>
						<p>Its a fully featured, responsive component for the system. Its optimized for tablet and mobile phones.</p> 
						<p><b>Contact us if you have any queries.</b></p>
						 <div class="span4 ">
								<div class="well">
								 
								  <h3>Group CSC 14-88</h3>
								  <p>COCIS, MUK<br/>
								  +(256)077-8-919-203<br/>
								  jgyagenda@cis.mak.ac.ug
								  </p>								  
								</div>
							  </div>
						
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			
			       
<?php include('../include/admin_footer.php'); ?>
