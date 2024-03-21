<?php
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

// Output opening div tag for books-contained
echo "<div class='books-container' id='books-contained'>\n";

// SQL query to fetch books
$sql = "SELECT Title, Genres, ImageLink, ISBN FROM book";
$result = $conn->query($sql);

// Check if any books were found
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='book'>\n";
        echo "<h2>" . $row["Title"] . "</h2>\n";
        echo "<p>Genres: " . $row["Genres"] . "</p>\n";
        echo "<img src='" . $row["ImageLink"] . "' alt='" . $row["Title"] . "' onclick='goToDescription(\"" . $row["ISBN"] . "\")'>\n";
        echo "</div>\n";
    }
} else {
    echo "No books found.";
}

// Output closing div tag for books-contained
echo "</div>\n";

// Close connection
$conn->close();
?>