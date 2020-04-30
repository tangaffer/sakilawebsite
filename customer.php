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
        <h1 class="col-sm-12">Customers</h1>
        
        
        <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>ID</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <!-- Pagination Code -->
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

        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }

        $no_of_records_per_page = 25;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM customer";
        $result = mysqli_query($conn, $total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        ?>
        <?php 
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "SELECT * FROM customer LIMIT $offset, $no_of_records_per_page";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["first_name"] . " " . $row["last_name"]. "</td><td>" . $row["customer_id"]. "</td><td>" . $row["email"]. "</td></tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        </tbody>
        </table>
        <ul class="pagination">
            <li class="page-item"><a href="?pageno=1">First</a></li>
            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
            </li>
            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
            </li>
            <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>
        </div>

        <div class="col-sm-1">
        </div>

        <!-- CRUD forms -->
        <div style="background-color:#eeeeee; border-radius:20px;margin-bottom:150px; box-shadow:10px 10px #a1a1a1" class="col-sm-4">

        <span class="col-sm-12" style="height:7px;background-color:green"></span>
        <div class="col-sm-12">
        <h2 class="col-sm-12">Insert New Customer</h2>
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

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email">
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

        $sql = "SELECT * FROM customer";
        $result = $conn->query($sql);
        $latestID = 0;

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $latestID = $row["customer_id"];
            }
        } 
        $latestID = $latestID + 1;

        if (isset($_POST['Insert'])) {
            $firstName = $_POST['fname'];
            $lastName = $_POST['lname'];
            $email = $_POST['email'];

            $query = "INSERT INTO customer (customer_id, store_id, first_name, last_name, email, address_id) VALUES ($latestID, 1, '$firstName', '$lastName', '$email', 5)";
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
        <h2 class="col-sm-12">Update Customer</h2>
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

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email">
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
            $email = $_POST['email'];

            $query = "UPDATE customer SET first_name='$firstName', last_name='$lastName', email='$email' WHERE customer_id=$idNumber ";
            if (mysqli_query($conn, $query)) {
                echo "Record updated successfully";
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
            }

        }

        $conn->close();
        ?>

        <span class="col-sm-12" style="height:7px;background-color:red"></span>
        <div class="col-sm-12">
        <h2 class="col-sm-12">Delete Customer</h2>
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

            $query = "DELETE FROM customer WHERE customer_id = $idNumber";
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

        <!-- End of container -->
        </div>
    </body>
</html>
