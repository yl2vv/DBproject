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
                                $_SESSION['advisorID']=$advisorID;
                        }
                 $stmt->close();
                }
                if ($_SESSION['studentID'] != NULL) {
                    $stmt = $db->stmt_init();

                    if($stmt->prepare("SELECT * FROM student WHERE student_ID like ?") or die(mysqli_error($db))) {
                            $searchString = '%' . $_SESSION['studentID'] . '%';
                            $stmt->bind_param('s', $searchString);
                            $stmt->execute();
                            $stmt->bind_result($studentID, $school_code, $major, $year);
                            while($stmt->fetch()) {
                                    $_SESSION['school_code']=$school_code;
                                    $_SESSION['major']=$major;
                                    $_SESSION['year']=$year;
                            }
                    $stmt->close();
                }

                }

                if ($_SESSION['advisorID'] != NULL) {
                    $stmt = $db->stmt_init();

                    if($stmt->prepare("SELECT * FROM advisor WHERE AdvisorID like ?") or die(mysqli_error($db))) {
                            $searchString = '%' . $_SESSION['advisorID'] . '%';
                            $stmt->bind_param('s', $searchString);
                            $stmt->execute();
                            $stmt->bind_result($AdvisorID, $education_level);
                            while($stmt->fetch()) {
                                    $_SESSION['education_level']=$education_level;
                            }
                    $stmt->close();
                }

                }

                $db->close();
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
    <form id=login>
        <label for='username'>Username:</label>
        <p><?php echo $_SESSION['username']; ?></p>

        <label for="email">Email:</label><br>
        <input type=text id="email" name="email" value="<?php echo $_SESSION['email']; ?>"><br><br>

        <form id=findSchool>
        <label for="schooldrip">School:</label><br>
        <input class="xlarge" id="Schoolinput" type="search" size="50" placeholder="School Name"/>
        <button class=button form=findSchool>search</button>
        </form>
        <select name="schooldrop" id="schooldrop">
        </select><br><br><br>

        <label for="major">Major:</label><br>
        <input type=text id="major" name="major" value="<?php echo $_SESSION['major']; ?>"><br><br>
        <label for="email">Year:</label><br>
        <input type=text id="email" name="email" value="<?php echo $_SESSION['email']; ?>"><br><br>
        
    </form>
    <button class=button form=login>update</button>
</body>

</html>