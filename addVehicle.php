<!DOCTYPE php>
<html>
<head>
    <link rel = "stylesheet" href = "stylesCustomer.css">
    <title> Harveys of Stretton Vehicle Data</title>

</head>

<body>
    <header>
        <img src="HOSImages/HOS logo-1 (2).jpg" alt = "Company logo"><a href="HOSindex.html"><button class = "homebtn" type="button">Home Page</button></a></p>
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
    if(!$connection) {
        die("Connection Failed: ".mysqli_connect_error());
    }

    //create quert to insert data into table
    $sql = "INSERT INTO tblvehicle (vehicleID, vehicleStyle, vehicleMake, vehicleModel, vehicleRegistration, year, transmission, engineSize, vehicleMilage, colour, price, notes ) VALUES ('$_POST[vehicleID]','$_POST[vehicleStyle]','$_POST[vehicleMake]', '$_POST[vehicleModel]', '$_POST[vehicleRegistration]', '$_POST[year]', '$_POST[transmission]','$_POST[engineSize]', '$_POST[vehicleMilage]', '$_POST[colour]', '$_POST[price]', '')";

    //Insert the data
    if(mysqli_query($connection, $sql)){
        echo "New Record Created";
    }
        else{
            echo "Error: ".$sql."<br/>".mysqli_error($connection);
        }

        mysqli_close($connection)
    ?>


</body>


</html>