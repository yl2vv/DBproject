<html>
<head>
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
	<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
 	<title>login</title>
	<script>
	$(document).ready(function() {
		$( "#email", "#password" ).change(function() {
		
			$.ajax({
				url: 'searchLogin.php', 
				data: {searchUser: $( "#email", "#password" ).val()},
				success: function(data){
					$('#passwordResult').html(data);	
				
				}
			});
		});
		
	});
	</script>
</head>
<body>
    <h1>Login</h1>
    <p>this is for logging in</p>
    <form id=login>
        <label for="email">Username:</label><br>
        <input type=text id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type=text id="password" name="password"><br>
    </form>
    <!-- <button class=button form=login formaction="home.php">submit</button> -->
	<button class=button form=login>submit</button>
</body>

</html>