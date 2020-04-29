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
        <h1 class="col-sm-12">Inventory</h1>
        
        
        <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Language</th>
                <th>Rental</th>
                <th>Inventory</th>
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
        
        $sql = "SELECT f.title AS 'title',l.name AS 'language', f.rental_rate AS 'rental', COUNT(i.film_id)AS 'Inventory'
                FROM inventory i
                INNER JOIN film f ON i.film_id = f.film_id
                INNER JOIN language l ON f.language_id = l.language_id
                GROUP BY f.film_id LIMIT 100";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["title"] . "</td><td>" . $row["language"]. "</td><td>" . $row["rental"]. "</td><td>" . $row["Inventory"]. "</td></tr>";
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
