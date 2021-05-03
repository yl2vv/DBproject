<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
                require "dbutil.php";
                $db = DbUtil::loginConnection();

                if ($_SESSION['studentID'] != NULL) {
                    $stmt = $db->stmt_init();
                    // print($_SESSION['studentID']);

                    if($stmt->prepare("SELECT * FROM student WHERE studentID like ?") or die(mysqli_error($db))) {
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

                    $stmt = $db->stmt_init();

                    if($stmt->prepare("SELECT * FROM school WHERE school_code like ?") or die(mysqli_error($db))) {
                            $searchString = '%' . $_SESSION['school_code'] . '%';
                            $stmt->bind_param('s', $searchString);
                            $stmt->execute();
                            $stmt->bind_result($school_code, $s_name, $city, $state);
                            while($stmt->fetch()) {
                                    $_SESSION['s_name']=$s_name;
                            }
                    $stmt->close();

                }

                }

                if ($_SESSION['advisorID'] != NULL) {
                    $stmt = $db->stmt_init();

                    if($stmt->prepare("SELECT * FROM advisor WHERE advisorID like ?") or die(mysqli_error($db))) {
                            $searchString = '%' . $_SESSION['advisorID'] . '%';
                            $stmt->bind_param('s', $searchString);
                            $stmt->execute();
                            $stmt->bind_result($advisorID, $education_level);
                            while($stmt->fetch()) {
                                    $_SESSION['education_level']=$education_level;
                            }
                    $stmt->close();
                }

                }

                $db->close();
?>
<?php
    require('db.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_SESSION['studentID'] != NULL) {
            $schooldrop = stripslashes($_REQUEST['schooldrop']);
            $schooldrop = mysqli_real_escape_string($con, $schooldrop);
            $major = stripslashes($_REQUEST['major']);
            $major = mysqli_real_escape_string($con, $major);
            $year = stripslashes($_REQUEST['year']);
            $year = mysqli_real_escape_string($con, $year);
            $studentID = $_SESSION['studentID'];

            $query = "UPDATE `student` 
                     SET school_code='$schooldrop', major='$major', year='$year'
                     WHERE studentID='$studentID';";
            $result = mysqli_query($con, $query);
            // print($query);
            // print($result);
        }

        if ($_SESSION['advisorID'] != NULL) {
            $education_level = stripslashes($_REQUEST['education_level']);
            $education_level = mysqli_real_escape_string($con, $education_level);
            $advisorID = $_SESSION['advisorID'];

            $query2 = "UPDATE `advisor`
                     SET education_level='$education_level'
                     WHERE advisorID='$advisorID';";
            $result2 = mysqli_query($con, $query2);
            // print($query2);
            // print($result2);
        }

        if ($result && $result2) {
            echo "<p>Success</p>";
        ?>
            <script type="text/javascript">
            window.location.href = './home.php';
            </script>
        <?php
        }
        else {
            echo "<p>Please try again</p>";
        }

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
    <form id=profile2 method="post">
    <div>
            <?php
                    
                if ($_SESSION['studentID'] != NULL) {
                    $major=$_SESSION['major'];
                    $year=$_SESSION['year'];
                    $sname2=$_SESSION['s_name'];
                    $school_code2=$_SESSION['school_code'];
                    // print($_SESSION['major']);
                    echo "
                        <form id=findSchool>
                        <label for='schooldrop'>School:</label><br>
                        <input class='xlarge' id='Schoolinput' type='search' size='50' placeholder='School Name'/>
                        <button class=button form=findSchool>search</button>
                        </form>
                        <select name='schooldrop' id='schooldrop'>
                        <option value='$school_code2'>$sname2</option>
                        </select><br><br><br>

                        <label for='major'>Major:</label><br>
                        <input type=text id='major' name='major' value=$major><br><br>
                        <label for='year'>Year:</label><br>
                        <input type=text id='year' name='year' value=$year><br><br>
                        ";
                }

                if ($_SESSION['advisorID'] != NULL) {
                    $education_level=$_SESSION['education_level'];
                    echo "
                        <label for='education_level'>Education Level:</label><br>
                        <input type=text id='education_level' name='education_level' value=$education_level><br><br>
                        ";
                }
            ?>
    </div>
        
    </form>
    <a href="./profile.php">
            <button>back</button>
    </a>
    <button class=button type="submit" form=profile2>update</button>
    <a href="./home.php">
            <button>home</button>
    </a>
</body>

</html>