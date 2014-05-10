<?php 
//include("include/config.php"); 
include('../include/header.php');
//require('include/select_counts.php');
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
					<div>Total Owners</div>
					<div><?php echo count_owners(); ?></div>			
				</a>

				<a data-rel="tooltip" title="" class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-star-on"></span>
					<div>Total Taxis</div>
					<div><?php echo count_taxis(); ?></div>					
				</a>

				<a data-rel="tooltip" title="" class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-cart"></span>
					<div>Taxi Caretakers</div>
					<div><?php echo count_caretakers(); ?></div>
				</a>
				
				<a data-rel="tooltip" title="<?php $num = count_comments_unread(); if($num != 0){echo $num." new messages.";} ?>" class="well span3 top-block" href="comments.php">
					<span class="icon32 icon-color icon-envelope-closed"></span>
					<div>Messages</div>
					<div><?php echo count_comments(); ?></div>
					<?php if($num != 0){echo '<span class="notification red">'.count_comments_unread().'</span>';} ?>
				</a>
			</div>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i> Introduction</h2>
						
					</div>
					<div class="box-content">
						<h1>TAMS <small> for better management of tax-i revenue.</small></h1>
						<p>TAMS is the a revenue management system designed specifically to solve the problems being faced in the entire revenue collectioan process. This seamless solution provides KCCA with the most effective revenue management tools available in the market today. </p>
						<p>This administrative component is designed to enable the Authority look up for records that are stored in real time. </p>
						<p>Its a fully featured, responsive component for the system. Its optimized for tablet and mobile phones.</p> 
						<p><b>Contact us if you have any queries.</b></p>
						 <div class="span4 ">
								<div class="well">
								 
								  <h3>DISD,CiPSD</h3>
								  <p>COCIS, MUK<br/>
								  0778919203<br/>
								  disd@cis.mak.ac.ug
								  </p>								  
								</div>
							  </div>
						
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

				  

		  
       
<?php include('include/footer.php'); ?>
