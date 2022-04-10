<!DOCTYPE php>
<html>

<head>
    <link rel="stylesheet" href="stylesCustomer.css">
    <title> Harveys of Stretton Customer Data</title>

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

    $sql = "UPDATE tblcustomer SET title = '$_POST[title]', firstName = '$_POST[firstName]', lastName ='$_POST[lastName]' , address1 = '$_POST[address1]', address2 = '$_POST[address2]', county = '$_POST[county]', postCode = '$_POST[postCode]', telephone = '$_POST[telephone]', email = '$_POST[email]' WHERE customerID = '$_POST[customerID]'";

    if (mysqli_query($connection, $sql) === TRUE) {
        echo '<script type="text/javascript">

  window.onload = function () { alert("Record updated successfully"); }

  </script>';
    } else {
        echo "Error: " . $sql . "<br/>" . mysqli_error($connection);
    }

    mysqli_close($connection)
    ?>