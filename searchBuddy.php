<?php
require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from student where year like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchYear'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($username, $school, $major, $year);
                echo "<table border=1><th>username</th><th>school</th><th>major</th><th>year</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$username</td><td>$school</td><td>$major</td><td>$year</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>