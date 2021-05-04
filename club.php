<html>
<head>
    <meta charset="utf-8"/>
    <title>Club Details</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <p>Displaying clubs and activities for <?php echo $_GET['schoolName'];?></p>
        <?php
                require "dbutil.php";
                $db = DbUtil::loginConnection();
                $stmt = $db->stmt_init();

                if($stmt->prepare("SELECT * FROM club WHERE school_code like ?") or die(mysqli_error($db))) {
                        $searchString = '%' . $_GET['schoolID'] . '%';
                        $stmt->bind_param('s', $searchString);
                        $stmt->execute();
                        $stmt->bind_result($c_name, $school_code, $classification);
                        echo "<div class='buddyResult1'><table border=1><th>Club / Activity</th><th>Classification</th>\n";
                        while($stmt->fetch()) {
                                echo "<tr><td>$c_name</td><td>$classification</td></tr>";
                        }
                        echo "</table></div>";


                        $stmt->close();
                }

                $db->close();
        ?>
    <div>
        <a class="homeA" href="./browseActivities.php">
            <button class="home-button">Back</button>
        </a>
        <a href="./home.php">
            <button class="home-button">Home</button>
        </a>
    </div>
</body>

</html>
