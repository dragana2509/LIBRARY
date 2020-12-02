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

	if(!isset($_SESSION['id']) || $_SESSION['username'] != "admin"){
		header('Location:index.php');
	}
	
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
		} 
	require_once("recommended.php");
?>