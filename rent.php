<?php
	require_once("header.php");
	$id_user =$_SESSION['id'];
?>
<hr>
<?php
	$q = "SELECT id, Title, Rented, Number_of_copies FROM books ";
	$stmt = $conn->prepare($q);
	$stmt->execute();
	$books = $stmt->fetchAll();
	
    if(isset($_POST['submit'])){
    	$id_book = $_POST['cbx_books'];
		$q = "SELECT id, Title, Publisher, Rented, Number_of_copies FROM books WHERE id=$id_book";
		$stmt = $conn->prepare($q);
		$stmt->execute();
		$books_table = $stmt->fetchAll(PDO::FETCH_OBJ);

		$q2 = "SELECT id, Book_title ,Publisher, Rented FROM users WHERE id=$id_user";
		$stmt1=$conn->prepare($q2);
		$stmt1->execute();
		$user1 = $stmt1->fetchAll(PDO::FETCH_OBJ);
		foreach ($user1 as $p) {
		 	$rented = $p->Rented;		 	
		};

		if($rented >0){
			echo "You can't rent new books until you return the rented books!";
		} else{
			$number_books = $_POST['number_books'];
			foreach ($books_table as $p){
				$number_of_copies = $p->Number_of_copies;
				$rented = $p->Rented;
				$title = $p->Title;
				$publisher = $p->Publisher;
			};
		
		if($number_books > $number_of_copies){
			echo " There are not enough avaliabe books";
		} else{
		$q1 = " UPDATE books
							SET `Rented` =:rented,
							    `Number_of_copies` =:number_of_copies
							WHERE id = $id_book"; 
		$parameters =[
			':rented' => ($rented + $number_books),
			':number_of_copies'=>($number_of_copies - $number_books)
		];
		$statement = $conn->prepare($q1);
		$statement->execute($parameters);

		$q3 = " UPDATE users
							SET `Rented` =:rented,
							    `Book_title` =:book_title,
							    `Publisher` =:publisher
							WHERE id = $id_user"; 
		$parameters1 =[
			':rented'=>$number_books,
			':book_title'=>$title,
			':publisher'=>$publisher
		];
		$statement1 = $conn->prepare($q3);
		$statement1->execute($parameters1);

		}
	}
}	
?>
<center><h3>RENT A BOOK</h3></center>
<form method="POST" action="home.php?action=rent" enctype="multipart/form-data"> 
	<div>Choose the book:
		<select id="cbx_books" name="cbx_books">
			<option value="0">Choose the book</option>
			<?php foreach ($books as $book){ ?>
				<option value="<?php echo $book['id']; ?>"><?php echo $book['Title']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div>How many books:
		<input type="text" name="number_books" value="0"> <br>
		<input type="submit" name="submit" value="Rent a book">
	</div>
</form>
<?php
require_once("recommended.php");
?>