<!DOCTYPE html>
<html lang='en'>

<head>
        <meta charset='UTF-8'>
    <title>Log In</title>
    <link rel='stylesheet' href='index.css'>
    <link rel="shortcut icon" href="houseOfWords.png" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;
        }

        body {
            background-color: #CFC5BB;
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            background: url("background.jpg") no-repeat;
            background-position: center;
            background-size: cover;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .logo img {
            width: 100px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .form-box {
            position: relative;
            width: 400px;
            height: 450px;
            background: transparent;
            border: none;
            border-radius: 20px;
            backdrop-filter: blur(15px) brightness(80%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h2 {
            font-size: 2em;
            color: #fff;
            text-align: center;
        }

        .inputbox {
            position: relative;
            margin: 30px 0;
            width: 310px;
            border-bottom: 2px solid #fff;
        }

        .inputbox label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: #fff;
            font-size: 1em;
            pointer-events: none;
            transition: 0.5s;
        }

        /* animations: start */
        input:focus~label,
        input:valid~label {
            top: -5px;
        }

        /* animation:end */
        .inputbox input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            padding: 0 35px 0 5px;
            color: #fff;
        }

        .inputbox ion-icon {
            position: absolute;
            right: 8px;
            color: #fff;
            font-size: 1.2em;
            top: 20px;
        }

        button {
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background-color:#A85658;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
        }
		
		 .button:hover {
    background-color: #a09d97;
  }

        .register {
            font-size: 0.9em;
            color: #fff;
            text-align: center;
            margin: 25px 0 10px;
        }

        .register p a {
            text-decoration: none;
            color: #fff;
            font-weight: 600;
        }

        .register p a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 480px) {
            .form-box {
                width: 100%;
                border-radius: 0px;
            }
        }
    </style>
</head>

<body>
<?php
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

// Validate password length
function validatePasswordLength($password)
{
    // Minimum password length
    return strlen($password) >= 8;
}

// Check authentication
function authenticate($conn, $email, $password)
{
    // Sanitize email input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Verify password
        if (password_verify($password, $row['password'])) {
            return $row; // Return user data if authentication successful
        }
    }
    return false; // Authentication failed
}

// Start session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['email'])) {
    // Redirect to AdminHomePage.php
    header("Location: AdminHomePage.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate password length
    if (!validatePasswordLength($password)) {
        $error = "Password must be at least 8 characters long!";
    } else {
        $user_data = authenticate($conn, $email, $password);
        if ($user_data) {
            // Authentication successful, store user data in session
            $_SESSION['email'] = $email;
            // Set cookie
            setcookie('user_id', $user_data['id'], time() + 1800, "/"); // Cookie valid for 30 minutes
            // Redirect to AdminHomePage.php
            header("Location: AdminHomePage.php");
            exit();
        } else {
            // Authentication failed, show error message
            $error = "Invalid email or password!";
            // Log authentication failure for debugging
            error_log("Authentication failed for email: $email", 3, "error.log");
        }
    }
}
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta charset="UTF-8">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="img/imagesLogo.png" alt="Logo">
        </div>
        <section>
            <div class="form-box">
                <div class="form-value">
                    <?php if (isset($_SESSION['email'])): ?>
                        <p>You are already logged in.</p>
                    <?php else: ?>
                        <form method="post" onsubmit="return validatePassword()">
                            <h2>Login</h2>
                            <div class="inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input type="email" name="email" required>
                                <label>Email</label>
                            </div>
                            <div class="inputbox">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                                <input type="password" id="password" name="password" required>
                                <label>Password</label>
                                <span id="password-error" style="color: red;"></span>
                            </div>
                            <button class="button" type="submit">Log in</button>
                        </form>
                        <?php if (isset($error)) {
                            echo "<p>$error</p>";
                        } ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</body>

</html>



<script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var errorSpan = document.getElementById("password-error");
            // Define your password criteria here
            var minLength = 8;
            var uppercaseRequired = true;
            var lowercaseRequired = true;
            var numberRequired = true;
            var specialCharRequired = true;
            var errorMessage = "";

            // Check length
            if (password.length < minLength) {
                errorMessage += "Password must be at least " + minLength + " characters long!<br>";
            }

            // Check for uppercase letter
            if (uppercaseRequired && !/[A-Z]/.test(password)) {
                errorMessage += "Password must contain at least one uppercase letter!<br>";
            }

            // Check for lowercase letter
            if (lowercaseRequired && !/[a-z]/.test(password)) {
                errorMessage += "Password must contain at least one lowercase letter!<br>";
            }

            // Check for number
            if (numberRequired && !/[0-9]/.test(password)) {
                errorMessage += "Password must contain at least one number!<br>";
            }

            // Check for special character
            if (specialCharRequired && !/[^A-Za-z0-9]/.test(password)) {
                errorMessage += "Password must contain at least one special character!<br>";
            }

            errorSpan.innerHTML = errorMessage; // Display error message
            return errorMessage === ""; // Return true if no errors
        }
    </script>
</body>

</html>



