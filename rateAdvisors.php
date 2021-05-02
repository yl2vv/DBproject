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
        $query    = "INSERT into `advises` (username_s, username_a, advisor_rating, advising_comments)
                     VALUES ('$username', '$advisorUsername', '$rating', '$comment')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Thank you for your submission.</h3><br/>
                  <p class='link'><a href='home.php'>Return to Home</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='rateAdvisors.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
<?php
    }
?>
<html>
<body>
    <h1>User</h1>
    <p>Rate an advisor you met</p>
    <form id=login>
        <label for="advisorUsername">Advisor Username:</label><br>
        <input type=text id="advisorUsername" name="advisorUsername"><br>
        <label for="rating">Advisor Rating</label><br>
        <select id="rating" name="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br>
        <label for="comment">Comment</label><br>
        <textarea name="comment" rows="10" cols="30" maxlength='300'></textarea>
        
    </form>
    <button class=button form=login>submit</button>
</body>

</html>