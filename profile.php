<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
                require "dbutil.php";
                $db = DbUtil::loginConnection();
                $stmt = $db->stmt_init();
                if($stmt->prepare("SELECT * FROM person WHERE username like ?") or die(mysqli_error($db))) {
                        $searchString = '%' . $_SESSION['username'] . '%';
                        $stmt->bind_param('s', $searchString);
                        $stmt->execute();
                        $stmt->bind_result($username, $name, $email, $password, $studentID, $advisorID);
                        while($stmt->fetch()) {
                                $_SESSION['email']=$email;
                                $_SESSION['name']=$name;
                                $_SESSION['studentID']=$studentID;
                                print($_SESSION['studentID']);
                                $_SESSION['advisorID']=$advisorID;
                        }
                 $stmt->close();
                }

                $db->close();
?>
<?php
    require('db.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con, $email);
        $student = stripslashes($_REQUEST['student']);
        $student = mysqli_real_escape_string($con, $student);
        $advisor = stripslashes($_REQUEST['advisor']);
        $advisor = mysqli_real_escape_string($con, $advisor);

        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        print($_SESSION['studentID']);
        if (strcmp($student, "student") == 0 && strlen($_SESSION['studentID']) < 10) {
            //INSERT IF NOT EXISTS
            $duplicate = true;
            while ($duplicate) {
                $studentID = generateRandomString();
                $queryCheck = "SELECT student_ID from `student` WHERE student_ID=$studentID";
                $resultCheck = mysqli_query($con, $queryCheck);
                if ($resultCheck->num_rows == 0 ) {
                    $duplicate = false;
                }
            }

            $query2 = "INSERT into `student` (student_ID, school_code, major, year)
                     VALUES ('$studentID', NULL, NULL, NULL)";
            $result2 = mysqli_query($con, $query2);
        }
        else {
            //DELETE
            $query = "DELETE FROM `student` WHERE studentID= $studentID;";
            $result = mysqli_query($con, $query);
            print($query);
            print($result);

        };

        if (strcmp($advisor, "advisor") == 0) {
           $duplicate2 = true;
            while ($duplicate2) {
                $advisorID = generateRandomString();
                $queryCheck2 = "SELECT AdvisorID from `advisor` WHERE AdvisorID=$AdvisorID";
                $resultCheck2 = mysqli_query($con, $queryCheck2);
                if ($resultCheck2->num_rows == 0 ) {
                    $duplicate2 = false;
                }
            }

            $query3 = "INSERT into `advisor` (AdvisorID, education_level)
            VALUES ('$advisorID', NULL)";
            $result3 = mysqli_query($con, $query3);
        }
        else {
            //DELETE
            $query2 = "DELETE FROM `advisor` WHERE advisorID= $advisorID;";
            $result2 = mysqli_query($con, $query2);
        };
    }
?>
<html>
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <title>AJAX Persons Example</title>
        <script>
        $(document).ready(function() {
                $( "#Schoolinput" ).change(function() {
                
                        $.ajax({
                                url: 'searchSchools2.php', 
                                data: {searchSchools: $( "#Schoolinput" ).val()},
                                success: function(data){
                                        $('#schooldrop').html(data);   
                                
                                }
                        });
                });
                
        });
        </script>
<body>
    <h1>User</h1>
    <p>Update your information</p>
    <form id=firstProfile>
        <label for='username'>Username:</label>
        <p><?php echo $_SESSION['username']; ?></p>

        <label for="email">Email:</label><br>
        <input type=text id="email" name="email" value="<?php echo $_SESSION['email']; ?>"><br><br>

        <p>I want to be a:</p>
        <input type="hidden" name="student" value="" />
        <div id="student">
            <?php
                    
                    if ($_SESSION['studentID'] != NULL) {
                        echo "<input type='checkbox' id='student' name='student' value='student' checked>";
                    }
                    else {
                        echo "<input type='checkbox' id='student' name='student' value='student'> ";
                    }       
            ?>
            <label for='student'> student</label><br>
        </div>
        <input type="hidden" name="advisor" value="" />
        <div>
            <?php
                    
                    if ($_SESSION['advisorID'] != NULL) {
                        echo "<input type='checkbox' id='advisor' name='advisor' value='advisor' checked>";
                    }
                    else {
                        echo "<input type='checkbox' id='advisor' name='advisor' value='advisor'>";
                    }       
            ?>
            <label for="advisor"> advisor</label><br>
        </div>
        
    </form>
    <!-- <input type="submit" name="submit" value="Register" class="login-button"> -->
    <button class=button type=submit form=firstProfile>next</button>
</body>

</html>