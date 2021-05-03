<html>
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <title>AJAX Find an Advisor</title>
        <script>
        $(document).ready(function() {
                $( "#ajaxAdvisor" ).change(function() {
                        $.ajax({
                                url: 'searchAdvisor.php', 
                                data: {searchName: $( "#Nameinput" ).val(), searchUser: $( "#Usernameinput" ).val(), searchEducation: $( "#Educationinput" ).val(), searchRating: $( "#Ratinginput" ).val(), searchEmail: $( "#Emailinput" ).val(), searchAlum: $( "#Aluminput" ).val(), searchExpertise: $( "#Expertiseinput" ).val()},
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
        <form id ="ajaxAdvisor" name = "ajaxAdvisor">
        <input class="xlarge" id="Usernameinput" name='Usernameinput' type="search" size="30" placeholder="Username"/>
        <input class="xlarge" id="Nameinput" name='Nameinput' type="search" size="30" placeholder="name"/>
        <input class="xlarge" id="Educationinput" name='Educationinput' type="search" size="30" placeholder="Education Level"/>
        <input class="xlarge" id="Ratinginput" name='Ratinginput' type="number" placeholder="Minimum Rating"/>
        <input class="xlarge" id="Emailinput" name='Emailinput' type="search" size="30" placeholder="Email"/>
        <input class="xlarge" id="Aluminput" name='Aluminput' type="search" size="30" placeholder="Alumni of..."/>
        <input class="xlarge" id="Expertiseinput" name='Expertiseinput' type="search" size="30" placeholder="Areas of Expertise"/>
        </form>
        <div id="NameResult"></div>

        <a href="./home.php">
            <button>home</button>
        </a>


</body>

</html>