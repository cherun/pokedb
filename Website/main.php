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
                <th>Possible Moves</th>
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
                            $stmt = $conn->prepare('SELECT pokemon_id FROM pokemon WHERE name=?');
                            $stmt->bind_param('s', $name);
                            $stmt->execute();
                            $stmt->bind_result($pokeID);
                            $results = $stmt->fetch();
                            echo $pokeID;
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
                        }
                    ?>
                </td>
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
                            $stmt = $conn->prepare('SELECT description FROM pokemon WHERE name=?');
                            $stmt->bind_param('s', $name);
                            $stmt->execute();
                            $stmt->bind_result($pokeDesc);
                            $results = $stmt->fetch();
                            echo $pokeDesc;
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
                            $servername = "oniddb.cws.oregonstate.edu";
                            $username = "anderleo-db";
                            $password = "ubEbNUFD6CXwxbCJ";
                            $dbname = "anderleo-db";
                            
                            $name = $_POST['pokeDropdown'];
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            $stmt = $conn->prepare('SELECT move_name, type_name  FROM moves, types
            WHERE moves.type = types.type_id AND types.type_name = (SELECT type_name FROM pokemon
            INNER JOIN pokemon_types
            ON pokemon.pokemon_id = pokemon_types.pid
            INNER JOIN types
            ON pokemon_types.tid = types.type_id
            WHERE pokemon.name=?)');
                            $stmt->bind_param('s', $name);
                            $stmt->execute();
                            $stmt->bind_result($pokeMoves);
                            $results = $stmt->fetch();
                            
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
                            
                            $stmt->close();
                            $conn->close();
                        }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <div>
        <div class="container-fluid">
            Add a Pokemon Sighting:  
             Pokemon: <select id = "pokeDropdown" name = "pokeDropdown">
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
            Location: <select id = "locationDropdown" name = "locationDropdown">
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

                        $sql = "SELECT location_name FROM locations";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {

                          unset($name);
                          $name = $row['location_name']; 
                          echo '<option value="'.$name.'">'.$name.'</option>';

                        }
                        $conn->close();
                      ?>
                </select>
            <input name="addSighting" type="submit" class="btn-primary" value="Update PokeDex"/>
        </div>
    </div>
    <hr>
    <div>
        <div class="container-fluid">
            <form action="main.php" method="POST">
                Select a Trainer to learn about them: <select id = "trainerDropdown" name = "trainerDropdown">
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
                <input name="trainerButton" type="submit" class="btn-primary" value="Scan PokeDex"/>
            </form>
        </div>
    </div>
    <div id="tableHolder">
        <table class="table"
            <tr>
                <th>Trainer Class</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>
                    <?php
                        echo $_POST['trainerDropdown'];
                    ?>
                </td>
                <td>
                    <?php
                        if(isset($_POST['trainerButton'])){
                            $servername = "oniddb.cws.oregonstate.edu";
                            $username = "anderleo-db";
                            $password = "ubEbNUFD6CXwxbCJ";
                            $dbname = "anderleo-db";
                            
                            $name = $_POST['trainerDropdown'];
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            $stmt = $conn->prepare('SELECT description FROM trainer_class WHERE class_name=?');
                            $stmt->bind_param('s', $name);
                            $stmt->execute();
                            $stmt->bind_result($desc);
                            $results = $stmt->fetch();
                            echo $desc;
                            $stmt->close();
                            
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
    <hr>
    <div>
        <div class="container-fluid">
            <h2>Add a Trainer</h2>
            <form action=queries.php method = POST>
                Name: <input type="text" id="trainerName" name ="trainerName" value="Trainer Name"/>
                Description: <input type="text" id="trainerDesc" name ="trainerDesc"  value="Description"/>
                <input name="addTrainer" type="submit" class="btn-primary" value="Update PokeDex"/>
            </form>
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
</body>
</html>         