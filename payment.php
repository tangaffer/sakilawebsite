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
        <h1 class="col-sm-12">Payment</h1>
        
        
        <table class="table">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Customer ID</th>
                <th>Rental ID</th>
                <th>Payment Amount</th>
                <th>Payment Date</th>
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
        
        $sql = "SELECT * FROM payment LIMIT 100";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["payment_id"] . "</td><td>" . $row["customer_id"]. "</td><td>" . $row["rental_id"]. "</td><td>" . $row["amount"]. "</td><td>" . $row["payment_date"] . "</td></tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        </tbody>
        </table>
        </div>
    </body>
</html>
