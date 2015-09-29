<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Database</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<script src="javascript/jquery.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
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
            $password = "wqTNDsuHj21IEyZm";
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
    <table class="table">
      <tr>
        <th>Pokedex ID</th>
        <th>Pokemon Name</th>
        <th>Description</th>
        <th>Possible Moves</th>
        <th>Type</th>
        <th>Locations</th>
        <th>Evolves From</th>
      </tr>
      <tr>
        <td>
          <?php
            if(isset($_POST['pokeButton'])){
              $servername = "oniddb.cws.oregonstate.edu";
              $username = "anderleo-db";
              $password = "wqTNDsuHj21IEyZm";
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
              $password = "wqTNDsuHj21IEyZm";
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
              $password = "wqTNDsuHj21IEyZm";
              $dbname = "anderleo-db";
              
              $name = $_POST['pokeDropdown'];
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              $stmt = $conn->prepare('SELECT move_name FROM moves
                    INNER JOIN pokemon_moves
                    ON moves.move_id = pokemon_moves.mid
                    INNER JOIN pokemon
                    ON pokemon_moves.pid = pokemon.pokemon_id
                    WHERE pokemon.name = ?');
              $stmt->bind_param('s', $name);
              $stmt->execute();
              
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              } 
              
                           
              $moves = "";
              $stmt->bind_result($moves);
              
              while ($stmt->fetch()) {
                echo $moves."<br>";
              }
                            
              $stmt->close();
              $conn->close();
            }
          ?>
        </td>
        <td>
          <?php
            if(isset($_POST['pokeButton'])){
              $servername = "oniddb.cws.oregonstate.edu";
              $username = "anderleo-db";
              $password = "wqTNDsuHj21IEyZm";
              $dbname = "anderleo-db";
              
              $name = $_POST['pokeDropdown'];
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              $stmt = $conn->prepare('SELECT type_name FROM types
                    INNER JOIN pokemon_types
                    ON types.type_id = pokemon_types.tid
                    INNER JOIN pokemon
                    ON pokemon_types.pid = pokemon.pokemon_id
                    WHERE pokemon.name = ?');
              $stmt->bind_param('s', $name);
              $stmt->execute();
              
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              } 
              
                           
              $types = "";
              $stmt->bind_result($types);
              
              while ($stmt->fetch()) {
                echo $types."<br>";
              }
                            
              $stmt->close();
              $conn->close();
            }
          ?>
        </td>
        <td>
          <?php
            if(isset($_POST['pokeButton'])){
              $servername = "oniddb.cws.oregonstate.edu";
              $username = "anderleo-db";
              $password = "wqTNDsuHj21IEyZm";
              $dbname = "anderleo-db";
              
              $name = $_POST['pokeDropdown'];
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              $stmt = $conn->prepare('SELECT location_name FROM locations
                            INNER JOIN pokemon_location
                            ON locations.location_id = pokemon_location.lid
                            INNER JOIN pokemon
                            ON pokemon_location.pid = pokemon.pokemon_id
                            WHERE pokemon.name = ?');
              $stmt->bind_param('s', $name);
              $stmt->execute();
              $location = "";
              $stmt->bind_result($location);
              
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              } 
              
              while ($stmt->fetch()) {
                echo $location."<br>";
              }
                 
              $stmt->close();
              $conn->close();
            }
          ?>
        </td>
        <td>
          <?php
            if(isset($_POST['pokeButton'])){
              $servername = "oniddb.cws.oregonstate.edu";
              $username = "anderleo-db";
              $password = "wqTNDsuHj21IEyZm";
              $dbname = "anderleo-db";
              
              $name = $_POST['pokeDropdown'];
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              $stmt = $conn->prepare('SELECT p1.name FROM pokemon p1
                INNER JOIN pokemon_predecessor pp ON pp.predecessor_pid = p1.pokemon_id
                INNER JOIN pokemon p2 ON p2.pokemon_id = pp.evolution_pid
                WHERE p2.name = ?;');
              $stmt->bind_param('s', $name);
              $stmt->execute();
              $predecessor = "";
              $stmt->bind_result($predecessor);
              
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              } 
              
              while ($stmt->fetch()) {
                echo $predecessor."<br>";
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
      <form name="addPokeForm" action='queries.php' method='POST'>
        Add a new Pokemon:<br>
        ID: <input type="number" id="pokeID" name="pokeID" value="Pokemon ID" min="1" max="151"/>
        Name: <input type="text" id="pokeName" name ="pokeName" value="Pokemon Name" onfocus="if (this.value=='Pokemon Name') this.value='';"/>
        Description: <input type="text" id="pokeDesc" name ="pokeDesc" value="Description" onfocus="if (this.value=='Description') this.value='';"/>
        <input name="addPokemon" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method = 'POST'>
        Add a Pokemon evolution:<br>
        Evolution: <select id = "evolutionDropdown" name = "evolutionDropdown">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
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

              unset($evolution);
              $evolution = $row['name']; 
              echo '<option value="'.$evolution.'">'.$evolution.'</option>';

            }
            $conn->close();
            ?>
        </select>
        Predecessor: <select id = "predecessorDropdown" name = "predecessorDropdown">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
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

              unset($predecessor);
              $predecessor = $row['name']; 
              echo '<option value="'.$predecessor.'">'.$predecessor.'</option>';

            }
            $conn->close();
            ?>
        </select>
        <input name="addEvolution" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form name="addPokeForm" action='queries.php' method='POST'>
        Add a type to a pokemon:<br>
        Name: <select id = "pokemonName" name = "pokemonName">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
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
        Type: <select id = "pokemonType" name = "pokemonType">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
            $dbname = "anderleo-db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT type_name FROM types";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {

              unset($type);
              $type = $row['type_name']; 
              echo '<option value="'.$type.'">'.$type.'</option>';

            }
            $conn->close();
            ?>
        </select>
        <input name="addPokeType" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method='POST'>
        Delete a Pokemon:<br>
        Name: <select id = "pokemonName" name = "pokemonName">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
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
        <input name="deletePokemon" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method='POST'>
        Add a type:<br>
        Name: <input type="text" id="typeName" name="typeName" value="Type Name" onfocus="if (this.value=='Type Name') this.value='';"/>
        <input name="addType" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method='POST'>
        Delete type:<br>
        Name: <select id = "pokemonType" name = "pokemonType">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
            $dbname = "anderleo-db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT type_name FROM types";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {

              unset($types);
              $types = $row['type_name']; 
              echo '<option value="'.$types.'">'.$types.'</option>';

            }
            $conn->close();
            ?>
        </select>
        <input name="deleteType" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action="main.php" method="POST">
        Select a Move to learn more about it: <select id = "moveDropdown" name = "moveDropdown">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
            $dbname = "anderleo-db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT move_name FROM moves";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {

              unset($name);
              $name = $row['move_name']; 
              echo '<option value="'.$name.'">'.$name.'</option>';
            }
            $conn->close();
            ?>
        </select>
        <input name="moveButton" type="submit" class="btn-primary" value="Scan PokeDex"/>
      </form>
    </div>
  </div>
  <div id="tableHolder">
    <table class="table">
      <tr>
        <th>Move Name</th>
        <th>Type</th>
        <th>Base Damage</th>
        <th>Power Points</th>
        <th>Description</th>
      </tr>
      <tr>
        <td>
          <?php
            if(isset($_POST['moveButton'])){
              echo $_POST['moveDropdown'];
            }
          ?>
        </td>
        <td>
          <?php
            if(isset($_POST['moveButton'])){
              $servername = "oniddb.cws.oregonstate.edu";
              $username = "anderleo-db";
              $password = "wqTNDsuHj21IEyZm";
              $dbname = "anderleo-db";
              
              $name = $_POST['moveDropdown'];
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              $stmt = $conn->prepare('SELECT type_name FROM types
                    INNER JOIN moves
                    ON moves.type = types.type_id
                    WHERE moves.move_name = ?');
              $stmt->bind_param('s', $name);
              $stmt->execute();
              $stmt->bind_result($type);
              $result = $stmt->fetch();
              echo $type;
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
            if(isset($_POST['moveButton'])){
              $servername = "oniddb.cws.oregonstate.edu";
              $username = "anderleo-db";
              $password = "wqTNDsuHj21IEyZm";
              $dbname = "anderleo-db";

              $name = $_POST['moveDropdown'];
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              $stmt = $conn->prepare('SELECT base_dmg FROM moves WHERE move_name = ?');
              $stmt->bind_param('s', $name);
              $stmt->execute();
              $stmt->bind_result($base);
              $results = $stmt->fetch();
              echo $base;
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
            if(isset($_POST['moveButton'])){
              $servername = "oniddb.cws.oregonstate.edu";
              $username = "anderleo-db";
              $password = "wqTNDsuHj21IEyZm";
              $dbname = "anderleo-db";

              $name = $_POST['moveDropdown'];
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              $stmt = $conn->prepare('SELECT power_pts FROM moves WHERE move_name = ?');
              $stmt->bind_param('s', $name);
              $stmt->execute();
              $stmt->bind_result($power);
              $results = $stmt->fetch();
              echo $power;
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
            if(isset($_POST['moveButton'])){
              $servername = "oniddb.cws.oregonstate.edu";
              $username = "anderleo-db";
              $password = "wqTNDsuHj21IEyZm";
              $dbname = "anderleo-db";

              $name = $_POST['moveDropdown'];
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              $stmt = $conn->prepare('SELECT description FROM moves WHERE move_name = ?');
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
      <form action='queries.php' method='POST'>
        Add a move:<br>
        Name: <input type="text" id="moveName" name="moveName" value="Move Name" onfocus="if (this.value=='Move Name') this.value='';"/>
        Type: <select id = "moveType" name = "moveType">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
            $dbname = "anderleo-db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT type_name FROM types";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {

              unset($type);
              $type = $row['type_name']; 
              echo '<option value="'.$type.'">'.$type.'</option>';

            }
            $conn->close();
            ?>
        </select>
        Base Damage: <input type="number" id="baseDmg" name="baseDmg" max="120"/>
        Power Points: <input type="number" id="power" name="power" min = "0" max = "100"/>
        Description: <input type="text" id="moveDesc" name="moveDesc" value="Move Description" onfocus="if (this.value=='Move Description') this.value='';"/>
        <input name="addMove" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method='POST'>
        Update a move:<br>
        Name: <select id = "moveName" name = "moveName">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
            $dbname = "anderleo-db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT move_name FROM moves";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {

              unset($name);
              $name = $row['move_name']; 
              echo '<option value="'.$name.'">'.$name.'</option>';

            }
            $conn->close();
            ?>
        </select>
        Base Damage: <input type="number" id="baseDmg" name="baseDmg" value="Base Damage" min="0" max="120"/>
        Power Points: <input type="number" id="power" name="power" value="Type Name" min = "0" max = "100" />
        <input name="updateMove" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method = 'POST'>
        Add a move to a Pokemon:<br>
        Move: <select id = "moveDropdown" name = "moveDropdown">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
            $dbname = "anderleo-db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT move_name FROM moves";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {

              unset($move);
              $move = $row['move_name']; 
              echo '<option value="'.$move.'">'.$move.'</option>';

            }
            $conn->close();
            ?>
        </select>
        Pokemon: <select id = "pokemonDropdown" name = "pokemonDropdown">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
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

              unset($pokemon);
              $pokemon = $row['name']; 
              echo '<option value="'.$pokemon.'">'.$pokemon.'</option>';

            }
            $conn->close();
            ?>
        </select>
        <input name="addMovePoke" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method='POST'>
        Delete move:<br>
        Name: <select id = "moveOptions" name = "moveOptions">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
            $dbname = "anderleo-db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT move_name FROM moves";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {

              unset($moves);
              $moves = $row['move_name']; 
              echo '<option value="'.$moves.'">'.$moves.'</option>';

            }
            $conn->close();
            ?>
        </select>
        <input name="deleteMove" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method='POST'>
        Add a location:<br>
        Name: <input type="text" id="locationName" name="locationName" value="Location Name" onfocus="if (this.value=='Location Name') this.value='';"/>
        Description: <input type="text" id="locationDesc" name="locationDesc" value="Location Description" onfocus="if (this.value=='Location Description') this.value='';"/>
        <input name="addLocation" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method='POST'>
        Delete a location:<br>
        Location: <select id = "locationName" name = "locationName">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
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

              unset($location);
              $location = $row['location_name']; 
              echo '<option value="'.$location.'">'.$location.'</option>';

            }
            $conn->close();
            ?>
        </select>
        <input name="deleteLocation" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method='POST'>
      Add a known Pokemon sighting:<br>
      Pokemon: <select id = "pokeDropdown" name = "pokeDropdown">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
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
            $password = "wqTNDsuHj21IEyZm";
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
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action="main.php" method="POST">
        Select a trainer to learn about them: <select id = "trainerDropdown" name = "trainerDropdown">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
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
        <th>Pokemon Types</th>
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
              $password = "wqTNDsuHj21IEyZm";
              $dbname = "anderleo-db";
              
              $name = $_POST['trainerDropdown'];
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              $stmt = $conn->prepare('SELECT description FROM trainer_class
                            WHERE class_name = ?');
              $stmt->bind_param('s', $name);
              $stmt->execute();
              $desc = "";
              $stmt->bind_result($desc);
              
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              
              while ($stmt->fetch()) {
                echo $desc."<br>";
              }
                 
              $stmt->close();
              $conn->close();
            }
          ?>
        </td>
        <td>
          <?php
            if(isset($_POST['trainerButton'])){
              $servername = "oniddb.cws.oregonstate.edu";
              $username = "anderleo-db";
              $password = "wqTNDsuHj21IEyZm";
              $dbname = "anderleo-db";
              
              $name = $_POST['trainerDropdown'];
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              $stmt = $conn->prepare('SELECT type_name FROM types
                            INNER JOIN trainer_pkmntypes
                            ON types.type_id = trainer_pkmntypes.type_id
                            INNER JOIN trainer_class
                            ON trainer_pkmntypes.trainer_id = trainer_class.class_id
                            WHERE class_name = ?');
              $stmt->bind_param('s', $name);
              $stmt->execute();
              $types = "";
              $stmt->bind_result($types);
              
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              } 
              
              while ($stmt->fetch()) {
                echo $types."<br>";
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
      <form action='queries.php' method = 'POST'>
        Add a trainer<br>
        Name: <input type="text" id="trainerName" name ="trainerName" value="Trainer Name" onfocus="if (this.value=='Trainer Name') this.value='';"/>
        Description: <input type="text" id="trainerDesc" name ="trainerDesc"  value="Description" onfocus="if (this.value=='Description') this.value='';"/>
        <input name="addTrainer" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method = 'POST'>
        Add a type to a trainer:<br>
        Trainer Name: <select id = "trainerDropdown" name = "trainerDropdown">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
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

              unset($class);
              $class = $row['class_name']; 
              echo '<option value="'.$class.'">'.$class.'</option>';

            }
            $conn->close();
            ?>
        </select>
        Pokemon Types: <select id = "typeDropdown" name = "typeDropdown">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
            $dbname = "anderleo-db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT type_name FROM types";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {

              unset($type);
              $type = $row['type_name']; 
              echo '<option value="'.$type.'">'.$type.'</option>';

            }
            $conn->close();
            ?>
        </select>
        <input name="addTrainerType" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <div class="container-fluid">
      <form action='queries.php' method='POST'>
        Delete a trainer class:<br>
        Location: <select id = "trainerName" name = "trainerName">
           <?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "anderleo-db";
            $password = "wqTNDsuHj21IEyZm";
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
        <input name="deleteTrainer" type="submit" class="btn-primary" value="Update PokeDex"/>
      </form>
    </div>
  </div>
  <hr>
  <div>
    <br/><br/>
  </div>
</body>
</html>