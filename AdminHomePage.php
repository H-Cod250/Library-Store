<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="houseOfWords.png" type="image/x-icon">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Homepage</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-size: cover;
    background-position: center;
	background-color: #CFC5BB;
  }
  .container {
    max-width: 900px;
    text-align: center;
    padding: 20px;
    background-color:#CFC5BB;
    border-radius: 10px;
	margin-top:-200px;

  }
  .article {
    text-align: center;
    margin-bottom: 20px;
	color: white;
  }
  .button {
    display: inline-block;
    padding: 20px 40px;
    font-size: 18px;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    margin: 10px;
	background-color: #A85658;
    transition: background-color 0.3s ease;
	
  }
  .button:hover {
    background-color: #a09d97;
  }
  .logo img {
    width: 100px;
    margin-bottom: 200px;	
    display: inline-block;
}

</style>

</head>

<body>
  <div class="container">
        <div class="logo">
           <img src="img/imagesLogo.png" alt="Logo">
        </div>
<div class="container">
  <div class="article">
    <h1>Admin Homepage</h1>
  </div>
  <div class="buttons">
    <a href="add_book.php"><button class="button">Add Books</button></a>
     <a href="delete_page.php"><button class="button">Delete Books</button></a>
    <a href="edit_page.php"> <button class="button">Edit Books</button></a>
	<a href="homepage.php"> <button class="button">Store Page</button></a>
  </div>
</div>

     
</body>
</html>
