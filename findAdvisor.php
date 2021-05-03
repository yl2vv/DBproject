<html>
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <title>AJAX Find Buddy</title>
        <script>
        $(document).ready(function() {
                $( "#Nameinput" ).change(function() {
                        $.ajax({
                                url: 'searchAdvisor.php', 
                                data: {searchName: $( "#Nameinput" ).val()},
                                success: function(data){
                                        $('#NameResult').html(data); 
                                
                                }
                        });
                });
                
        });
        </script>
</head>
<body>
        <h3>Search in Advisor Table</h3>

        <input class="xlarge" id="Nameinput" name='Nameinput' type="search" size="30" placeholder="name"/>

        <div id="NameResult"></div>

        <a href="./home.php">
            <button>home</button>
        </a>


</body>

</html>