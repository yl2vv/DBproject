<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<html>
<body>
    <h1>User</h1>
    <p>Update your information</p>
    <form id=login>
        <label for='username'>Username:</label>
        <p><?php echo $_SESSION['username']; ?></p>
        <label for="email">Email:</label><br>
        <input type=text id="email" name="email" value="<?php echo $_SESSION['email']; ?>"><br>
        
    </form>
    <button class=button form=login formaction="home.php">update</button>
</body>

</html>