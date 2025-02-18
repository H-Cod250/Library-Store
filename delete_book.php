<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_of_words";

// Create connection
$database = mysqli_connect($servername, $username, $password);
// Check connection
if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully<br>";
}
// Select database
if (!mysqli_select_db($database, $dbname)) {
    die("Error selecting database: " . mysqli_error($database));
}

// Check if book ID is set in URL parameters
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Escape user inputs for security
    $book_id = mysqli_real_escape_string($database, $_GET['id']);

    // SQL to delete a record
    $query = "DELETE FROM product WHERE book_id = $book_id";

    if (mysqli_query($database, $query)) {
        echo "Book deleted successfully";
		echo"</br><a href='AdminHomePage.php'>go back to admin homepage</a>";
    } else {
        echo "Error deleting book: " . mysqli_error($database);
    }
} else {
    echo "Invalid book ID";
}

// Close connection
mysqli_close($database);
?>



