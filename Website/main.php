<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Database</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div id="headline" class="jumbotron">
        <h1>The Pokemon Database</h1>
    </div>
    <div>
        <div class="container-fluid">
            <form action="main.php" method="POST">
                Select a Pokemon to learn more about it: <select id = "pokeDropdown" name = "pokeDropdown">
                     <?php
                        $servername = "oniddb.cws.oregonstate.edu";
                        $username = "anderleo-db";
                        $password = "ubEbNUFD6CXwxbCJ";
                        $dbname = "anderleo-db";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 

                        $sql = "SELECT name FROM pokemon";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {

                          unset($name);
                          $name = $row['name']; 
                          echo '<option value="'.$name.'">'.$name.'</option>';

                        }
                        $conn->close();
                      ?>
                </select>
                <input name="pokeButton" type="submit" class="btn-primary" value="Scan PokeDex"/>
            </form>
        </div>
    </div>
    <div id="tableHolder">
        <table class="table"
            <tr>
                <th>Pokedex ID</th>
                <th>Pokemon Name</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>
                    <?php
                        if(isset($_POST['pokeButton'])){
                            $servername = "oniddb.cws.oregonstate.edu";
                            $username = "anderleo-db";
                            $password = "ubEbNUFD6CXwxbCJ";
                            $dbname = "anderleo-db";
                            
                            $name = $_POST['pokeDropdown'];
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            $query = SELECT pokemon_id FROM pokemon WHERE name=?;
                            $stmt = $mysqli->prepare($query);
                            $stmt->bind_param('s', $name);
                            $stmt->execute();
                            $stmt->bind_result($pokeID);
                            $stmt->fetch();
                            
                            printf("%i", $pokeID);
                            $stmt->close();
                            
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
                            $conn->close();
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if(isset($_POST['pokeButton'])){
                            echo $_POST['pokeDropdown'];
                            $servername = "oniddb.cws.oregonstate.edu";
                            $username = "anderleo-db";
                            $password = "ubEbNUFD6CXwxbCJ";
                            $dbname = "anderleo-db";
                            
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
                            $conn->close();
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if(isset($_POST['pokeButton'])){
                            echo $_POST['pokeDropdown'];
                            $servername = "oniddb.cws.oregonstate.edu";
                            $username = "anderleo-db";
                            $password = "ubEbNUFD6CXwxbCJ";
                            $dbname = "anderleo-db";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $conn->close();
                        }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <div class="container-fluid">
            <h2>Add a Pokemon Sighting</h2>

        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-4">
                <p>A row</p>
            </div>
            <div class="col-xs-4">
                <p>To use</p>
            </div>
            <div class="col-xs-4">
                <p>As needed</p>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <div class="container-fluid">
            <form action="main.php" method="POST">
                Select a Trainer to learn about them: <select id = "trainerDropdown">
                     <?php
                        $servername = "oniddb.cws.oregonstate.edu";
                        $username = "anderleo-db";
                        $password = "ubEbNUFD6CXwxbCJ";
                        $dbname = "anderleo-db";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 

                        $sql = "SELECT class_name FROM trainer_class";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {

                          unset($name);
                          $name = $row['class_name'];
                          echo '<option value="'.$name.'">'.$name.'</option>';

                        }   
                        $conn->close();
                      ?>
                </select>
                <input type="submit" class="btn-primary" value="Scan PokeDex"/>
            </form>
        </div>
    </div>
    <div id="tableHolder">
        <table class="table"
            <tr>
                <th>Trainer Class</th>
                <th>Description</th>
                <th>Pokemon Type</th>
            </tr>
        </table>
    </div>
    <div>
        <div class="container-fluid">
            <h2>Add a Trainer</h2>

        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-4">
                <p>A row</p>
            </div>
            <div class="col-xs-4">
                <p>To use</p>
            </div>
            <div class="col-xs-4">
                <p>As needed</p>
            </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <footer>
                <p>A footer to use as needed</p>
            </footer>
        </div>
    </div>
    </div>
</body>
</html>         