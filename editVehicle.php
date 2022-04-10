<!DOCTYPE php>
<html>

<head>
    <link rel="stylesheet" href="stylesCustomer.css">
    <title> Harveys of Stretton Vehicle Data</title>

</head>

<body>
    <header>
        <img src="HOSImages/HOS logo-1 (2).jpg" alt="Company logo">
    </header>
    <?php
    //chech php is running
    echo "php is running, quick catch it!<br/> ";

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

    $sql = "UPDATE tblvehicle SET vehicleStyle = '$_POST[vehicleStyle]',  vehicleMake = '$_POST[vehicleMake]', vehicleModel ='$_POST[vehicleModel]' , vehicleRegistration = '$_POST[vehicleRegistration]', year = '$_POST[year]', transmission = '$_POST[transmission]', engineSize = '$_POST[engineSize]', vehicleMilage = '$_POST[vehicleMilage]', colour = '$_POST[colour]', price = '$_POST[price]' WHERE vehicleID = '$_POST[vehicleID]'";

    if (mysqli_query($connection, $sql) === TRUE) {
        echo '<script type="text/javascript">

  window.onload = function () { alert("Record updated successfully"); }

  </script>';
    } else {
        echo "Error: " . $sql . "<br/>" . mysqli_error($connection);
    }

    mysqli_close($connection)
    ?>