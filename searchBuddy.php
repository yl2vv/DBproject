<?php
session_start();
require "db.php";
        // $db = DbUtil::loginConnection();
        // $stmt = $db->stmt_init();
        $format = "select * from person NATURAL JOIN student NATURAL JOIN school  WHERE username LIKE '%s' AND name LIKE '%s' AND s_name LIKE '%s' AND major LIKE '%s' AND year LIKE '%s' AND email LIKE '%s' ORDER BY name ASC";
        $user_search = '%' . $_GET['searchUser'] . '%';
        $name_search = '%' . $_GET['searchName'] . '%';
        $school_search = '%' . $_GET['searchSchool'] . '%';
        $year_search = '%' . $_GET['searchYear'] . '%';
        $email_search = '%' . $_GET['searchEmail'] . '%';
        $major_search = '%' . $_GET['searchMajor'] . '%';
        $club_search = '/' . $_GET['searchClub'] . '/i';

        $query = sprintf($format, $user_search, $name_search, $school_search, $major_search, $year_search, $email_search);
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        // while($row = mysqli_fetch_row($result))
        // {
                // echo print_r($row);
echo "<table border=1><th>username</th><th>name</th><th>school</th><th>major</th><th>year</th><th>email</th><th>clubs</th><th>select student</th>\n";
 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $username = $row['username'];
 $IDofStudent = $row['studentID'];
 $name   = $row['name'];
 $school = $row['s_name'];
 $year = $row['year'];
 $email = $row['email'];
 $major = $row['major'];
 $clubquery = "SELECT GROUP_CONCAT(c_name) FROM `student_in_club` WHERE studentID = '".$row['studentID']."'";
 $clubresult =  mysqli_query($con, $clubquery) or die(mysqli_error($con));
$clubs = mysqli_fetch_array($clubresult, MYSQLI_ASSOC);
$commaclubs = "";
foreach($clubs as &$club){
        $commaclubs.= $club . ", ";
}
$commaclubs = substr($commaclubs, 0, -2);

if (preg_match($club_search, $commaclubs) == 0){
        continue;
}

 echo "<tr><td>$username</td><td>$name</td><td>$school</td><td>$major</td><td>$year</td><td>$email</td><td>$commaclubs</td><td><form method='post'><button type='submit' name='connectStudents' value=$IDofStudent>select</button></form></td></tr>";
 }
 echo "</table>";
        // }
        // if($stmt->prepare("select * from person NATURAL JOIN student NATURAL JOIN school  WHERE year like ? ORDER BY name ASC LIMIT 20") or die(mysqli_error($db))) {
        //         $searchString = '%' . $_GET['searchYear'] . '%';
        //         $schoolstring = '%' . $_GET['schoolname'] . '%';
        //         print($schoolstring);
        //         $stmt->bind_param('s', $searchString);
        //         $stmt->execute();
        //         $stmt->bind_result($school_code, $studentID, $username, $name, $email, $password,
        //          $advisorID, $major, $year, $s_name, $city, $state);
        //         echo "<table border=1><th>username</th><th>name</th><th>school</th><th>major</th><th>year</th><th>email</th>\n";
        //         while($stmt->fetch()) {
        //                 echo "<tr><td>$username</td><td>$name</td><td>$s_name</td><td>$major</td><td>$year</td><td>$email</td></tr>";
        //         }
        //         echo "</table>";

        //         $stmt->close();
        // }

        // $db->close();


?>