<?php
session_start();
require "db.php";
        $format = "SELECT * FROM `person` NATURAL JOIN `advisor` WHERE username LIKE '%s' AND name LIKE '%s' AND education_level LIKE '%s' AND average_rating >= %d AND email LIKE '%s' ORDER BY name ASC";
        $user_search = '%' . $_GET['searchUser'] . '%';
        $name_search = '%' . $_GET['searchName'] . '%';
        $email_search = '%' . $_GET['searchEmail'] . '%';
        $education_search = '%' . $_GET['searchEducation'] . '%';
        $rating_search = $_GET['searchRating'];
        $alum_search = '%' . $_GET['searchAlum'] . '%';
        $expertise_search = '/' . $_GET['searchExpertise'] . '/i';

        $query = sprintf($format, $user_search, $name_search, $education_search, $rating_search, $email_search);
        
        if($education_search == "%%" ){
            $location = strpos($query, "AND education_level LIKE");
            $query1 = substr($query, 0, $location);
            $loc2 = strpos($query, "AND average_rating >=");
            $query2 = substr($query, -(strlen($query) - $loc2));
            $query = $query1.$query2;
        }
        if($rating_search <= 0){
            $location = strpos($query, "AND average_rating >=");
            $query1 = substr($query, 0, $location);
            $loc2 = strpos($query, "AND email LIKE");
            $query2 = substr($query, -(strlen($query) - $loc2));
            $query = $query1.$query2;

        }
        // echo $query."<br>";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));

        echo "<table border=1><th>username</th><th>name</th><th>education level</th><th>average rating</th><th>email</th><th>alum of</th><th>expertise</th>\n";

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
             $username = $row['username'];
             $name   = $row['name'];
             $email = $row['email'];
             $education = $row['education_level'];
             $rating = $row['average_rating'];
        
             
        // $expertisequery = "SELECT GROUP_CONCAT(expertise) FROM `advisor_expertise` WHERE advisorID = '".$row['advisorID']."'";
        // $expertiseResult = mysqli_query($con, $expertisequery) or die(mysqli_error($con));
        // $areas = mysqli_fetch_array($expertiseResult, MYSQLI_ASSOC);
        // $commaexpertise = "";
        // foreach($areas as &$area){
        //     $commaexpertise.= $area.", ";
        // }
        // $commaexpertise = substr($commaexpertise, 0, -2);
             $commaexpertise = "";
        // echo $commaexpertise."<br>";
        if (preg_match($expertise_search, $commaexpertise) == 0){
            continue;
        }

        $alum_of = "";

        echo "<tr><td>$username</td><td>$name</td><td>$education</td><td>$rating</td><td>$email</td><td>$alum_of</td><td>$commaexpertise</td></tr>";
    }

        //$alumquery = "SELECT GROUP_CONCAT(s_name) FROM `alum_of` NATURAL JOIN `school` WHERE school_code = '".$row['studentID']."'";
        //$clubresult =  mysqli_query($con, $clubquery) or die(mysqli_error($con));


        echo "</table>";
        // $db = DbUtil::loginConnection();
        // $stmt = $db->stmt_init();

        // if($stmt->prepare("select * from person NATURAL JOIN advisor WHERE name like ? ORDER BY name ASC LIMIT 20") or die(mysqli_error($db))) {
        //         $searchString = '%' . $_GET['searchName'] . '%';
        //         $stmt->bind_param('s', $searchString);
        //         $stmt->execute();
        //         $stmt->bind_result($advisorID, $username, $name, $email, $password,
        //          $studentID, $education_level, $average_rating);
        //         echo "<table border=1><th>username</th><th>name</th><th>education_level</th><th>average_rating</th><th>email</th>\n";
        //         while($stmt->fetch()) {
        //                 echo "<tr><td>$username</td><td>$name</td><td>$education_level</td><td>$average_rating</td><td>$email</td></tr>";
        //         }
        //         echo "</table>";

        //         $stmt->close();
        // }

        // $db->close();


?>