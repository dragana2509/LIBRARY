<?php
	session_start();
	require_once("header.php");
	require_once("conn.php");
?>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<h1><center>WELCOME TO ONLINE LIBRARY</center></h1>
						<?php
							include_once("menu.php");
						?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
						<?php
							include_once("main.php");
						?>
				</div>
				<div class="col-md-3">
						<div class="well">
						<?php
							include_once("login.php");
						?>
						</div>
				</div>
			</div>
		</div>

<?php
	require_once 'recommended.php';
?>
	</body>
</html>