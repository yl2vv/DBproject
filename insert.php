<?php
    session_start();
    require('db.php');
    if (($h = fopen("personinput.csv", "r")) !== FALSE)
  	{
  		// fgetcsv($h, 1000, ",");

  		while (($data = fgetcsv($h, 1000, ",")) !== FALSE)
      {
        // echo $data;
        $hash = substr($data[3],1);

        if ($data[4] == "NULL" and $data[5] == "NULL")
        {
          $query    = "BEGIN 
          					IF NOT EXISTS(SELECT * FROM `person` WHERE username = '$data[0]')
          					BEGIN
          						INSERT INTO `person` VALUES ('$data[0]', '$data[1]', '$data[2]', '$hash',NULL, NULL)
          					END 
          				END ";
      // $result = mysqli_query($con, $query) or die(mysqli_error($con));
        }
        elseif ($data[4] == "NULL")
        {
          $query = "BEGIN 
          					IF NOT EXISTS(SELECT * FROM `person` WHERE username = '$data[0]')
          					BEGIN
          						INSERT INTO `person` VALUES ('$data[0]', '$data[1]', '$data[2]', '$hash',NULL, '$data[5]')
          					END 
          				END ";
      // $result = mysqli_query($con, $query) or die(mysqli_error($con));
        }
        elseif ($data[5] == "NULL")
        {
          $query = "BEGIN 
          					IF NOT EXISTS(SELECT * FROM `person` WHERE username = '$data[0]')
          					BEGIN
          						INSERT INTO `person` VALUES ('$data[0]', '$data[1]', '$data[2]', '$hash','$data[4]', NULL)
          					END 
          				END ";
      // $result = mysqli_query($con, $query) or die(mysqli_error($con));
        }
        else
        {
          $query = "BEGIN 
          					IF NOT EXISTS(SELECT * FROM `person` WHERE username = '$data[0]')
          					BEGIN
          						INSERT INTO `person` VALUES ('$data[0]', '$data[1]', '$data[2]', '$hash','$data[4]', '$data[5]')
          					END 
          				END ";
      // $result = mysqli_query($con, $query) or die(mysqli_error($con));
        }
        echo $query;
        echo "<br>";
      // $query    = "INSERT INTO `person` VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]',)";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));
    }
		echo "done with everything <br>";
  		fclose($h);
  	}

    echo "<div class='header'>
                  <h3>adding a bunch of stuff here.</h3><br/>
                  <p>test text</p>
                  </div>";
 ?>
