<!DOCTYPE html>
    <head>
        <!-- <link href="styles.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <div class="jumbotron text-center">
        <h1>Sakila Database Portal</h1>
        <p>by Group 1, 2, 3 Rafikis!</p> 
    </div>

    <div class="container">
    <div class="row">
        <div class="col-sm-4">
        <h3><a href="actor.php" class="button">Actors</a></h3>
        <p>Movie Actors</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="language.php" class="button">Languages</a></h3>
        <p>Available Languages</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="customer.php" class="button">Customers</a></h3>
        <p>Customer Database</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="films.php" class="button">Films</a></h3>
        <p>List of our films</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="category.php" class="button">Categories</a></h3>
        <p>Film categories</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="inventory.php" class="button">Inventory</a></h3> 
        <p>What we have in store</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="store.php" class="button">Store</a></h3>
        <p>Our Stores</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="staff.php" class="button">Staff</a></h3>
        <p>Working Staff</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="rental.php" class="button">Rental</a></h3> 
        <p>Rental Database</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="payment.php" class="button">Payment</a></h3>
        <p>Payments Database</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="address.php" class="button">Address</a></h3>
        <p>Addresses</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="city.php" class="button">City</a></h3> 
        <p>Available Cities</p>
        </div>
        <div class="col-sm-4">
        <h3><a href="country.php" class="button">Country</a></h3> 
        <p>Available Countries</p>
        </div>
    </div>

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
        
        $sql = "SELECT first_name, last_name FROM actor LIMIT 10";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                // echo "Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </body>
</html>
