<?php
session_start();
//echo $_SESSION['cart']['Quantity'];
// Check if any book delete button is pressed
if (isset($_POST['delete'])) {
    // Get the book ID to delete
    $book_id_to_delete = $_POST['delete'];
    
    // Remove the book from the session cart
    unset($_SESSION['cart'][$book_id_to_delete]);
    
    // Update the counter based on the number of remaining items in the cart
    $_SESSION['counter'] = count($_SESSION['cart']);
    
    // Redirect back to the cart page to refresh the display
    header("Location: cart.php");
    exit();
}

// Check if the clear button is clicked
if (isset($_POST['clear'])) {
    // Unset or remove the 'cart' session variable to clear the cart
    unset($_SESSION['cart']);
    // Reset the counter to 0
    $_SESSION['counter'] = 0;
    // Redirect back to the cart page to refresh the display
    header("Location: cart.php");
    exit();
}
	//if Checkout button is pressed
		 if(isset($_POST['checkout'])){
			 if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
              foreach ($_SESSION['cart'] as $book_id => $item) { 
            if (isset($item['book_details']) && is_array($item['book_details'])) {
                $book_details = $item['book_details'];
                $quan= $item['quantity'];
				
				$hostname="localhost";
    $username= "root";
    $password= "";
    $database= "house_of_words";
	
   $quanQuery = "SELECT  Quantity FROM product WHERE Book_id =" . $book_id;
	
    $conn = mysqli_connect($hostname, $username, $password, $database);
	if ( !$conn)
            {
                die( "Could not connect to database </body></html>" );
            }

    if ( !mysqli_select_db( $conn,$database ) )
			{
                die( "Could not open database </body></html>" );
			}
				 
				 $result = mysqli_query($conn, $quanQuery);
				 
				 
				   if ($result && mysqli_num_rows($result) > 0) {
				   $row = mysqli_fetch_assoc($result);
				   $quaninDB = intval($row['Quantity']);
				   $newquaninDB= $quaninDB-$quan;
				   $updateQuaninDBQuery = "UPDATE product SET Quantity=  $newquaninDB WHERE Book_id =" . $book_id;
				   mysqli_query($conn, $updateQuaninDBQuery );
				    // Close database connection
                   $conn->close();
				   
				  
				   }
			  }}}
			    // Empty the cart and delete the session
    unset($_SESSION['cart']);
    $_SESSION['counter'] = 0;

    // Redirect to the thank you page
    header('Location: thank.html');
    exit;
		 }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>ShoppingCart</title>
    <style type="text/css">
        body {
            background-color: #CFC5BB;
            font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;
        }

        .Button {
            margin-left: 45%;
            margin-top: 10px;
            margin-bottom: 10px;
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background-color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
        }

        .navigationBar {
            overflow: hidden;
            background: transparent;
            border: none;
            backdrop-filter: blur(15px) brightness(80%);
        }

        .navigationBar a {
            float: left;
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .navigationBar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navigationBar input[type=text] {
            float: right;
            padding: 6px;
            border: none;
            margin-top: 8px;
            margin-right: 16px;
            font-size: 17px;
        }

        .navigationBar img {
            float: left;
            width: 100px;
            height: 50px;
            display: inline-block;
        }

        .wrapper {
			
            width: 100%;
            display: grid;
            place-items: center;
            gap: 10px;
            margin-bottom: 20px;
			
        }

        .container {
            background-color: #CFC5BB;
            border-radius: 8px;
            position: relative;
            cursor: pointer;
            margin: 20px;
        }

        input[type="checkbox"] {
            position: absolute;
            width: 100%;
            left: 80px;
            top: -5px;
            cursor: pointer;
            color: white;
        }

        input[type="number"] {
            position: absolute;
            width: 20%;
            bottom: -20px;
            right: -1px;
            cursor: pointer;
        }

        .container img {
            width: 75%;
            height: 100%;
            position: absolute;
            margin: auto;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            cursor: pointer;
        }

        .quantity-label {
            position: absolute;
            bottom: -35px;
            left: 24px;
            margin-top: 10px;
        }

        .price-label {
            position: absolute;
            bottom: -60px; /* Adjusted the position */
            left: 24px;
            margin-top: 10px;
        }

        @media all {
            .wrapper {
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }

            .container {
                height: 200px;
                width: 200px;
            }
        }

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

        label {
            margin-left: 46.5%;
        }
		.total {
    position: relative;
    top: 350px;
    margin-left: auto;
    margin-right: auto;
}
		#deleteButton{
			position:relative;
			top:240px;
			margin-left: 23%;
            margin-top: 10px;
            margin-bottom: 10px;
            width: 50%;
            height: 40px;
            border-radius: 40px;
            background-color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
		}
		#plusButton{
			position:absolute;
			top:100%;
			left:70%;
			width: 15%;
            height: 30px;
            border-radius: 40px;
            background-color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
		}
		#minusButton{
			position:absolute;
			top:100%;
			left:90%;
			width: 15%;
            height: 30px;
            border-radius: 40px;
            background-color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
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


	  <div class="wrapper">
        <?php 
		 $total = 0; // Initialize total price
		  
		
		 
		// Update quantity and price for item in Cart
    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'quanUpdate_') !== false) {
                $bookID = substr($key, strlen('quanUpdate_'));
                $newQuan = $_POST['quantity_'.$bookID];

                if ($newQuan >= 0) {
                    // Update quantity of bookID
                    $_SESSION['cart'][$bookID]['quantity'] = $newQuan;

                    // Recalculate item total price
                    $book_details = $_SESSION['cart'][$bookID]['book_details'];
                    $item_total = $newQuan * $book_details['Price'];
                    $_SESSION['cart'][$bookID]['item_total'] = $item_total;
                }
            }
        }
    }

   // First time entering the book into the cart
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $book_id => $item) { 
            if (isset($item['book_details']) && is_array($item['book_details'])) {
                $book_details = $item['book_details'];
                $quantity = $item['quantity'];
                $item_total = isset($item['item_total']) ? $item['item_total'] : ($quantity * $book_details['Price']);

                // Calculate total price for this item
                $total += $item_total;

                echo "
                <div class='container'>
                    <form method='post' action='cart.php'>
                        <a href='BookDetails.php?image_id=$book_id'><img src='" . $book_details['Book_Image'] . "' /></a>
                        <p class='quantity-label'>Quantity: </p> <!-- Display quantity -->
                        <input type='number' name='quantity_$book_id' value='$quantity' min='1' max='" . $book_details['Quantity'] . "' >
                        <p class='price-label'>Price: $" . number_format($item_total, 2) . "</p>
                        <input type='hidden' value='$book_id' name='bookID'>
                        <button id='deleteButton' type='submit' name='quanUpdate_$book_id' >Update Quantity</button>
                        <button id='deleteButton' type='submit' name='delete' value='$book_id'>Delete Item</button>
                    </form>
                </div>";
            } else {
                echo "Invalid item data for book ID: $book_id"; // Display an error message
            }
        }
    } else {
        echo "<p>No items in the shopping cart.</p>";
    }



// Display total
echo "<div class='total'>
          <label>Total: $<span id='total'>" . number_format($total, 2) . "</span></label>
          <!-- Checkout, Clear, Continue Shopping buttons --> 
          <form method='post'><button class='Button' type='submit' name='checkout'>CheckOut</button></form>
          <form method='post'><button class='Button' type='submit' name='clear'>Clear</button></form>
          <a href='homepage.php'><button class='Button'>Continue Shopping</button></a>
      </div>";
	  
			  
        ?>
		
 </div>
</body>

</html>