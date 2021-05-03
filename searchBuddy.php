<?php
session_start();
require "db.php";
        // $db = DbUtil::loginConnection();
        // $stmt = $db->stmt_init();
        $format = "select * from person NATURAL JOIN student NATURAL JOIN school  WHERE username LIKE '%s' AND name LIKE '%s' AND s_name LIKE '%s' AND major LIKE '%s' AND year LIKE '%s' AND email LIKE '%s' ORDER BY name ASC LIMIT 20";
        $user_search = '%' . $_GET['searchUser'] . '%';
        $name_search = '%' . $_GET['searchName'] . '%';
        $school_search = '%' . $_GET['searchSchool'] . '%';
        $year_search = '%' . $_GET['searchYear'] . '%';
        $email_search = '%' . $_GET['searchEmail'] . '%';
        $major_search = '%' . $_GET['searchMajor'] . '%';

        $query = sprintf($format, $user_search, $name_search, $school_search, $major_search, $year_search, $email_search);
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        // while($row = mysqli_fetch_row($result))
        // {
                // echo print_r($row);
echo "<table border=1><th>username</th><th>name</th><th>school</th><th>major</th><th>year</th><th>email</th>\n";
 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $username = $row['username'];
 $name   = $row['name'];
 $school = $row['s_name'];
 $year = $row['year'];
 $email = $row['email'];
 $major = $row['major'];
 echo "<tr><td>$username</td><td>$name</td><td>$school</td><td>$major</td><td>$year</td><td>$email</td></tr>";
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