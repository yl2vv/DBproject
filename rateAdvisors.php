<?php
    include("auth_session.php");
?>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Rate Advisors</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="rateBody">
        <form class="form" id=login>
            <h1 class="header">Rater</h1>
            <p class="subtext">Rate an Advisor You Met</p>
            <?php
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

                // $getStudentID = "SELECT studentID FROM `person` WHERE username='$username';";
                // print($getStudentID);
                
                require "dbutil.php";
                $db = DbUtil::loginConnection();

                $stmt = $db->stmt_init();

                if($stmt->prepare("SELECT studentID FROM `person` WHERE username='$username';") or die(mysqli_error($db))) {
                        $stmt->execute();
                        $stmt->bind_result($studentID);
                        while($stmt->fetch()) {
                            $studentID=$studentID;
                        }

                        $stmt->close();
                }

                $db->close();

                $db = DbUtil::loginConnection();

                $stmt = $db->stmt_init();

                if($stmt->prepare("SELECT advisorID FROM `person` WHERE username='$advisorUsername';") or die(mysqli_error($db))) {
                        $stmt->execute();
                        $stmt->bind_result($advisorID);
                        $count=0;
                        while($stmt->fetch()) {
                            $advisorID=$advisorID;
                            $count++;
                                
                        }

                        $stmt->close();
                }

                $db->close();
                if ($count == 0) {
                    echo "<div style='text-align:center;margin-bottom:10px;color:red'>Advisor does not exist.</div>";
                }
                else {
                    $rating = intval($rating);
                    $query    = "INSERT into `advises` (studentID, advisorID, advisor_rating, advising_comments)
                            VALUES ('$studentID', '$advisorID', $rating, '$comment')";
                    $result   = mysqli_query($con, $query);

                    if ($result) {
                        echo "<div style='text-align:center;margin-bottom:10px'>Thank you for your submission.</div>";
                    } else {
                        echo "<div style='text-align:center;margin-bottom:10px;color:red'>Error please try again.</div>";
                    }

                }
            }
    ?>
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
        <div class="buttonDiv">
            <a href="./home.php"><button class=home-button >Home</button></a>
        </div>
    </div>

</body>

</html>
