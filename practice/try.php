<html>
<head>
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <title>AJAX Persons Example</title>
        <script>
        $(document).ready(function() {
                $( "#LastNinput" ).change(function() {
                
                        $.ajax({
                                url: 'searchSailorName.php', 
                                data: {searchLastName: $( "#LastNinput" ).val()},
                                success: function(data){
                                        $('#LastNresult').html(data);   
                                
                                }
                        });
                });
                
        });
        </script>
</head>
<body>
        <h3>Search substring of sname in Sailors Table</h3>

        <input class="xlarge" id="LastNinput" type="search" size="30" placeholder="Sailor's Name Contains"/>

        <div id="LastNresult">Search Result</div>


</body>
</html>
