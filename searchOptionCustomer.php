<!DOCTYPE php>
<html>

<head>
  <link rel="stylesheet" href="stylesCustomer.css">
  <title> Harveys of Stretton Search Customer Data</title>

</head>

<body>
  <header>
    <img src="HOSImages/HOS logo-1 (2).jpg" alt="Company logo"><a href="HOSindex.html"><button class="homebtn" type="button">Home Page</button></a></p>
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
  if (!$connection) {
    die("Connection Failed: " . mysqli_connect_error());
  }



  //create quert to insert data into table
  if (isset($_GET['Search'])) {
    $filtervalues = $_GET['Search'];
    $query = "SELECT customerID, title, firstName, lastName, address1, address2, county, postCode, telephone, email, notes FROM tblcustomer WHERE CONCAT(customerID, firstName, lastName, address1, postCode, telephone, email) LIKE '%$filtervalues%'";
    $query = mysqli_query($connection, $query);

  ?>
    <main>
      <h1>Welcome to the Harveys of Stretton</h1>

      <div class="testbox">
        <form action="" method="post" name="inputCustomer">
          <div class="banner">
            <h3>Customer Details Search Results</h3>
          </div>
          <?php

          if (mysqli_num_rows($query) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($query)) {
          ?>
              <div class="item">
                <p>Customer ID</p>
                <div class="name-item">
                  <input type="text" name="customerID" placeholder="<?php echo "Customer ID: " . $row["customerID"] ?>" required></input>
                </div>
              </div>
              <?php

              ?>

              <div class="item">
                <p>Name</p>
                <div class="name-item">
                  <input type="text" name="title" placeholder="<?php echo  $row["title"] ?>"></input>
                  <input type="text" name="firstName" placeholder="<?php echo  $row["firstName"] ?>"></input>
                  <input type="text" name="lastName" placeholder="<?php echo  $row["lastName"] ?>"></input>
                </div>
              </div>
              <div class="item">
                <p>Contact Address</p>
                <input type="text" name="address1" placeholder="<?php echo  $row["address1"] ?>"></input>
                <input type="text" name="address2" placeholder="<?php echo  $row["address2"] ?>"></input>
                <div class="city-item">
                  <input type="text" name="county" placeholder="<?php echo $row["county"] ?>"></input>
                  <input type="text" name="postCode" placeholder="<?php echo  $row["postCode"] ?>"></input>
                </div>
              </div>
              <div class="item">
                <p>Phone</p>
                <input type="text" name="telephone" placeholder="<?php echo $row["telephone"] ?>"></input>
              </div>
              <div class="item">
                <p>Email</p>
                <input type="text" name="email" placeholder="<?php echo $row["email"] ?>"></input>
              </div>
              <div class="item">
                <p>Notes</p>
                <textarea rows="5"><?php echo " Notes: " . $row["notes"] ?></textarea>
              </div>
              <div class="banner">
            <h4>Customer Details Search Results</h4>
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