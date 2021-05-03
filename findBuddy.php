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
                                searchEmail: $( "#Emailinput" ).val(), searchMajor: $( "#Majorinput" ).val()},
                                success: function(data){
                                        $('#yearResult').html(data); 
                                
                                }
                        });
                });
                
                
        });
        </script>
</head>
<body>
        <h3>Search in Students Table</h3>
        <form id="ajaxBuddy" name="ajaxBuddy">
        <input class="xlarge" id="Usernameinput" name='Usernameinput' type="search" size="30" placeholder="Username"/>
        <input class="xlarge" id="Nameinput" name='Nameinput' type="search" size="30" placeholder="Name"/>
        <input class="xlarge" id="Schoolinput" name='Schoolinput' type="search" size="30" placeholder="School"/>
        <input class="xlarge" id="Majorinput" name='Majorinput' type="search" size="30" placeholder="Major"/>
        <input class="xlarge" id="Yearinput" name='Yearinput' type="search" size="30" placeholder="Year"/>
        <input class="xlarge" id="Emailinput" name='Emailinput' type="search" size="30" placeholder="Email"/>
        </form>


        <div id="yearResult"></div>

        <a href="./home.php">
            <button>home</button>
        </a>
</body>

</html>