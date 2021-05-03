<?php
    session_start();
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $name    = stripslashes($_REQUEST['name']);
        $name    = mysqli_real_escape_string($con, $name);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $student = stripslashes($_REQUEST['student']);
        $student = mysqli_real_escape_string($con, $student);
        $advisor = stripslashes($_REQUEST['advisor']);
        $advisor = mysqli_real_escape_string($con, $advisor);

        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $result = true;
        $result2 = true;
        $result3 = true;
        $result4 = true;
        $result5 = true;

        if (strcmp($student, "student") == 0) {

            $duplicate = true;
            while ($duplicate) {
                $studentID = generateRandomString();
                $queryCheck = "SELECT studentID from `student` WHERE studentID=$studentID";
                $resultCheck = mysqli_query($con, $queryCheck);
                if ($resultCheck->num_rows == 0 ) {
                    $duplicate = false;
                }
            }

            $query2 = "INSERT into `student` (studentID, school_code, major, year)
                     VALUES ('$studentID', NULL, NULL, NULL);";
            $result2 = mysqli_query($con, $query2);
        }
        else {
            $studentID = NULL;
            $result2 = true;
        };

        if (strcmp($advisor, "advisor") == 0) {
            $duplicate2 = true;
            while ($duplicate2) {
                $advisorID = generateRandomString();
                $queryCheck2 = "SELECT AdvisorID from `advisor` WHERE AdvisorID=$AdvisorID";
                $resultCheck2 = mysqli_query($con, $queryCheck2);
                if ($resultCheck2->num_rows == 0 ) {
                    $duplicate2 = false;
                }
            }

            $query3 = "INSERT into `advisor` (AdvisorID, education_level)
            VALUES ('$advisorID', NULL);";
            $result3 = mysqli_query($con, $query3);

            $query4 = "INSERT into `alum_of` (advisorID, school_code)
            VALUES ('$advisorID', NULL);";
            $result4 = mysqli_query($con, $query4);
        }
        else {
            $advisorID = NULL;
            $result3 = true;
        };

        if ($advisorID == NULL && $studentID == NULL) {
            $query    = "INSERT into `person` (username, name, email, password, studentID, advisorID)
                     VALUES ('$username', '$name', '$email', '" . password_hash($password, PASSWORD_BCRYPT) . "', NULL, NULL);";
        }
        else if ($studentID == NULL) {
            $query    = "INSERT into `person` (username, name, email, password, studentID, advisorID)
            VALUES ('$username', '$name', '$email', '" . password_hash($password, PASSWORD_BCRYPT) . "', NULL, '$advisorID');";
        }
        else if ($advisorID == NULL) {
            $query    = "INSERT into `person` (username, name, email, password, studentID, advisorID)
            VALUES ('$username', '$name', '$email', '" . password_hash($password, PASSWORD_BCRYPT) . "', '$studentID', NULL);";
        }
        else {
            $query    = "INSERT into `person` (username, name, email, password, studentID, advisorID)
                     VALUES ('$username', '$name', '$email', '" . password_hash($password, PASSWORD_BCRYPT) . "', '$studentID', '$advisorID');";
        }
    
        $result   = mysqli_query($con, $query);
        if ($result && $result2 && $result3) {
            $_SESSION['username'] = $username;
            $_SESSION['studentID'] = $studentID;
            $_SESSION['advisorID'] = $advisorID;
            echo "<div class='form'>
            <h3>You are registered successfully.</h3><br/>
            <p class='link'>Click here to <a href='profile2.php'>Proceed to profile</a></p>
            </div>";
        } else {
            echo "<div class='form'>
                  <h3>User exists or there was an error.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="name" placeholder="Name" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress" required>
        <input type="password" class="login-input" name="password" placeholder="Password" required>

        <p>I want to be a:</p>
        <input type="hidden" name="student" value="" />
        <input type="checkbox" id="student" name="student" value="student"> 
        <label for="student"> student</label><br>
        <input type="hidden" name="advisor" value="" />
        <input type="checkbox" id="advisor" name="advisor" value="advisor">
        <label for="advisor"> advisor</label><br>
        
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>