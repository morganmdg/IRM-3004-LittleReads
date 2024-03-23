<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    public function testSignUp() {
        // Create a new instance of mysqli (mocked)
        $mysqliMock = $this->getMockBuilder(mysqli::class)
                           ->disableOriginalConstructor()
                           ->getMock();

        // Stub the query method to return a specific result
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->willReturn(new stdClass());

        // Replace the actual database connection with the mocked instance
        global $conn;
        $conn = $mysqliMock;

        // Simulate a POST request with signup data
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['signup'] = true;
        $_POST['username'] = 'testuser';
        $_POST['password'] = 'testpassword';

        // Include the PHP file to test
        include 'littlereads-login.php';

        // Perform assertions based on the expected output
        $this->expectOutputString('Sign up successful! Welcome, testuser!');
    }

    // Add more test methods as needed
}
