<?php 
session_start();
// Check if admin is logged in
if(!isset($_SESSION['email'])) {
    // Redirect to admin login page
    header("Location: signin.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new book</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
        var helpText;
        function init() { 
            helpText = document.getElementById("helpText");
            var myForm = document.getElementById("add-product-form");
            myForm.onsubmit = function() {
                return validate();
            }; 
        }
        
        function validate() { 
            var pass = "";
            var Book_Name = document.getElementById("Book_Name").value;
            var Book_Genre = document.getElementById("Book_Genre").value;
            var Author_Name = document.getElementById("Author_Name").value;
            var Publisher_Name = document.getElementById("Publisher_Name").value;
            var book_pages = document.getElementById("book-pages").value;
            var product_price = document.getElementById("product-price").value;
            var Product_Quantity = document.getElementById("Book_Quantity").value;
            var product_description = document.getElementById("product-description").value;
            var product_image = document.getElementById("product-image").value;
            
               if (Book_Name === "") {
                pass += "Please Enter the Book Name<br>"; 
            }
            if (!Book_Name.match(/[a-zA-Z]/)) {
                pass += "Book Name Must Be Written in Alphabet<br>";
            }
            if (Book_Genre === "") {
                pass += "Please Enter the Book Genre<br>"; 
            }
            if (!Book_Genre.match(/^[A-Za-z_]+$/)) {
                pass += "Book Genre Must Be Written in Alphabet<br>";
            }
            if (Author_Name === "") {
                pass += "Please Enter the Author Name<br>"; 
            }
            if (!Author_Name.match(/^[A-Za-z_]+$/)) {
                pass += "Author Name Must Be Written in Alphabet<br>";
            }
            if (Publisher_Name === "") {
                pass += "Please Enter the Publisher Name<br>"; 
            }
            if (Publisher_Name.match === "") {
                pass += "Publisher name must be written in alphabet<br>";
            }
            if (book_pages === "") {
                pass += "Please Enter the Number of Pages<br>";
            }
      if (isNaN(parseFloat(product_price))) {
        pass += "Please Enter a Valid Price for the Book<br>";
    }             
     if (product_description === "") {
                pass += "Please Enter the Description of the Book<br>";
            }
            if (product_image === "") {
                pass += "Please Upload a Picture<br>";
            }

           if (pass !== "") {
        helpText.innerHTML = pass;
        return false;
    } else {
        helpText.innerHTML = ""; // Clear any previous error messages
        return true;
    }
}            </script>
</head>
<style>
    body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
}

body div {
	padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-right:40px;
	
}

header {
    background-color: #CFC5BB;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}




header h2 {
    font-size: 1.5em;
    margin: 0;
    text-align: center;
    position:absolute;
    top:40px;    
    right:20px; 
    left:20px; 
    color: #fff;
}

main {
    padding: 20px;
}

#add-product-form {
    display: flex;
    flex-wrap: wrap;
    width: 500px;
    margin: 0 auto;
}

#add-product-form label {
    width: 120px;
    margin-bottom: 5px;
}

#add-product-form input,
#add-product-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
}

#add-product-form button {
    background-color: #a85658;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    margin-right: 10px;
}


#add-product-form button:hover {
    background-color: #F5F1E8;
}
.logo img{
    position:relative;
    top:0;
    left:15px;
    width:80px;
    height:80px;
}

#helpText {
    position: absolute;
    left: 50%;
    top: 170%;
    transform: translate(-50%, -50%);
    padding: 20px;
}

</style>
<body onload="init()">

    <header>
        <h2>Add New Book</h2>
        <div class="logo">
        <img src="img/imagesLogo.png" alt="Logo">
        </div>
    </header>
    <main>
        <form method ="post" id="add-product-form" enctype="multipart/form-data">
        
                    <label for="product-name"> Book Name:</label>
            <input type="text" id="Book_Name" name="book_name" placeholder="Enter Book Name">
            
            <label for="product-name">Book Genre:</label>
            <input type="text" id="Book_Genre" name="book_genre" placeholder="Enter Book Genre">
            
            
            <label for="product-name">Author Name:</label>
            <input type="text" id="Author_Name" name="author_name" placeholder="Enter Author Name">
            
            <label for="product-name">Publisher Name:</label>
            <input type="text" id="Publisher_Name" name="Publisher" placeholder="Enter Publisher Name">
            
            <label for="book-pages">Book Pages:</label>
            <input type="number" id="book-pages" name="book_pages" placeholder="Enter Book Pages Number" min='1'>


            <label for="product-price">Price:</label>
            <input type="text" id="product-price" name="product_price" placeholder="Enter product price">
            
            <label for="product-name">Book Quantity:</label>
            <input type="number" id="Book_Quantity" name="book_quantity" placeholder="Enter Book Quantity" min='1'>
            
            
            <label for="product-description">Description:</label>
            <textarea id="product-description" name="product_description" placeholder="Enter product description"></textarea>
               


            <label for="product-image">Image:</label>
            <input type="file" id="product-image" name="product_image">
            <button type="submit" name="submit">Add Product</button> 
            <button onclick="window.location.href='AdminHomePage.php'" type="button">Back to Admin Home Page</button>
            
 <?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_of_words";

$database = mysqli_connect($servername, $username, $password);

if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo ("Connected successfully");
}
                if (!mysqli_select_db($database, $dbname)) {
                    die("Error selecting database: " . mysqli_error($database));
                }
    $book_name = $_POST['book_name'];
    $book_genre = $_POST['book_genre'];
    $author_name = $_POST['author_name'];
    $publisher = $_POST['Publisher'];
    $product_pages = $_POST['book_pages'];
    $product_price = $_POST['product_price'];
    $book_quantity = $_POST['book_quantity'];
    $product_description = $_POST['product_description'];
    
        // File handling
$target_dir = "C:/xampp/htdocs/uploads/"; // Path to your image directory
$target_file = $target_dir . basename($_FILES["product_image"]["name"]);

if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
    // Image uploaded successfully
    echo "The file " . basename($_FILES["product_image"]["name"]) . " has been uploaded.";
    
    // Generate the URL for the uploaded image
    $image_url = "http://localhost/uploads/" . basename($_FILES["product_image"]["name"]);
    $query = "INSERT INTO product (Book_name, Book_genre, Author_name, Published, Pages, Price, Quantity, Product_description, Book_image) VALUES ('$book_name','$book_genre','$author_name','$publisher','$product_pages','$product_price','$book_quantity','$product_description','$image_url')";
     if (mysqli_query($database, $query)) {
                    echo "Book added successfully";
                } 
                else {
                    echo "Error adding book: " . mysqli_error($database);
                }
                                          }

mysqli_close($database);
}
?>

        </form>
        <div id="helpText"></div>
      </main>
</body> 
</html>