<html>
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <title>AJAX Find Buddy</title>
        <script>
        $(document).ready(function() {
                $( "#Yearinput" ).change(function() {
                
                        $.ajax({
                                url: 'searchBuddy.php', 
                                data: {searchYear: $( "#Yearinput" ).val()},
                                success: function(data){
                                        $('#yearResult').html(data);   
                                
                                }
                        });
                });
                
        });
        </script>
</head>
<body>
        <h3>Search substring of name in Buddy Table</h3>

        <input class="xlarge" id="Yearinput" type="search" size="30" placeholder="Year"/>

        <div id="yearResult">Search Result</div>


</body>

</html>