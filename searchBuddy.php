<?php
require "dbutil.php";
        $db = DbUtil::loginConnection();
        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from person NATURAL JOIN student NATURAL JOIN school  WHERE year like ? ORDER BY name ASC LIMIT 20") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchYear'] . '%';
                $stmt->bind_param('s', $searchString);
                $stmt->execute();
                $stmt->bind_result($school_code, $studentID, $username, $name, $email, $password,
                 $advisorID, $major, $year, $s_name, $city, $state);
                echo "<table border=1><th>username</th><th>name</th><th>school</th><th>major</th><th>year</th><th>email</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$username</td><td>$name</td><td>$s_name</td><td>$major</td><td>$year</td><td>$email</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>