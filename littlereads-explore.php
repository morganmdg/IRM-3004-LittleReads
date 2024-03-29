<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LittleReads - Explore</title>
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
<!-- Include jQuery library -->
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

<div class="explore-scrollbar">
<!--
<div class="explore-search">
<input type="text" class="explore-search-style" placeholder="Search the explore page...">
<button class="explore-search-btn">
    <i class="fas fa-search"></i>
</button>
</div>-->
<script>
	function dropdownFunction() {
		document.getElementById ("explore-filter-dropdown").classList.toggle("show-filter-dropdown-options");
	}
</script>
<div class="explore-filter">
<button onclick="dropdownFunction()" class="explore-filter-btn">Filter<i class="fas fa-chevron-down"></i></button>
<div id="explore-filter-dropdown" class="explore-filter-dropdown-style">

<a href="#" onclick="filterBooks('', '', '')">None</a>
<a href="#" onclick="filterBooks('adventure', '', '')">Adventure</a>
<a href="#" onclick="filterBooks('', 'animals', '')">Animals</a>
<a href="#" onclick="filterBooks('', '', 'Classics')">Classics</a>
<a href="#" onclick="filterBooks('', '', 'Education')">Education</a>
<a href="#" onclick="filterBooks('', '', 'Fantasy')">Fantasy</a>
<a href="#" onclick="filterBooks('', '', 'Fiction')">Fiction</a>
<a href="#" onclick="filterBooks('', '', 'Geography')">Geography</a>
<a href="#" onclick="filterBooks('', '', 'Graphic Novels')">Graphic Novels</a>
<a href="#" onclick="filterBooks('', '', 'Horror')">Horror</a>
<a href="#" onclick="filterBooks('', '', 'Memoirs')">Memoirs</a>
<a href="#" onclick="filterBooks('', '', 'Mystery')">Mystery</a>
<a href="#" onclick="filterBooks('', '', 'Nonfiction')">Nonfiction</a>
<a href="#" onclick="filterBooks('', '', 'Poetry')">Poetry</a>
<a href="#" onclick="filterBooks('', '', 'comedy')">Comedy</a>
</div>
</div>
</div>

<div class="books-container" id="books-contained">
</div>

<script>
    // When the page is fully loaded
    $(document).ready(function(){
        // Fetch and insert books from search.php into books-container
        $('#books-contained').load('search.php');
        
        // Fetch and insert username into My Shelf button
        $.get('getUsername.php', function(username) {
            $('#myShelfBtn').text('My Shelf ' + username);
        });
    });

    function goToDescription(isbn) {
        var url = 'littlereads-desciption.php?isbn=' + isbn;
        window.location.href = url;
    }


    function filterBooks(genre1, genre2, genre3) {
    $.ajax({
        type: "GET",
        url: "search.php",
        data: { genre1: genre1, genre2: genre2, genre3: genre3 },
        success: function(response) {
            $('#books-contained').html(response);
        },
        error: function() {
            alert('Error fetching books.');
        }
    });
}

</script>
</body>
</html>
