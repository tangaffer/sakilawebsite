<!DOCTYPE html>
    <head>
        <link href="styles.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="jumbotron text-center">
            <h1>Sakila Database Portal</h1>
            <p>by Group 1, 2, 3 Rafikis!</p> 
            <a href="index.php" id="buttonLol">Home</a>
        </div>

        <div class="container">
        
        <!-- First container -->
        <div class="col-sm-7">
        <h1 class="col-sm-12">Staff</h1>

        <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Staff ID</th>
            </tr>
        </thead>
        <tbody>

        <?php 
        $servername = "127.0.0.1";
        $username = "custom";
        $password = "password";
        $dbname = "sakila";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "SELECT * FROM staff";
        $result = $conn->query($sql);
        $latestID = 0;

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $latestID = $row["staff_id"];
                echo "<tr><td>" . $row["first_name"]. " " . $row["last_name"]. "</td><td>" . $row["staff_id"] . "</td></tr>";
            }
        } else {
            echo "0 results";
        }
        $latestID = $latestID + 1;

        $conn->close();
        ?>

        </tbody>
        </table>
        </div>

        <div class="col-sm-1">
        </div>

        <!-- CRUD div  -->
        <div style="background-color:#eeeeee; border-radius:20px;margin-bottom:30px; box-shadow:10px 10px #a1a1a1" class="col-sm-4">

        <span class="col-sm-12" style="height:7px;background-color:green"></span>
        <div class="col-sm-12">
        <h2 class="col-sm-12">Insert New Staff</h2>
        
        </div>

        <br>
        <form method="POST">

        <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" class="form-control" placeholder="Enter First Name" id="fname" name="fname">
        </div>

        <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" class="form-control" placeholder="Enter Last Name" id="lname" name="lname">
        </div>

        <button name="Insert" type="submit" value="Insert" class="btn btn-primary" style="background-color:green; border:none">Insert</button>
        </form>
        <br>

        <?php

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM staff";
        $result = $conn->query($sql);
        $latestID = 0;

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $latestID = $row["staff_id"];
            }
        } 
        $latestID = $latestID + 1;

        if (isset($_POST['Insert'])) {
            $firstName = $_POST['fname'];
            $lastName = $_POST['lname'];

            $query = "INSERT INTO staff (staff_id, first_name, last_name, address_id) VALUES ($latestID, '$firstName', '$lastName', 5)";
            if (mysqli_query($conn, $query)) {
                echo "Record added successfully";
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
            }
        }

        $conn->close();
        ?>

        <span class="col-sm-12" style="height:7px;background-color:cornflowerblue"></span>
        <div class="col-sm-12">
        <h2 class="col-sm-12">Update Staff</h2>
        
        </div>

        <br>
        <form method="POST">

        <div class="form-group">
            <label for="idNumber">ID Number:</label>
            <input type="text" class="form-control" placeholder="Enter First Name" id="idNumber" name="idNumber">
        </div>

        <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" class="form-control" placeholder="Enter First Name" id="fname" name="fname">
        </div>

        <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" class="form-control" placeholder="Enter Last Name" id="lname" name="lname">
        </div>

        <button name="Update" type="submit" value="Update" class="btn btn-primary">Update</button>
        </form>
        <br>

        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        if (isset($_POST['Update'])) {
            $idNumber = $_POST['idNumber'];
            $firstName = $_POST['fname'];
            $lastName = $_POST['lname'];

            $query = "UPDATE staff SET first_name='$firstName', last_name='$lastName' WHERE staff_id='$idNumber' ";
            if ($idNumber != 1 && $idNumber != 2) {
                if (mysqli_query($conn, $query)) {
                    echo "Record updated successfully";
                    echo "<meta http-equiv='refresh' content='0'>";
                } else {
                    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
                }
            } else {
                echo "You cannot alter/update the first two staff, they are essential!";
            }

        }

        $conn->close();
        ?>

        <span class="col-sm-12" style="height:7px;background-color:red"></span>
        <div class="col-sm-12">
        <h2 class="col-sm-12">Delete Staff</h2>
        
        </div>

        <form method="POST">

        <div class="form-group">
            <label for="idNumber">ID Number:</label>
            <input type="text" class="form-control" placeholder="Enter First Name" id="idNumber" name="idNumber">
        </div>

        <button name="Delete" type="submit" value="Delete" class="btn btn-primary" style="background-color:red; border:none">Delete</button>
        </form>
        <br>

        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        if (isset($_POST['Delete'])) {
            $idNumber = $_POST['idNumber'];

            $query = "DELETE FROM staff WHERE staff_id = $idNumber";
            if ($idNumber != 1 && $idNumber != 2) {
                if (mysqli_query($conn, $query)) {
                    echo "Record deleted successfully";
                    echo "<meta http-equiv='refresh' content='0'>";
                } else {
                    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
                }
            } else {
                echo "You cannot delete the first two staff, they are essential!";
            }
            
        }

        $conn->close();
        ?>

        <br>
        </div>

        <!-- End of container div -->
        </div>
    </body>
</html>
