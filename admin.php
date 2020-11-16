<?php
	require_once("header.php");
?>
<body>
	<div class="jumbotron">
		<center> <h3>ADMIN HOME PAGE</h3></center>
		<hr>
<?php
	session_start();
	require_once("conn.php");

	if(isset($_SESSION['id'])) {
	
?>
	<a href="admin.php?action=add_books">ADD BOOKS INTO LIBRARY</a> | 
	<a href="admin.php?action=show_books">SHOW BOOKS FROM LIBRARY</a> |
	<a href="admin.php?action=show_users">SHOW USERS FROM LIBRARY</a> |
	<a href="admin.php?action=show_user_admin">EDIT AND/OR DELETE USER</a> |
	<a href="admin.php?action=profile">PROFILE</a> |
	<a href="logout.php">LOG OUT</a> 
	<hr>
<?php
	if(isset($_GET['action'])){
		$file = $_GET['action'] .".php";
		if(file_exists($file)){
			include_once ($file);
		} else{
			echo "Page does not exist, please go back to <a href= 'index.php'>HOME PAGE</a>";
		}
	} else{
			
			
		}
	} else {
		// sesija ne postoji, za goste sajta, ne prijavljene 
?>
		<a href="index.php">HOME</a> |
		<a href="index.php?action=registar">REGISTRATION</a> |
		<a href="index.php?action=login">LOG IN</a><hr>
<?php
	if(isset($_GET['action'])){
		$file = $_GET['action'] .".php";	
			if(file_exists($file)){
				include_once ($file);
			} else{
				echo "Page does not exist, please go back to <a href= 'home.php'>HOME PAGE</a>";
			}
		} else{
			include_once("login.php");
			include_once("register.php");
		}
	}
	$connection = "conn.php";
	if(file_exists($connection)){
		include_once($connection);
	} else{
		die("Fatal error, please contact ADMIN!");
	}
	require_once("recommended.php");
?>