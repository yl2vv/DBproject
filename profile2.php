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
                            $stmt->bind_result($advisorID, $education_level, $average_rating);
                            while($stmt->fetch()) {
                                    $_SESSION['education_level']=$education_level;
                            }
                    $stmt->close();
                    }

                    $stmt = $db->stmt_init();

                    if($stmt->prepare("SELECT * FROM alum_of WHERE advisorID like ?") or die(mysqli_error($db))) {
                        $searchString = '%' . $_SESSION['advisorID'] . '%';
                        $stmt->bind_param('s', $searchString);
                        $stmt->execute();
                        $stmt->bind_result($advisorID, $school_code3);
                        while($stmt->fetch()) {
                                $_SESSION['school_code3']=$school_code3;
                        }
                        $stmt->close();
                    }

                    $stmt = $db->stmt_init();

                    if($stmt->prepare("SELECT * FROM school WHERE school_code like ?") or die(mysqli_error($db))) {
                        $searchString = '%' . $_SESSION['school_code3'] . '%';
                        $stmt->bind_param('s', $searchString);
                        $stmt->execute();
                        $stmt->bind_result($school_code, $s_name, $city, $state);
                        while($stmt->fetch()) {
                                $_SESSION['s_name3']=$s_name;
                        }
                        $stmt->close();
                    }

                }

                $db->close();
?>
<?php
    $result = true;
    $result2 = true;
    $result3 = true;
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

            $clubList = stripslashes($_REQUEST['clubList']);
            $clubList = mysqli_real_escape_string($con, $clubList);
            $clubArray = explode (",", $clubList);

            foreach ($clubArray as $value) {
                $queryCheckClub = "SELECT * FROM `club` WHERE school_code='$schooldrop' AND c_name='$value';";
                $resultClub = mysqli_query($con, $queryCheckClub);
                if ($resultClub->num_rows < 1) {
                    $query = "INSERT into `club` (c_name, school_code, classification)
                     VALUES ('$value', '$schooldrop', '$value');";
                    $result5 = mysqli_query($con, $query);
                }
                $query = "INSERT into `student_in_club` (studentID, c_name, school_code)
                VALUES ('$studentID', '$value', '$schooldrop');";
                $result4 = mysqli_query($con, $query);
            }

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
            

            $Almadrop = stripslashes($_REQUEST['Almadrop']);
            $Almadrop = mysqli_real_escape_string($con, $Almadrop);
            
            $query4 = "INSERT into `alum_of` (advisorID, school_code)
            VALUES ('$advisorID', '$Almadrop');";
            $result4 = mysqli_query($con, $query4);

            $expertiseList = stripslashes($_REQUEST['expertiseList']);
            $expertiseList = mysqli_real_escape_string($con, $expertiseList);
            $expertiseArray = explode (",", $expertiseList);

            foreach ($expertiseArray as $value) {
                if (strlen($value) > 0) {
                        $query = "INSERT into `advisor_expertise` (advisorID, expertise)
                        VALUES ('$advisorID', '$value');";
                        $result4 = mysqli_query($con, $query);
                }
            }


        }

        if ($result && $result2 && $result3) {
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
<head>
    <meta charset="utf-8"/>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
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
        <script>
        $(document).ready(function() {
                $( "#almaInput" ).change(function() {
                
                        $.ajax({
                                url: 'searchSchools3.php', 
                                data: {searchSchools: $( "#almaInput" ).val()},
                                success: function(data){
                                        $('#Almadrop').html(data);   
                                
                                }
                        });
                });
                
        });
        </script>
<body>
    <form class="form" id=profile2 method="post">
        <h1>User</h1>
    <p class="subtext">Update your Information</p>
    <div>
            <?php
                    
                if ($_SESSION['studentID'] != NULL) {
                    $major=$_SESSION['major'];
                    $year=$_SESSION['year'];
                    $sname2=$_SESSION['s_name'];
                    $school_code2=$_SESSION['school_code'];

                    echo "
                        <form id=findSchool>
                        <label for='schooldrop'>School:</label><br>
                        <input id='Schoolinput' type='search' size='50' placeholder='School Name'/>
                        <button type=button form=findSchool>Search</button>
                        </form><br>
                        <select name='schooldrop' id='schooldrop'>
                        <option value='$school_code2'>$sname2</option>
                        </select><br><br><br>

                        <label for='major'>Major:</label><br>
                        <input type=text id='major' name='major' value=$major><br><br>
                        <label for='year'>Year:</label><br>
                        <input type=text id='year' name='year' value=$year><br><br>
                        <label for='clubList'> Clubs and Activities (separated by comma): </label><br>
                        <input type=text  id='clubList' name='clubList'></input><br><br><br>
                        ";
                }

                if ($_SESSION['advisorID'] != NULL) {
                    $education_level=$_SESSION['education_level'];
                    $sname3=$_SESSION['s_name3'];
                    $school_code3=$_SESSION['school_code3'];

                    echo "
                        <label for='education_level'>Education Level:</label><br>
                        <input type=text id='education_level' name='education_level' value=$education_level><br><br>

                        <form id=findAlma>
                        <label for='Almadrop'>Alum of:</label><br>
                        <input id='almaInput' type='search' size='50' placeholder='School Name'/>
                        <button type=button form=findAlma>Search</button>
                        </form>
                        <select name='Almadrop' id='Almadrop'>
                        <option value='$school_code3'>$sname3</option>
                        </select><br><br><br>
                        <label for='expertiseList'>Expertise (separated by comma): </label><br>
                        <input type=text  id='expertiseList' name='expertiseList'></input>   
                        ";
                }
            ?>
    </div>
        
    </form>
    <!-- <a href="./profile.php">
            <button>back</button>
    </a> -->
    <div class="buttonDiv">
    <button class="home-button" type="submit" form=profile2>Update</button>
    <a href="./home.php">
            <button class="home-button">Home</button>
    </a>
    </div>
</body>

</html>
