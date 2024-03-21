<?php
// Start the session
session_start();

// Check if user_id is set in the session
if(isset($_SESSION['user_id'])) {
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

    // Output opening div tag for shelf-id
    echo "<div class='shelfbooks' id='shelf-id'>";

    // Fetch current user's shelved books
    $userID = $_SESSION['user_id']; // Assuming you have the user's ID stored in a session variable
    $sql = "SELECT Shelved FROM myshelf WHERE UserID = '$userID'";
    $result = mysqli_query($conn, $sql);

    // Check if there are shelved books for the user
    if (mysqli_num_rows($result) > 0) {
        // Fetch and display each unique shelved book
        $row = mysqli_fetch_assoc($result);
        $shelvedBooks = explode('-', $row['Shelved']);
        $shelvedBooks = array_unique($shelvedBooks); // Remove duplicates

        foreach ($shelvedBooks as $bookID) {
            // Fetch book information from the "book" table based on the book ID
            $bookInfo = fetchBookInfo($bookID, $conn);

            // Display book details
            echo '<div class="book">';
            echo '<img src="' . $bookInfo['ImageLink'] . '" alt="' . $bookInfo['Title'] . '">';

            // Add a remove button for each book
            echo '<form action="remove_book.php" method="post">';
            echo '<input type="hidden" name="bookID" value="' . $bookID . '">';
            echo '<button type="submit" class="remove-btn">Remove</button>';
            echo '</form>';

            echo '</div>';
        }
    } else {
        // No books shelved for the user
        echo '<p>No books shelved yet.</p>';
    }

    // Output closing div tag for shelf-id
    echo "</div>";

    // Close connection
    $conn->close();
} else {
    // Session user_id is not set, handle accordingly
    echo "User ID not set in session.";
}

// Function to fetch book information from the "book" table based on book ID
function fetchBookInfo($bookID, $conn) {
    $sql = "SELECT * FROM book WHERE BookID = '$bookID'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}
?>
