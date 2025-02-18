<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
	<meta charset="UTF-8">
	 <link rel = "stylesheet" href="css\homepage_style 2.css" type = "text/css" />
	<style>
*{
	margin: 0px;
	padding: 0px;
	box-sizing: border-box;
	font-family: "Arial", sans-serif;
}
.navigationBar {overflow: hidden; background: transparent; border: none; border-radius: 20px; backdrop-filter: blur(15px) brightness(80%); }
.navigationBar a {float: left; display: block; color: #fff; text-align: center; padding: 14px 16px; text-decoration: none; font-size: 17px;}
.navigationBar a:hover {background-color: #ddd; color: black;}
.navigationBar input[type=text] {float: right; padding: 6px; border: none; margin-top: 8px; margin-right: 16px; font-size: 17px;}
.navigationBar img {float: left; width: 100px; height: 50px; display: inline-block;}
header {
	background-color: #ac9b91; 
	color:#fff;
	padding: 20px 60px;
	display: flex;
	justify-content: space-between;
	align-items: center;
	position: sticky;
	top:0;
	z-index: 100;
}
.logo{
	font-size: 32px;
	font-weight: bold;
	text-transform: uppercase;
}
.logo img{
	position:absolute;
	top:0;
	left:15;
	width:80px;
	height:80px;
}

nav{
	display: flex;
	align-items: center;
}


nav ul{
	display: flex;
	align-items: center;
	justify-content: center;
}

nav ul li{
	margin-left: 25px;
	list-style: none;
}

nav ul li{
	margin-left: 25px;
	list-style: none;
}
nav ul li a{
	color: #fff;
	text-decoration: none;
	font-size: 19px;
	font-weight: bold;
	transition: 0.4s ease;
}
.active:hover{
	background-color:#ddd;
	color: black;
}
nav ul: hover{
	background-color:#ddd;
	color: black;
}
nav ul li a: hover{
	color: #666;
	background-color:#ddd;
	color: black;
}

.search{
	position: relative;
}

.search input{
	
	padding: 10px;
	border: none;
	border-radius: 20px;
	background-color: #444;
	color:#fff;
}

.search button{
	position: absolute;
	top:0;
	right:0;
	padding: 10px;
	border:none;
	border-radius: 20px;
	background-color: #fff;
	color: #444;
	font-weight: bold;
	cursor: pointer;
}

.store{
	background-color: #CFC5BB; 
	padding: 70px 60px;
	display: flex;
	align-items: center;
	flex-direction: column;
	text-align: center;
}
.store h1{
	font-size: 48px;
	color: #444;
}

.store p{
	font-size: 24px;
	color:#A85658;
	margin-bottom: 30px;
}
.store #list-label{
	font-size: 24px;
	color:#A85658;
	margin-bottom: 30px;
}
.store #footer{
	position:relative;
	top:15px;
	font-size: 24px;
	color:#A85658;
	margin-bottom: 30px;
	
}
.store #footer a{
	color:#A85658;
}
.store #footer a:hover{
	font-size: 24px;
	background-color:#f5f1e8;
	margin-bottom: 30px;
	
}

.main-content {
	background-color: #f5f1e8;
	padding: 40px;
	border-radius: 10px;
	box-shadow: 0px 0px 10px rgba(0, 0,0,0.2);
}
.main-content h2{
	color:#A85658;
}
.books{
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	grid-gap: 40px;
	margin-top: 40px;
}
.book{
	display: flex;
	flex-direction: column;
	align-items: center;
	text-align: center;
	color: #000000 ;
}

.book img{
	max-width: 100%;
	margin-bottom: 10px;
	width: 250px;
	height: 400px ;
}
.book h3{
	font-size: 24px;
	margin-top: 0px;
}
.book p{
	margin-top: 5px;
	 color: #666;
}

.btn{
	display: inline-block;
	padding: 12px 30px;
	background-color: #333;
	color:#fff;
	text-decoration: none; 
	border-radius: 5px;
	transition: 0.4s ease;
}

.btn: hover{
background-color: #555;
}

footer{
	background-color: #262626;
	color:#fff;
	padding: 20px;
	text-align: center;
}
	</style>
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
		<nav>
			<ul>
			<li><a class="active" href="AdminHomePage.php">Login</a></li>
			<li><a class="active" href="account.php">Account</a></li>
			</ul>
		</nav>
		
	</header>

	<div class="store">
		<div class="store-content">
			
		</div>

		<div class="main-content">
			<h2>Edit books</h2>
			<div class="books">
				<?php
					while($row = mysqli_fetch_assoc($resault)){
						echo
						"<div class=\"book\">
							<a href=edit_book.php?image_id=". $row["Book_id"]."\">
								<img src=". $row["Book_Image"].">
							</a>
							<h3>". $row["Book_name"]."</h3>
							<p>". $row["Author_name"]."</p>
							</div>";
					}
				?>
			</div>
		</div>

		<label id="footer">To Contact Us <a href="contact.php">Click Here</a></label>

	</div>
	
</body>

</html>