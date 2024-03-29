<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LittleReads</title>
<link rel="stylesheet" href="littlereads-style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Protest+Strike&display=swap" rel="stylesheet">
</head>
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
<div class="welcome-message"> <h1> Make reading fun with LittleReads! </h1></div>
<div class="welcome-message-body">
<center><h2> LittleReads is an online reading community dedicated to helping kids find new and exciting books that are perfect for their age range, reading level, and personal tastes.
We believe that reading should be fun and safe, that's why we work with parents and kids to create a collaborative space where kids can come together to discover books they'll love.</h2></center>
<div class="welcome-prompt"><center><h2>Ready to join the fun? Sign up with the help of a parent below and create an account today! </h2></center></div>
</div>
<div class="btn-container">
  <button class="btn-1" onclick="openSignInPopup()">Sign in</button>
  <button class="btn-2" onclick="openSignUpPopup()">Sign up</button>
</div>

<div id="signin-popup" class="signin-popup-container popup-container" style="display:none;">
    <img src="images/UserIcon-Colour-Icons8.png" class="user-icon" alt="user log in icon">
    <h2> Welcome back! </h2>
    <p>Please enter your username and password below to log in to your LittleReads account.</p>
    <span class="close-btn" onclick="closePopup('signin-popup')">&times;</span>
    <label for="signin-username"><b>Username</b></label>
    <input type="text" id="signin-username" placeholder="Enter Username" name="username" required>
    <label for="signin-password"><b>Password</b></label>
    <input type="password" id="signin-password" placeholder="Enter Password" name="password" required>
    <button type="button" class="signin-btn" onclick="signIn()">Sign In</button>
    <button type="button" class="cancel-btn" onclick="closePopup('signin-popup')">Cancel</button>
</div>

<div id="signup-popup" class="signup-popup-container popup-container" style="display:none;">
    <h2> Welcome to LittleReads! </h2>
    <h3> Please enter your information below to create a LittleReads account. Parental approval required</h3>
    <span class="close-btn" onclick="closePopup('signup-popup')">&times;</span>
    <label for="email"><b>Parent/guardians email</b></label>
    <input type="text" id="signup-email" placeholder="Enter Email" name="email" required>
    <label for="signup-username"><b>Username</b></label>
    <input type="text" id="signup-username" placeholder="Enter Username" name="username" required>
    <label for="signup-password"><b>Password</b></label>
    <input type="password" id="signup-password" placeholder="Enter Password" name="password" required>
    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    <p>By creating an account, you agree to our <a href="#" style="color:dodgerblue">Terms &amp; Privacy</a>.</p>
    <div class="clearfix">
        <button type="button" class="signup-btn" onclick="signUp()">Sign Up</button>
        <button type="button" class="cancel-btn" onclick="closePopup('signup-popup')">Cancel</button>
    </div>
</div>

<!--images-->
 <img src="images/BeeIcon.png" class="bee-image" alt="Bee" />
 <img src="images/flower.png" class="flower-image" alt="Flower one">
 <img src="images/flower-two.png" class="flower-image two" alt="Flower two">
 <img src="images/flower-small.png" class="flower-image small" alt="Flower three">

<div id="messages">
    <!-- PHP messages will be displayed here -->
</div>

<script>
    function openSignInPopup() {
        document.getElementById('signin-popup').style.display = "block";
    }

    function openSignUpPopup() {
        document.getElementById('signup-popup').style.display = "block";
    }

    function closePopup(popupId) {
        document.getElementById(popupId).style.display = "none";
    }

    function signIn() {
        var username = document.getElementById('signin-username').value;
        var password = document.getElementById('signin-password').value;
        
        // Perform AJAX request to PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "littlereads-login.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('messages').innerHTML = xhr.responseText;
                // Close both popups if sign-in is successful
                if (xhr.responseText.indexOf("Welcome back") !== -1) {
                    closePopup('signin-popup');
                    closePopup('signup-popup');
                    updateMyShelf(username);
                }
            }
        };
        xhr.send("username=" + username + "&password=" + password + "&signin=1");
    }

    function signUp() {
        var email = document.getElementById('signup-email').value;
        var username = document.getElementById('signup-username').value;
        var password = document.getElementById('signup-password').value;
        
        // Perform AJAX request to PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "littlereads-login.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('messages').innerHTML = xhr.responseText;
                // Close both popups if sign-up is successful
                if (xhr.responseText.indexOf("Sign up successful") !== -1) {
                    closePopup('signin-popup');
                    closePopup('signup-popup');
                    updateMyShelf(username);
                }
            }
        };
        xhr.send("email=" + email + "&username=" + username + "&password=" + password + "&signup=1");
    }

    function updateMyShelf(username) {
        document.getElementById('my-shelf-btn').innerHTML = username + "'s Shelf";
    }
</script>

</body>
</html>
