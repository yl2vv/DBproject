<?php
require "dbutil.php";
        $db = DbUtil::loginConnection();
        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from person NATURAL JOIN advisor WHERE name like ? ORDER BY name ASC LIMIT 20") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchName'] . '%';
                $stmt->bind_param('s', $searchString);
                $stmt->execute();
                $stmt->bind_result($advisorID, $username, $name, $email, $password,
                 $studentID, $education_level, $average_rating);
                echo "<table border=1><th>username</th><th>name</th><th>education_level</th><th>average_rating</th><th>email</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$username</td><td>$name</td><td>$education_level</td><td>$average_rating</td><td>$email</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>