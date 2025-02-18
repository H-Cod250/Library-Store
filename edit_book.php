<?php

session_start();

$image_id = isset($_GET['image_id']) ? intval($_GET['image_id']) : 0;
$row = [];

$db_link = mysqli_connect("localhost:3306", "root", "");
if (!$db_link) {
    die("Could not connect: " . mysqli_connect_error());
}
if (!mysqli_select_db($db_link, "house_of_words")) {
    die("could not select database:" . mysqli_error($database));
}

$BookQuery = "SELECT * FROM product WHERE Book_id =" . $image_id;

if (mysqli_query($db_link, $BookQuery)) {
    $result = mysqli_query($db_link, $BookQuery);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error updating record: " . mysqli_error($db_link);
    }
}

mysqli_close($db_link);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_link = mysqli_connect("localhost:3306", "root", "");
    if (!$db_link) {
        die("Could not connect: " . mysqli_connect_error());
    }
    if (!mysqli_select_db($db_link, "house_of_words")) {
        die("could not select database:" . mysqli_error($database));
    }

    if (isset($_POST['update'])) {
          $bookName =  $_POST['Book_Name'];
        $bookGenre =  $_POST['Book_Genre'];
        $authorName = $_POST['Author_Name'];
        $published =  $_POST['Published'];
        $productDescription =  $_POST['product_description'];
        $bookID = $_POST['Book_ID'];
        $productPrice =  $_POST['product_price'];
        $bookQuantity =  $_POST['Book_Quantity'];
        $productImage = strval($_POST['product_image']);
        $modifiedImage = "img" . "/" . $productImage;

         $productImage = isset($_POST['product_image']) ? $_POST['product_image'] : '';

        if (!empty($productImage)) {
            $modifiedImage = "img" . "/" . $productImage;
            $fieldsToUpdate[] = "Book_Image = '$modifiedImage'";
        }

        $updateQuery = "UPDATE product SET ";

        $fieldsToUpdate = [];
        if (!empty($bookName)) $fieldsToUpdate[] = "Book_name = '$bookName'";
        if (!empty($bookGenre)) $fieldsToUpdate[] = "Book_genre = '$bookGenre'";
        if (!empty($authorName)) $fieldsToUpdate[] = "Author_name = '$authorName'";
        if (!empty($published)) $fieldsToUpdate[] = "Published = '$published'";
        if (!empty($productDescription)) $fieldsToUpdate[] = "Product_description = '$productDescription'";
        if (!empty($productPrice)) $fieldsToUpdate[] = "Price = '$productPrice'";
        if (!empty($bookQuantity)) $fieldsToUpdate[] = "Quantity = '$bookQuantity'";

        if (!empty($modifiedImage)) $fieldsToUpdate[] = "Book_Image = '$modifiedImage'";


        $updateQuery .= implode(", ", $fieldsToUpdate);

        $updateQuery .= " WHERE Book_id = $image_id ";

        if (mysqli_query($db_link, $updateQuery)) {
            echo "Record updated successfully.";

            // Redirect to edit_page.php after updating
            header("Location: edit_page.php?image_id=$image_id");
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($db_link);
        }
    }

    mysqli_close($db_link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
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

#edit-product-form {
    display: flex;
    flex-wrap: wrap;
    width: 500px;
    margin: 0 auto;
}

#edit-product-form label {
    width: 120px;
    margin-bottom: 5px;
}

#edit-product-form input,
#edit-product-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
}

#edit-product-form button {
    background-color: #a85658;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}

#edit-product-form button:hover {
    background-color: #F5F1E8;
}

.logo img{
    position:relative;
    top:0;
    left:15px;
    width:80px;
    height:80px;
}
</style>
<body>
    <header>
        <h2>Edit Book</h2>
        <div class="logo">
            <img src="img/imagesLogo.png">
        </div>
    </header>
    <main>
        <form id="edit-product-form" method="post">
           
            <label for="Book_Name">Book Name:</label>
            <input type="text" id="Book_Name" name="Book_Name" value="<?php echo isset($row['Book_name']) ? $row['Book_name'] : ''; ?>" placeholder="Book Name">
            
            <label for="Book_Genre">Book Genre:</label>
            <input type="text" id="Book_Genre" name="Book_Genre" value="<?php echo isset($row['Book_genre']) ? $row['Book_genre'] : ''; ?>" placeholder="Book Genre">
            
            <label for="Author_Name">Author Name:</label>
            <input type="text" id="Author_Name" name="Author_Name" value="<?php echo isset($row['Author_name']) ? $row['Author_name'] : ''; ?>" placeholder="Author Name">
            
            <label for="Published">Published:</label>
            <input type="text" id="Published" name="Published" value="<?php echo isset($row['Published']) ? $row['Published'] : ''; ?>" placeholder="Published">
            
            <label for="product_description">Description:</label>
            <textarea id="product_description" name="product_description" placeholder="Product description"><?php echo isset($row['Product_description']) ? $row['Product_description'] : ''; ?></textarea>
            
            <label for="Book_ID">Book ID:</label>
            <input type="number" id="Book_ID" name="Book_ID" value="<?php echo isset($row['Book_id']) ? $row['Book_id'] : ''; ?>" placeholder="Book ID" readonly>
            
            <label for="product_price">Price:</label>
            <input type="number" id="product_price" name="product_price" value="<?php echo isset($row['Price']) ? $row['Price'] : ''; ?>" placeholder="Product price">
            
            <label for="Book_Quantity">Book Quantity:</label>
            <input type="number" id="Book_Quantity" name="Book_Quantity" value="<?php echo isset($row['Quantity']) ? $row['Quantity'] : ''; ?>" placeholder="Book Quantity">

           <label for="preview_image">Preview Image:</label>
            <div>
                <?php if (isset($row['Book_Image']) && !empty($row['Book_Image'])): ?>
                    <img src="<?php echo $row['Book_Image']; ?>" alt="Current Image" style="max-width: 300px; max-height: 300px;">
                    <br>
                    <input type="text" id="preview_image" name="preview_image" value="<?php echo $row['Book_Image']; ?>" readonly>
                <?php else: ?>
                    <span>No image available</span>
                <?php endif; ?>
            </div>
			
            <input type="text" id="preview_image" name="preview_image" value="<?php echo isset($row['Book_Image']) ? $row['Book_Image'] : ''; ?>">
            <label for="product_image">Upload New Image:</label>
            <input type="file" id="product_image" name="product_image">
            <button type="submit" name="update">Update Product</button>
			
        </form>
    </main>
</body>
</html>
