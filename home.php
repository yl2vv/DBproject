<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<html>
<body>
    <p>Welcome to hoosdown2study, <?php echo $_SESSION['username']; ?>! What would you like to do today?</p>
    <div>
        <a href="./profile2.php">
            <button>Profile</button>
        </a>
        <a href="./findBuddy.php">
            <button>Browse Students</button>
        </a>
        <a href="./findAdvisor.php">
            <button>Browse Advisors</button>
        </a>
        <a href="./rateAdvisors.php">
            <button>Rate Advisors</button>
        </a>
        <a href="./browseActivities.php">
            <button>Browse Clubs and Activities</button>
        </a>
    </div>
</body>

</html>