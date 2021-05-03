<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
        if(array_key_exists('removeStudent', $_POST)) {
                        $me = $_SESSION['studentID'];
                        $you = $_POST["removeStudent"];

                        require('db.php');
                        $query = "DELETE FROM `study_buddies` WHERE studentID_a='$me' AND studentID_b='$you';";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                            echo "student removed";
                        }
                
        }
?>
<html>
<body>
    <p>Displaying students you selected</p>
        <?php
                require "dbutil.php";
                $db = DbUtil::loginConnection();
                $stmt = $db->stmt_init();


                if($stmt->prepare("SELECT * FROM study_buddies S INNER JOIN person P ON S.studentID_b = P.studentID WHERE studentID_a LIKE ?") or die(mysqli_error($db))) {
                        $searchString = '%' . $_SESSION['studentID'] . '%';
                        $stmt->bind_param('s', $searchString);
                        $stmt->execute();
                        $stmt->bind_result($studentID_a, $studentID_b, $username, $name, $email, $password, $studentID, $advisorID);
                        echo "<table border=1><th>Username</th><th>Name</th><th>Email</th><th>Remove</th>\n";
                        while($stmt->fetch()) {

                                echo "<tr><td>$username</td><td>$name</td><td>$email</td><td><form method='post'><button type='submit' name='removeStudent' value=$studentID_b>select</button></form></td></tr>";
                        }
                        echo "</table>";

                        $stmt->close();
                }

                $db->close();
        ?>
    <div>
        <a href="./home.php">
            <button>Home</button>
        </a>
    </div>
</body>

</html>