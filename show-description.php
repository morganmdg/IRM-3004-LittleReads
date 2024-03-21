<?php
        echo "error 0";

// Description Page PHP
if(isset($_GET['isbn'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
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
        // Extract information from the $book array
        $title = $book['Title'];
        $author = $book['Author'];
        $genres = $book['Genres'];
        $language = $book['Language'];
        $isbn = $book['ISBN'];

        // Display the book information within the desired div
        echo "<div class='description-display-block' id='display-block'>";

        echo "<h1>Title: $title</h1>";
        echo "<p>Author: $author</p>";
        echo "<p>Genres: $genres</p>";
        echo "<p>Language: $language</p>";
        echo "<p>ISBN: $isbn</p>";
        echo "</div>";
    } else {
        // If no book found, redirect to explore page or show a message
        header("Location: littlereads-explore.html");

        echo "error 1";

        exit();
    }

    // Close connection
    $conn->close();
} else {
    // If no ISBN provided, redirect to explore page or show a message
    echo "error 2";

    header("Location: littlereads-explore.html");
    exit();
}
