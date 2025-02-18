<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Info</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

header {
    background-color: #ac9b91; 
    color: #fff;
    padding: 20px;
    text-align: center;
}

main {
    padding: 20px;
}

section {
    margin-bottom: 20px;
}

h2 {
    color: #ac9b91; 
}

p {
    color: #666;
}

button {
    padding: 10px 20px;
    background-color: #A85658; 
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

button:hover {
    background-color: #a09d97; 
}

footer {
    background-color: #ac9b91; 
    color: #fff;
    padding: 20px;
    text-align: center;
}

    </style>
</head>
<body>
    <header>
        <h1>Account Information</h1>
    </header>

    <main>
        <section>
            <h2>User Info:</h2>
         <?php
session_start(); // Start or resume the session

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_of_words";

// Establish database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['logout'])){
	session_unset();     // Unset all session variables
    session_destroy();   // Destroy the session
	header("Location: homepage.php");
	exit;
}elseif(isset($_POST['back'])){
	header("Location: homepage.php");
	exit;
}
// Check if another admin has signed in
if(isset($_SESSION['email']) && isset($_POST['email']) && $_SESSION['email'] != $_POST['email']) {
    // Destroy the existing session
    session_unset();     // Unset all session variables
    session_destroy();   // Destroy the session
}

// Retrieve user information using session email or newly signed in admin's email
$email = $_SESSION['email'] ?? ($_POST['email'] ?? null);
if ($email) {
    $sql = "SELECT FName, LName, email FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "<p><strong>First Name:</strong> " . $row["FName"] . "</p>";
        echo "<p><strong>Last Name:</strong> " . $row["LName"] . "</p>";
        echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
    } else {
        echo "User not found";
    }
} else {
    echo "Email not provided";
}

// Close connection
mysqli_close($conn);
?>


        </section>

        <section>
    <form method='post'><button class="button" onclick="logout()" name='logout'>Log Out</button>
    <button class="button" onclick="goBack()" name='back'>Back</button></form>
        </section>
    </main>

    <footer>
        <p>2024 HouseOfWords</p>
    </footer>

    <script>
        function logout() {
            // Redirect to logout page or perform logout action
            alert("Logged out successfully!");
            window.location.href = "homepage.php"; // Redirect to logout page
        }

        function goBack() {
            // Go back to previous page
            window.history.back();
        }
    </script>
</body>
</html>
