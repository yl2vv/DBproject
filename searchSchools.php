<?php
require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from school where s_name like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchSchools'] . '%';
                $stmt->bind_param('s', $searchString);
                $stmt->execute();
                $stmt->bind_result($school_code, $s_name, $city, $state);
                while($stmt->fetch()) {
                        echo "<a href='./club.php?schoolID=$school_code&schoolName=$s_name'>$s_name</a><br>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>