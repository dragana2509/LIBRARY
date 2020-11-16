<?php
	require_once("header.php");
	$id_user =$_SESSION['id'];
?>
<hr>
<?php
	$q = "SELECT id, Title, Rented, Number_of_copies FROM books ";
	$stmt=$conn->prepare($q);
	$stmt->execute();
	$books = $stmt->fetchAll();
	
    if(isset($_POST['submit'])){
    	$id_book = $_POST['cbx_books'];
		$q = "SELECT id, Title,Publisher, Rented, Number_of_copies FROM books WHERE id=$id_book";
		$stmt=$conn->prepare($q);
		$stmt->execute();
		$books_table = $stmt->fetchAll(PDO::FETCH_OBJ);
	 	$numberBooksForReturn = $_POST['number_books'];

		foreach ($books_table as $p) {
		 	$number_of_copies = $p->Number_of_copies;
		 	$rented = $p->Rented;
		 	$title = $p->Title;
		 	$publisher = $p->Publisher;
		}	
		if($numberBooksForReturn > $rented){
			echo "You can't return more books than you rented!";
		}  else{
				$q1 = "UPDATE books
							SET `Rented` =:rented,
							    `Number_of_copies` =:number_of_copies
							WHERE id = $id_book"; 
				$parameters =[
					':rented'=>($rented - $numberBooksForReturn),
					':number_of_copies'=>($number_of_copies + $numberBooksForReturn)
				];
				$statement = $conn->prepare($q1);
				$statement->execute($parameters);
			}		
		
		$q2 = "SELECT id, Book_title ,Publisher, Rented FROM users WHERE id=$id_user";
		$stmt1=$conn->prepare($q2);
		$stmt1->execute();
		$user1 = $stmt1->fetchAll(PDO::FETCH_OBJ);
		foreach ($user1 as $u){ 	
		 	$rented = $u->Rented;
		}
		if($numberBooksForReturn < $rented){
				$q3 = " UPDATE users
									SET `Rented` =:rented	
									WHERE id = $id_user"; 
				$parameters1 =[
					':rented' => ($rented - $numberBooksForReturn)
				];
				$statement1 = $conn->prepare($q3);
				$statement1->execute($parameters1);
		} elseif ($numberBooksForReturn == $rented) {
			echo "Thank you for returning all books!";
				$book_title ="";
				$publisher ="";
				$q4 = " UPDATE users
									SET `Rented` =:rented,
									    `Book_title` =:book_title,
									    `Publisher` =:publisher
									WHERE id = $id_user"; 
				$parameters2 =[	
					':rented'=>($rented - $numberBooksForReturn),
					':book_title'=>$book_title,
					':publisher'=>$publisher
				];
				$statement2 = $conn->prepare($q4);
				$statement2->execute($parameters2);
		} 
	}		
// da se promeni action na formi, novi fajl za submit logiku, posle submit header location na home.php action=return
?>
<center><h3>RETURN A BOOK</h3></center>
<form method="POST" action="home.php?action=return" enctype="multipart/form-data"> 
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
	<input type="submit" name="submit" value="Return books">
</div>
</form>
<?php
require_once("recommended.php");
?>