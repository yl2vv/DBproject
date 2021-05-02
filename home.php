<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<html>
<body>
    <p>Welcome to hoosdown2study, <?php echo $_SESSION['username']; ?>! What would you like to do today?</p>
    <div>
        <a href="./user.php">
            <button>Profile</button>
        </a>
        <a href="./findBuddy.php">
            <button>Find a Buddy</button>
        </a>
        <a href="./findAdvisor.php">
            <button>Find an advisor</button>
        </a>
    </div>
</body>

</html>