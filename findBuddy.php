<?php
include("auth_session.php");
?>
<?php
        if(array_key_exists('connectStudents', $_POST)) {
                if ($_SESSION['studentID'] == NULL) {
                        echo "You are not a student";
                }
                else {
                        $me = $_SESSION['studentID'];
                        $you = $_POST["connectStudents"];
                        print("hello heheheehe");
                        print($you);

                        require('db.php');
                        $query = "INSERT into `study_buddies` (studentID_a, studentID_b)
                         VALUES ('$me', '$you');";
                        $result = mysqli_query($con, $query);

                }
                
        }
?>
<html>
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <title>AJAX Find Student</title>
        <script>
        $(document).ready(function() {
                $( "#ajaxBuddy" ).change(function() {
                        $.ajax({
                                url: 'searchBuddy.php', 
                                data: {searchYear: $( "#Yearinput" ).val(), searchSchool: $ ( "#Schoolinput" ).val(),
                                searchUser: $( "#Usernameinput" ).val(), searchName: $( "#Nameinput" ).val(),
                                searchEmail: $( "#Emailinput" ).val(), searchMajor: $( "#Majorinput" ).val(), searchClub: $( "#Clubinput" ).val()},
                                success: function(data){
                                        $('#yearResult').html(data); 
                                
                                }
                        });
                });
                
                
        });
        </script>
            <meta charset="utf-8"/>
    <title>Find Buddy</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<form class="form">
        <h3 class="subtext">Find Buddies Based on Common Interests!</h3>
        <form id="ajaxBuddy" name="ajaxBuddy">
        <div class="row">
        <div class="column">
        <label class="text" for="advisorUsername">Username:</label>
        </div>
        <div class="column">
                <input class="xlarge" id="Usernameinput" name='Usernameinput' type="search" size="30"/>
                </div>
        <div class="column">
        <label class="text" for="advisorUsername">Name:</label>
        </div>
        <div class="column">
        <input class="xlarge" id="Nameinput" name='Nameinput' type="search" size="30"/>
        </div>
                <div class="column">
        <label class="text" for="advisorUsername">School:</label>
        </div>
                <div class="column">
        <input class="xlarge" id="Schoolinput" name='Schoolinput' type="search" size="30"/>
        </div>
                <div class="column">
        <label class="text" for="advisorUsername">Major:</label>
        </div>
                <div class="column">
        <input class="xlarge" id="Majorinput" name='Majorinput' type="search" size="30"/>
        </div>
                <div class="column">
        <label class="text" for="advisorUsername">Year:</label>
        </div>
                <div class="column">
        <input class="xlarge" id="Yearinput" name='Yearinput' type="search" size="30"/>
        </div>
                <div class="column">
        <label class="text" for="advisorUsername">Email:</label>
        </div>
                <div class="column">
        <input class="xlarge" id="Emailinput" name='Emailinput' type="search" size="30"/>
        </div>
                <div class="column">
        <label class="text" for="advisorUsername">Club:</label>
        </div>
                <div class="column">
        <input class="xlarge" id="Clubinput" name='Clubinput' type="search" size="30"/>
        </div>
        </form>
	</div>
	</div>

        <div id="yearResult"></div>

        <a href="./home.php">
            <button>home</button>
        </a>
</body>

</html>
