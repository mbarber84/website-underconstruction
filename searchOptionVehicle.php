<!DOCTYPE php>
<html>
<head>
    <link rel = "stylesheet" href = "stylesCustomer.css">
    <title> Harveys of Stretton Customer Data</title>

</head>

<body>
    <header>
        <img src="HOSImages/HOS logo-1 (2).jpg" alt = "Company logo"><a href="HOSindex.html"><button class = "homebtn" type="button">Home Page</button></a></p>
    </header>
    <?php

    
    //chech php is running
    echo "php is running, quick catch it!<br/><br/><br/> ";

    //create connection variables
    $servername = "wa-svr-sqlexp";
    $username = "091053";
    $password = "091053";
    $db = "db_091053";

    //creating the connection
    $connection = mysqli_connect($servername, $username, $password, $db);


    //check the connection
    if(!$connection) {
        die("Connection Failed: ".mysqli_connect_error());
    }



    //create quert to insert data into table
    if (isset($_GET['Search'])) {
      $filtervalues = $_GET['Search'];
      $query = "SELECT vehicleID, vehicleStyle, vehicleMake, vehicleModel, vehicleRegistration, year, transmission, engineSize, vehicleMilage, colour, price, notes FROM tblvehicle WHERE CONCAT( vehicleID, vehicleStyle, vehicleMake, vehicleModel, vehicleRegistration, year, transmission, engineSize, vehicleMilage, colour, price, notes) LIKE '%$filtervalues%'";
      $query = mysqli_query($connection, $query);
  
      ?>
    <main>
      <h1>Welcome to the Harveys of Stretton</h1>

      <div class="testbox">
        <form action="" method="post" name="inputCustomer">
          <div class="banner">
            <h3>Vehicle Details Search Results</h3>
          </div>
          <?php



      if (mysqli_num_rows($query) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($query)) {

      ?>
      <div class="item">
        <p>Vehicle ID</p>
        <div class="name-item">
          <input type="text" name="vehicleID" placeholder="<?php echo "Vehicle ID Number: " . $row["vehicleID"] ?>" required></input>
        </div>
      </div>
      <?php

      ?>

      <div class="item">
        <p>Vehicle details</p>
        <div class="name-item">
          <input type="text" name="vehicleStyle" placeholder="<?php echo  $row["vehicleStyle"] ?>"></input>
          <input type="text" name="vehicleMake" placeholder="<?php echo  $row["vehicleMake"] ?>"></input>
          <input type="text" name="vehicleModel" placeholder="<?php echo  $row["vehicleModel"] ?>"></input>
          <input type="text" name="vehicleRegistration" placeholder="<?php echo  $row["vehicleRegistration"] ?>"></input>
          <input type="text" name="year" placeholder="<?php echo  $row["year"] ?>"></input>
          <input type="text" name="transmission" placeholder="<?php echo  $row["transmission"] ?>"></input>
          <input type="text" name="engineSize" placeholder="<?php echo  $row["engineSize"] ?>"></input>
          <input type="text" name="vehicleMilage" placeholder="<?php echo  $row["vehicleMilage"] ?>"></input>
          <input type="text" name="colour" placeholder="<?php echo  $row["colour"] ?>"></input>
          <input type="text" name="price" placeholder="<?php echo  $row["price"] ?>"></input>
        </div>
      </div>
      
       <?php

            }
          } else {
            echo "0 results";
          }
        }
        ?>
        
        </form>
      </div>
      <?php
      mysqli_close($connection);
      ?>



</body>


</html>