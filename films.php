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

        <!-- First table div -->
        <div class="col-sm-7">
        <h1 class="col-sm-12">Films</h1>
        
        <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Release Year</th>
                <th>Rental Rate</th>
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
        
        $sql = "SELECT * FROM film";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>". $row["film_id"]."</td><td>" . $row["title"] . "</td><td>" . $row["description"]. " </td><td>" . $row["release_year"]. "</td><td>USD" . $row["rental_rate"]."</td></tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        </tbody>
        </table>
        </div>

        <div class="col-sm-1">
        </div>

        <!-- CRUD div -->
        <div style="background-color:#eeeeee; border-radius:20px;margin-bottom:30px; box-shadow:10px 10px #a1a1a1" class="col-sm-4">
        <span class="col-sm-12" style="height:7px;background-color:green"></span>
        <div class="col-sm-12">
        <h2 class="col-sm-12">Insert New Film</h2>
        </div>

        <br>
        <form method="POST">

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" placeholder="Enter Film Title" id="title" name="title">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" placeholder="Enter Film Description" id="description" name="description">
        </div>

        <div class="form-group">
            <label for="releaseYear">Release Year:</label>
            <input type="text" class="form-control" placeholder="Enter Film Release Year" id="releaseYear" name="releaseYear">
        </div>

        <div class="form-group">
            <label for="rentalRate">Rental Rate:</label>
            <input type="text" class="form-control" placeholder="Enter Film Rental Rate" id="rentalRate" name="rentalRate">
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

        $sql = "SELECT * FROM film";
        $result = $conn->query($sql);
        $latestID = 0;

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $latestID = $row["film_id"];
            }
        } 
        $latestID = $latestID + 1;

        if (isset($_POST['Insert'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $releaseYear = $_POST['releaseYear'];
            $rentalRate = $_POST['rentalRate'];

            $query = "INSERT INTO film (film_id, title, description, release_year, rental_rate, language_id) VALUES ($latestID, '$title', '$description', '$releaseYear', '$rentalRate', 1)";
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
        <h2 class="col-sm-12">Update Film</h2>
        </div>

        <br>
        <form method="POST">

        <div class="form-group">
            <label for="idNumber">ID Number:</label>
            <input type="text" class="form-control" placeholder="Enter Film ID to Update" id="idNumber" name="idNumber">
        </div>

        <div class="form-group">
            <label for="updatedTitle">Updated Title:</label>
            <input type="text" class="form-control" placeholder="Enter Film's Updated Title" id="updatedTitle" name="updatedTitle">
        </div>

        <div class="form-group">
            <label for="updatedDescription">Updated Description:</label>
            <input type="text" class="form-control" placeholder="Enter Film's Updated Description" id="updatedDescription" name="updatedDescription">
        </div>

        <div class="form-group">
            <label for="updatedReleaseYear">Updated Release Year:</label>
            <input type="text" class="form-control" placeholder="Enter Film's Updated Release Year" id="updatedReleaseYear" name="updatedReleaseYear">
        </div>

        <div class="form-group">
            <label for="updatedRentalRate">Updated Rental Rate:</label>
            <input type="text" class="form-control" placeholder="Enter Film's Updated Rental Rate" id="updatedRentalRate" name="updatedRentalRate">
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
            $updatedTitle = $_POST['updatedTitle'];
            $updatedDescription = $_POST['updatedDescription'];
            $updatedReleaseYear = $_POST['updatedReleaseYear'];
            $updatedRentalRate = $_POST['updatedRentalRate'];

            $query = "UPDATE film SET title='$updatedTitle', description='$updatedDescription', release_year='$updatedReleaseYear', rental_rate='$updatedRentalRate' WHERE film_id=$idNumber ";
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
        <h2 class="col-sm-12">Delete Film</h2>
        
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

            $query = "DELETE FROM film WHERE film_id = $idNumber";
            if (mysqli_query($conn, $query)) {
                echo "Record deleted successfully";
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
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
