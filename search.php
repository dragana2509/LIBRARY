<?php
require_once("header.php");
?>
<div class="jumbotron">
	<hr>
		<center><h1>Search </h1></center> <br><br>
	<hr>
		<form method="post" action="home.php?action=search">
			<label>
				<select name="column">
					<option value="select">Select all</option>
					<option value="Title" >By title</option>
					<option value="Author">By author</option>
					<option value="Publisher">By publisher</option>
					<option value="Genre">By genre</option>
				</select>
			</label>
			<label>
				<input name="key_word" type="text" size="80" />
			</label>
			<label>
				<input type="submit" name="search_book" value="Search" />
			</label>
		</form>
</div>
<div class="jumbotron">
<h2>Search results</h2>
	<?php
		if(isset($_POST['search_book'])){
			$column = $_POST['column'];
			if($column == "select"){
				echo "You must select type of search!";
			} else{
				
				$key_word = $_POST['key_word'];
				$query = "SELECT * FROM `books` b 
						JOIN publisher p ON b.Publisher_id=p.id_publisher
						WHERE ".$column." LIKE :search_word"
						;
				
				$statement = $conn->prepare($query);
				$data =['search_word'=>'%'.$key_word.'%'];
				$statement->execute($data);
				
		if($statement->rowCount()>0){
	?>
			<table border="1">
			<tr>
				<th>Title</th>
				<th>Author</th>
				<th>Publisher</th>
				<th>Published on</th>
				<th>Genre</th>
				<th>ISBN</th>
				<th>Number of pages</th>
				<th>Number of copies in library</th>
			</tr>
		<?php
			while($row = $statement->fetch()){
		?>
				<tr>
					<td><?php echo $row['Title'] ?></td>
					<td><?php echo $row['Author'] ?></td>
					<td><?php echo $row['Publisher'] ?></td>
					<td><?php echo $row['Published_on'] ?></td>
					<td><?php echo $row['Genre'] ?></td>
					<td><?php echo $row['ISBN'] ?></td>
					<td><?php echo $row['Number_of_pages'] ?></td>
					<td><?php echo $row['Number_of_copies'] ?></td>
				</tr>
		<?php
			}
			echo "</table>";
		}
	}	
}
?> 
<br>
</div>
</body>
</html>