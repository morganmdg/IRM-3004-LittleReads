<?php

/**
 * littlereads-search.php
 * This file handles user sign-up and sign-in functionality.
 *
 * @author Dominic Murphy
 * @version 1.0
 * @date March 22, 2024
 */

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

// Construct the SQL query based on the selected genres
$sql = "SELECT Title, Genres, ImageLink, ISBN FROM book WHERE 1=1";

// Handle potential casts properly
$genre1 = $_GET['genre1'] ?? '';
$genre2 = $_GET['genre2'] ?? '';
$genre3 = $_GET['genre3'] ?? '';

if (!empty($genre1)) {
    $sql .= " AND Genres LIKE '%" . $conn->real_escape_string($genre1) . "%'";
}

if (!empty($genre2)) {
    $sql .= " AND Genres LIKE '%" . $conn->real_escape_string($genre2) . "%'";
}

if (!empty($genre3)) {
    $sql .= " AND Genres LIKE '%" . $conn->real_escape_string($genre3) . "%'";
}

// Output opening div tag for books-contained
echo "<div class='books-container' id='books-contained'>\n";

$result = $conn->query($sql);

// Check if any books were found
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='book'>";
        echo "<h2>" . $row["Title"] . "</h2>";
        echo "<p>Genres: " . $row["Genres"] . "</p>";
        echo "<div class='image'>";
        echo "<img src='" . $row["ImageLink"] . "' alt='" .
        $row["Title"] . "' onclick='goToDescription(\"" . $row["ISBN"] . "\")'>";
        echo "</div>";
        echo "</div>";
    }
} else {
    // If no filters are selected, fetch all books
    $sql = "SELECT Title, Genres, ImageLink, ISBN FROM book";
    $result = $conn->query($sql);

    // Check if any books were found
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<div class='book'>";
            echo "<h2>" . $row["Title"] . "</h2>";
            echo "<p>Genres: " . $row["Genres"] . "</p>";
            echo "<img src='" . $row["ImageLink"] . "' alt='" .
            $row["Title"] . "' onclick='goToDescription(\"" . $row["ISBN"] . "\")'>";
            echo "</div>";
        }
    } else {
        echo "No books found.";
    }
}

// Output closing div tag for books-contained
echo "</div>\n";

// Close connection
$conn->close();
?>
