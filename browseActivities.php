<html>
<head>
    <meta charset="utf-8"/>
    <title>Browse Activities</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <title>AJAX Persons Example</title>
        <script>
        $(document).ready(function() {
                $( "#Schoolinput" ).change(function() {
                
                        $.ajax({
                                url: 'searchSchools.php', 
                                data: {searchSchools: $( "#Schoolinput" ).val()},
                                success: function(data){
                                        $('#Schoolresult').html(data);   
                                
                                }
                        });
                });
                
        });
        </script>
</head>
<body>
<form class="form" id="searchClub">
        <h3>Browse clubs and activities in a school</h3>

        <input class="xlarge" id="Schoolinput" type="search" size="50" placeholder="School Name"/>
        <button type=button form='searchClub'>search</button>

        <div id="Schoolresult"></div>

        <br>

</form>
<a href="./home.php">
            <button>home</button>
        </a>
</body>
</html>
