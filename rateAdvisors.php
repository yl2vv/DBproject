<?php
    include("auth_session.php");
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['advisorUsername'])) {
        // removes backslashes
        $advisorUsername = stripslashes($_REQUEST['advisorUsername']);
        //escapes special characters in a string
        $advisorUsername = mysqli_real_escape_string($con, $advisorUsername);
        $rating    = stripslashes($_REQUEST['rating']);
        $rating    = mysqli_real_escape_string($con, $rating);
        $comment    = stripslashes($_REQUEST['comment']);
        $comment    = mysqli_real_escape_string($con, $comment);
        $username = $_SESSION['username'];

        print($advisorUsername);

        $query    = "INSERT into `advises` (studentID, advisorID, advisor_rating, advising_comments)
                     VALUES ('$username', '$advisorUsername', '$rating', '$comment')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Thank you for your submission.</h3><br/>
                  <p class='link'><a href='home.php'>Return to Home</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Error, try again.</h3><br/>
                  <p class='link'>Click here to <a href='rateAdvisors.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
<?php
    }
?>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Rate Advisors</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <form class="form" id=login>
    	<h1 class="header">User</h1>
    	<p class="subtext">Rate an Advisor You Met</p>
    	<div class="row">
    		<div class="column">
        <label class="text" for="advisorUsername">Advisor Username:</label><br>
        </div>
        <div class="column">
        <input class="select" type=text id="advisorUsername" name="advisorUsername"><br>
        </div>
        </div>
        <br>
        <div class="column">
        <label class="text" for="rating">Advisor Rating:</label><br>
        </div>
        <div class="column">
        <select class="select" id="rating" name="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        </div>
        <br>
        <br>
        <div class="column">
        <label class="text" for="comment">Comment:</label><br>
        </div>
        <div class="column">
        <textarea class="textarea" name="comment" rows="10" cols="30" maxlength='300'></textarea>   
        </div>
        <button class=login-button form=login>Submit</button>
    </form>

</body>

</html>
