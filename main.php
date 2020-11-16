<?php
	if(isset($_GET['action'])) {
		$file = $_GET['action'] . ".php";
		if(file_exists($file)) {
			include_once($file);
		} else{
?>
		<div class="alert-alert-warning">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>ERROR</strong> - Page does not exist !!!! <br> Please go back to <a href ="index.php" class="alert-link" >home page </a>
		</div>
	<?php
		}
	} else{
	?>
		<div class="jumbotron">
			<h1>Home page</h1>
			<p>Welcome to online library. If you want to use our services, please sign in.</p>
		</div>
	<?php
	}
	