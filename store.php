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
        <h1 class="col-sm-12">Stores</h1>
        
        
        <table class="table">
        <thead>
            <tr>
                <th>Store ID</th>
                <th>Manager</th>
                <th>Address</th>
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
        
        $sql = "SELECT s.store_id AS 'Store ID', address, district, first_name, last_name 
                FROM store s
                INNER JOIN address a ON s.address_id = a.address_id
                INNER JOIN staff ON s.manager_staff_id = staff.staff_id"; 
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Store ID"] . "</td><td>" . $row["first_name"]. " " . $row["last_name"]." </td><td>" . $row["address"]. ", " . $row["district"]. "</td></tr>";
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
