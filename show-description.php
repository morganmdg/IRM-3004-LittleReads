<!-- littlereads-description.php -->
<?php
// Description Page PHP
if(isset($_GET['isbn'])) {
    // Database connection
    $servername = "localhost";
    $username = "pma";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape ISBN to prevent SQL injection
    $isbn = $conn->real_escape_string($_GET['isbn']);

    // SQL query to fetch book information
    $sql = "SELECT Title, Author, Genres, Language, ISBN FROM book WHERE ISBN = '$isbn'";
    $result = $conn->query($sql);

    // Check if the book with the provided ISBN exists
    if ($result->num_rows > 0) {
        // Fetch book information
        $book = $result->fetch_assoc();
    } else {
        // If no book found, redirect to explore page or show a message
        header("Location: explore.php");
        exit();
    }

    // Close connection
    $conn->close();
} else {
    // If no ISBN provided, redirect to explore page or show a message
    header("Location: explore.php");
    exit();
}
?>

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
<body>
<header class="toolbar">
    <!-- Header and other elements remain the same -->
</header>

<div class="description-display-block">
    <h3>Title: <?php echo $book['Title']; ?></h3>
    <h3>Author: <?php echo $book['Author']; ?></h3>
    <h3>Genres: <?php echo $book['Genres']; ?></h3>
    <h3>ISBN: <?php echo $book['ISBN']; ?></h3>
    <h3>Language: <?php echo $book['Language']; ?></h3>

    <!-- Buttons for Share, Reviews, and Add to Shelf -->
</div>

<!-- JavaScript and other elements remain the same -->
</body>
</html>
