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
        <h1 class="col-sm-12">Countries</h1>
        
        
        <table class="table">
        <thead>
            <tr>
                <th>Index</th>
                <th>Country</th>
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
        
        $sql = "SELECT * FROM country";
        $result = $conn->query($sql);
        $counter = 1;

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>$counter </td><td>" . $row["country"] . "</td></tr>";
                $counter += 1;
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
