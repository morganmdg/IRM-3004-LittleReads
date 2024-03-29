<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LittleReads - Description</title>
<link rel="stylesheet" href="YJ-littlereads.css">
<link rel="stylesheet" href="littlereads-style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Protest+Strike&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>
<header class="toolbar">
<div class="leftnav">
<h1><img src="images/BookIcon-Icons8.png" class="book-icon" alt="LittleReads Book Logo"> LittleReads</h1>
</div>
<div class="midnav">
<a href="profilepage.php" class="shelf-btn">My Shelf</a>
</div>
<div class="rightnav">
<nav>
<ul>
<!--link-->
<li><a href="littlereads-homepage.php">Home</a></li>
<li><a href="littlereads-explore.php">Explore</a></li>
<li><a href="littlereads-contactpage.php">Contact</a></li>
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
<!-- Button for Add to Shelf -->
<button class="description-shelf-btn" onclick="addToShelf()">Add to shelf&nbsp;&nbsp;&nbsp;<i class="fa fa-plus-square"></i></button>
<div class="description-display-block" id="display-block">
</div>
<div id="messages">
    <!-- PHP messages will be displayed here -->
</div>
<script>
    // When the page is fully loaded
    $(document).ready(function(){
        // Fetch and insert books from show-description.php into books-container
        $('#display-block').load('show-description.php');
    });
    
    // Function to add book to shelf
    function addToShelf() {
        $.ajax({
            url: 'show-description.php',
            type: 'POST',
            data: { add_to_shelf: true }, // Send flag to indicate adding to shelf
            success: function(response) {
                // Handle success response
                $('#messages').html(response); // Display any messages from PHP
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    }
</script>

</body>
</html>
