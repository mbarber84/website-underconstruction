<!DOCTYPE php>
<html>
<head>
    <link rel = "stylesheet" href = "stylesCustomer.css">
    <title> Harveys of Stretton Customer Data</title>

</head>

<body>
    <header>
        <img src="HOSImages/HOS logo-1 (2).jpg" alt = "Company logo"><p><a href="HOSindex.html"><button class = "homebtn" type="button">Home Page</button></a></p>
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
    $sql = "INSERT INTO tblcustomer (customerID, title, firstName, lastName, address1, address2, county, postCode, telephone, email, notes) VALUES ('$_POST[customerID]','$_POST[title]','$_POST[firstName]','$_POST[lastName]', '$_POST[address1]', '$_POST[address2]', '$_POST[county]', '$_POST[postCode]','$_POST[telephone]', '$_POST[email]', '')";


    
    //Insert the data
    if(mysqli_query($connection, $sql)){
        echo '<script type="text/javascript">

        window.onload = function () { alert("New Record Created"); }

        </script>';
        }
        else{
            echo "Error: ".$sql."<br/>".mysqli_error($connection);
        }

        mysqli_close($connection)
    ?>


</body>


</html>