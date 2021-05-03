<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Home</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <p class="header">Welcome to HoosDown, <?php echo $_SESSION['username']; ?>!</p><p class="subheader">What would you like to do today?</p>
    <div class="buttongroup">
        <a class="homeA" href="./profile2.php">
            <button class="homebutton">Profile</button>
        </a>
        <a class="homeA" href="./findBuddy.php">
            <button class="homebutton">Browse Students</button>
        </a>
        <?php 
            if ($_SESSION['studentID'] != NULL) {
                echo "
                <a class='homeA' href='./connections.php'>
                    <button class='homebutton'>Selected Students</button>
                </a><br>
                ";
            }
        ?>
        <a class="homeA" href="./findAdvisor.php">
            <button class="homebutton">Browse Advisors</button>
        </a>
        <a class="homeA" href="./rateAdvisors.php">
            <button class="homebutton">Rate Advisors</button>
        </a>
        <a class="homeA" href="./browseActivities.php">
            <button class="homebutton">Browse Clubs and Activities</button>
        </a>
    </div>
</body>

</html>
