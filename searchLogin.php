<?php
require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from login") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchUser'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($email, $password);
                echo "<table border=1><th>email</th><th>password</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$email</td><td>$password</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>
