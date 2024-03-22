<?php

/**
 * littlereads-search.php
 * This file handles user sign-up and sign-in functionality.
 *
 * @author Dominic Murphy
 * @version 1.0
 * @date March 22, 2024
 */

// Database connection setup
$servername = "localhost";
$username = "pma";
$password = "";
$dbname = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Construct the SQL query based on the selected genres
$sql = "SELECT Title, Genres, ImageLink, ISBN FROM book WHERE 1=1";

if (isset($_GET['genre1']) && !empty($_GET['genre1'])) {
    $genre1 = $_GET['genre1'];
    $sql .= " AND Genres LIKE ?";
}

if (isset($_GET['genre2']) && !empty($_GET['genre2'])) {
    $genre2 = $_GET['genre2'];
    $sql .= " AND Genres LIKE ?";
}

if (isset($_GET['genre3']) && !empty($_GET['genre3'])) {
    $genre3 = $_GET['genre3'];
    $sql .= " AND Genres LIKE ?";
}

$stmt = $conn->prepare($sql);

// Bind parameters
if (isset($genre1)) $stmt->bindParam(1, $genre1);
if (isset($genre2)) $stmt->bindParam(2, $genre2);
if (isset($genre3)) $stmt->bindParam(3, $genre3);

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output opening div tag for books-contained
echo "<div class='books-container' id='books-contained'>\n";

// Check if any books were found
if ($result) {
    // Output data of each row
    foreach ($result as $row) {
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
    echo "No books found.";
}

// Output closing div tag for books-contained
echo "</div>\n";

// Close connection
$conn = null;

?>
