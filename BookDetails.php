<!DOCTYPE html>

<?php
session_start(); // Start the session

 $image_id = isset($_GET['image_id']) ? intval($_GET['image_id']) : 0;
 
  // Connect to the database
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "house_of_words";
    $outMssg = "";
	
    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn) {
        die("Could not connect to database");
    }

    if (!mysqli_select_db($conn, $database)) {
        die("Could not open database");
    }
	
	$quantityQuery="SELECT Quantity FROM product WHERE Book_id =" .  $image_id ;
	$result1 = mysqli_query($conn, $quantityQuery);
        if ($result1 && mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
			$DBquan = intval($row['Quantity']);
		}
		if($DBquan>0){
		
//Check if the form has been submitted
if(isset($_POST['book_id'])) {
    $book_id = intval($_POST['book_id']);
    $quantity = intval($_POST['quan']); // Added: Get quantity from form

    
 

    if(isset($_POST['Checkout'])) {
       $BookQuery = "SELECT * FROM product WHERE Book_id =" . $book_id;
        // echo "Debug: Query: $BookQuery<br>"; // Debugging output
        $result = mysqli_query($conn, $BookQuery);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
           $_SESSION['cart'][$book_id] = [
            'book_details' => $row,
            'quantity' => $quantity // Store chosen quantity
        ];
			header("Location: cart.php");
        exit;
        } else {
            echo "Debug: No book found with the given ID<br>"; // Debugging output
        }
    } elseif(isset($_POST['addToCart'])) {
    //   Only store book details in session without redirecting
        $BookQuery = "SELECT * FROM product WHERE Book_id =" . $book_id;
        $result = mysqli_query($conn, $BookQuery);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
           $_SESSION['cart'][$book_id] = [
            'book_details' => $row,
            'quantity' => $quantity // Store chosen quantity
        ];
        } else {
            echo "Debug: No book found with the given ID<br>"; // Debugging output
        }
    }
    mysqli_close($conn);
} else {
   // echo "Debug: Add to cart button was not pressed<br>"; // Debugging output
		}}else{
			 $outMssg="Out of Stock";
		}
?>

<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Description</title>
    <style>
	 header {
            position: relative;
            background-color: #ac9b91;
            color: #fff;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .logo img {
            position: static;
            top: 0;
            left: 15;
            width: 80px;
            height: 80px;
        }

        nav {
            display: flex;
            align-items: center;
            margin-right: 45%;
        }

        nav ul {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        nav ul li {
            margin-left: 25px;
            list-style: none;
        }

        nav ul li {
            margin-left: 25px;
            list-style: none;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 19px;
            font-weight: bold;
            transition: 0.4s ease;
        }

        .active:hover {
            background-color: #ddd;
            color: black;
        }

        nav ul: hover {
            background-color: #ddd;
            color: black;
        }

        nav ul li a: hover {
            color: #666;
            background-color: #ddd;
            color: black;
        }

	.back {float: right; margin-right:45%; margin-left:10px; margin-bottom:10px; width: 10%; height: 40px; border-radius: 40px; background-color: #fff; border: none; outline: none; cursor: pointer; font-size: 1em; font-weight: 600;}
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #CFC5BB;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #F5F1E8;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex; /* Added */
            align-items: flex-start; /* Added */
        }
        .book-image {
            margin-right: 20px; /* Added */
        }
        h1 {
            color: #333;
        }
        p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
 <header>
        <div class="logo">
            <img src="img/imagesLogo.png">
        </div>
        <nav>
            <ul>
                <li><a class="active" href="cart.php">Shopping Cart</a></li>
                <li><a class="active" href="homepage.php">Home</a></li>
            </ul>
        </nav>
		
    </header>
<?php 
if(isset($_GET)){
    $hostname="localhost";
    $username= "root";
    $password= "";
    $database= "house_of_words";
	
	
  
   $BookQuery = "SELECT * FROM product WHERE Book_id =" . $image_id;
	
    $conn = mysqli_connect($hostname, $username, $password, $database);
	if ( !$conn)
            {
                die( "Could not connect to database </body></html>" );
            }

    if ( !mysqli_select_db( $conn,$database ) )
			{
                die( "Could not open database </body></html>" );
			}

     $result = mysqli_query($conn, $BookQuery);
	 $resultCheck = mysqli_num_rows($result);
	
	 
	 if($resultCheck > 0){
		 $row = mysqli_fetch_assoc($result);
		 
		 echo "
		  <form action='BookDetails.php?image_id=". $image_id ."'  method='post'>
		 <div class='container'>
        <img class='book-image' src='" . $row['Book_Image']  . "' alt='Book Cover' style='max-width: 150px; height: auto;'> <!-- Added -->
        <div>" . "<h1>" . $row['Book_name'] . "</h1>" 
		. "<p>" . $row['Product_description'] . "</p>"
		. "<p><strong>Author:</strong>" . $row['Author_name'] . "</p>"
		. "<p><strong>Genre:</strong>" . $row['Book_genre'] . "</p>"
		. "<p><strong>Published:</strong>" . $row['Published'] . "</p>"
		. "<p><strong>Pages:</strong>" . $row['Pages'] . "</p>"
		. "<p><strong>Price:</strong>" . $row['Price'] . "</p>"
		. "<strong>Quantity:</strong><input type = 'number' name= 'quan' min = '1' max ='". $row['Quantity'] ."' value = '1' step = '1'> "
		. "<p style ='color:red;'><strong>$outMssg</strong></p>"
		."</div>
    </div>
	
	
    <input type='hidden' name='book_id' value= '". $image_id ."'>
    <button name='Checkout' class='back' type='submit'>Checkout</button>
    <button name='addToCart' class='back' type='submit'>Add to Cart</button>
</form>
	 <a href='homepage.php'><button class='back'>Back to Homepage</button></a>
</body>
</html>" ;
	 }else{
		 die( "No Results </body></html>" );
	 }
}else{
	 echo "Unautharized access </body></html>";
	 header("Location: homepage.php");
	 die();
}
?>
  