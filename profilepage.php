<?php
// Start PHP session if not already started
session_start();

// Check if "user_id" is set and not null
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) {
    // Include shelf.php only if "user_id" is set
    include 'shelf.php';
} else {
    // Handle case where "user_id" is not set or null
    echo "User ID is not set in the session.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LittleReads</title>
<link rel="stylesheet" href="littlereads-style.css">
<link rel="stylesheet" href="profilepage-style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Protest+Strike&display=swap" rel="stylesheet">
</head>
<header class="toolbar">
<div class="leftnav">
<h1><img src="images/BookIcon-Icons8.png" class="book-icon" alt="LittleReads Book Logo"> LittleReads</h1>
</div>
<div class="midnav">
<a href="littlereads-profilepage.php" class="shelf-btn">My Shelf</a>
</div>
<div class="rightnav">
<nav>
<ul>
<li><a href="littlereads-homepage.html">Home</a></li>
<li><a href="littlereads-explore.html">Explore</a></li>
<li><a href="littlereads-contactpage.html">Contact</a></li>
<li class="dropdown">
<button class="dropdown-btn"><img src="images/MenuIcon-Icons8.png" class="menu-icon" alt="Drop down menu icon"></button>
<div class="dropdown-menu">
<a href="#">About</a> 
<a href="#">Challenges</a>
<a href="#">Resources</a>
</div>
</li>
</ul>
</nav>
</div>
</header>
<body>
<!--profile container-->
<div class="container">
<div class="profile-box">
<div class="profile-picture">
<img src="images/UserIcon-Colour-Icons8.png" alt="Profile Picture">
</div>
<div class="profile-info">
<h2>Username</h2> <!--input username from database-->
<p>Age: 7</p> <!--input age from database-->
<p>Reading Level: Reading Wiz</p> <!--input reading level from database-->
<p>Reading Goal: 5/10</p> <!--input reading goal from database-->
</div>
</div>
<!--myshelf container-->
<div class="shelfbooks">
    <!-- Shelf content will be included here -->
</div>
</div>
</body>
</html>