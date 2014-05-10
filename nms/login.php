<?php 
include("../include/config.php");
require('../include/select_counts.php');
session_start();
$failed='';

	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		if(check_super_admin($username, $password) != 0){
			$adminId = check_super_admin($username, $password);
			$_SESSION['NMS_ID']= $adminId;
			$_SESSION['username']= $username;
			$failed =false;
			if(check_admin_category($adminId)=='NMS'){
				header("Location:index.php");
			}
		}else{
			$failed = true;						
		}
		
	}
	

$no_visible_elements=true;
include('../include/nms_header.php');

?>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2><img id="logo-img" src="../img/hospital.png" width="100px" />Welcome to DrugFinder (NMS)</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
				<?php
					if(!isset($_POST['submit'])){
						echo "NMS Admin : Please login with your Username and Password.";
					}else{
					echo "Incorrect Login credentials";		
					}
				
				?>
					</div>
					<form class="form-horizontal" action="login.php" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" value="" placeholder="username" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" value="" placeholder="password" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="rememberme" value="1" name="rememberme" />Remember me</label>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" name="submit" class="btn btn-primary">Login</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
<?php include('../include/footer.php'); ?>
