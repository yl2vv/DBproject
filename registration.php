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

        if (strcmp($student, "student") == 0) {
            $studentID = generateRandomString();

            $query2 = "INSERT into `student` (student_ID, school_code, major, year)
                     VALUES ('$studentID', '', '', '')";
            $result2 = mysqli_query($con, $query2);
            print($query2);
            print($result2);
        }
        else {
            $studentID = NULL;
            $result2 = true;
        };
        if (strcmp($advisor, "advisor") == 0) {
            $advisorID = generateRandomString();

            $query3 = "INSERT into `advisor` (advisorID, education_level)
            VALUES ('$advisorID', '')";
            $result3 = mysqli_query($con, $query3);
            print($query3);
            print($result3);
        }
        else {
            $advisorID = NULL;
            $result3 = true;
        };


        $query    = "INSERT into `person` (username, name, email, password, studentID, advisorID)
                     VALUES ('$username', '$name', '$email', '" . password_hash($password, PASSWORD_BCRYPT) . "', '$studentID', '$advisorID')";
        $result   = mysqli_query($con, $query);

        if ($result && $result2 && $result3) {
            $_SESSION['username'] = $username;
            $_SESSION['studentID'] = $studentID;
            $_SESSION['advisorID'] = $advisorID;
            echo "<div class='form'>
            <h3>You are registered successfully.</h3><br/>
            <p class='link'>Click here to <a href='profile.php'>Proceed to profile</a></p>
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