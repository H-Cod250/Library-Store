<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Page</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/edit_page_style.css" type="text/css" />
</head>

<body>
    <?php
		//DB connection
		$conn = mysqli_connect("localhost", "root", "");
		if(!$conn)
			die("DB is 404 </body></html>");
		//open house_of_words DB
		if(!mysqli_select_db($conn, "house_of_words"))
			die("house_of_words is 404 </body></html>");
		//save all products data into $resault
		$resault = mysqli_query($conn, "SELECT * FROM product");
		if(! $resault){
			echo "<p>Could not execute query!</p>";
			die(mysqli_error($conn));
		}
		//close connection to DB
		mysqli_close($conn);
	?>

    <header>
        <div class="logo">
            <img src="img/imagesLogo.png">
        </div>
        <h2>HouseOfWords Delete Page</h2>
    </header>

    <div class="page">
        <form action="delete_book.php" method="GET">

            <div class="edit-list">
                <input type="text" name="id" id="bookslist" placeholder="Select a book" list="books" />

                <datalist class="datalist" id="books">
                    <?php
                        while($row = mysqli_fetch_assoc($resault)){
                            echo
                            "<option value=".$row["Book_id"].">"
                            . $row["Book_name"]. 
                            "</option>";
                        }
                    ?>
                </datalist>
            </div>

            <div>
                <button class="edit-button" type="submit">Delete</button>
            </div>
        </form>
    </div>

</body>

</html>
