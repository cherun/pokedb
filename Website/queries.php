<?php
    if(isset($_POST['addTrainer'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        
        $name = $_POST['trainerName'];
        $desc = $_POST['trainerDesc'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('INSERT INTO trainer_class (class_name, description) VALUES (?, ?)');
        $stmt->bind_param('ss', $name, $desc);
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }

    if(isset($_POST['addTrainerType'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        
        $name = $_POST['trainerDropdown'];
        $type = $_POST['typeDropdown'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('SELECT class_id FROM trainer_class WHERE class_name = (?)');
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $stmt->bind_result($trid);
        $results = $stmt->fetch();
        
        $conn2 = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn2->prepare('SELECT type_id FROM types WHERE type_name = (?)');
        $stmt->bind_param('s', $type);
        $stmt->execute();
        $stmt->bind_result($tid);
        $results = $stmt->fetch();
        
        $conn3 = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn3->prepare('INSERT INTO trainer_pkmntypes (trainer_id, type_id) VALUES (?, ?)');
         $stmt->bind_param('ss', $trid, $tid);
        $types = $_POST['typeDropdown'];
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    if(isset($_POST['addPokemon'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        // Create connection
        $id = $_POST['pokeID'];
        $name = $_POST['pokeName'];
        $desc = $_POST['pokeDesc'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('INSERT INTO pokemon (pokemon_id, name, description) VALUES (?, ?, ?)');
        $stmt->bind_param('dss', $id, $name, $desc);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['addEvolution'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        
        $evolution = $_POST['evolutionDropdown'];
        $predecessor = $_POST['predecessorDropdown'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('SELECT pokemon_id FROM pokemon WHERE name = (?)');
        $stmt->bind_param('s', $evolution);
        $stmt->execute();
        $stmt->bind_result($eid);
        $results = $stmt->fetch();
        
        $conn2 = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn2->prepare('SELECT pokemon_id FROM pokemon WHERE name = (?)');
        $stmt->bind_param('s', $predecessor);
        $stmt->execute();
        $stmt->bind_result($pid);
        $results = $stmt->fetch();
        
        $conn3 = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn3->prepare('INSERT INTO pokemon_predecessor (evolution_pid, predecessor_pid) VALUES (?, ?)');
         $stmt->bind_param('ss', $eid, $pid);
        $types = $_POST['typeDropdown'];
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }

    if(isset($_POST['addSighting'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        $location = $_POST['locationDropdown'];
        $evolution = $_POST['pokeDropdown'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        $stmt = $conn->prepare('SELECT location_id FROM locations WHERE location_name = ?');
        $stmt->bind_param('s', $location);
        $stmt->execute();
        $stmt->bind_result($lid);
        $results = $stmt->fetch();
        
        $conn2 = new mysqli($servername, $username, $password, $dbname);
        $stmt2 = $conn2->prepare('SELECT pokemon_id from pokemon WHERE name = ?');
        $stmt2->bind_param('s', $name);
        $stmt2->execute();
        $stmt2->bind_result($pid);
        $results = $stmt2->fetch();
        
        $conn3 = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn3->prepare('INSERT INTO pokemon_location (pid, lid) VALUES (?, ?)');
        $stmt->bind_param('ss', $pid, $lid);
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }

    if(isset($_POST['addMovePoke'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";

        $move = $_POST['moveDropdown'];
        $pokemon = $_POST['pokemonDropdown'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        $stmt = $conn->prepare('SELECT move_id FROM moves WHERE move_name = ?');
        $stmt->bind_param('s', $move);
        $stmt->execute();
        $stmt->bind_result($mid);
        $results = $stmt->fetch();
        
        $conn2 = new mysqli($servername, $username, $password, $dbname);
        $stmt2 = $conn2->prepare('SELECT pokemon_id from pokemon WHERE name = ?');
        $stmt2->bind_param('s', $pokemon);
        $stmt2->execute();
        $stmt2->bind_result($pid);
        $results = $stmt2->fetch();
        
        $conn3 = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn3->prepare('INSERT INTO pokemon_moves (mid, pid) VALUES (?, ?)');
        $stmt->bind_param('dd', $mid, $pid);
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    if(isset($_POST['addType'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        // Create connection
        
        $name = $_POST['typeName'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('INSERT INTO types (type_name) VALUES (?)');
        $stmt->bind_param('s', $name);
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    if(isset($_POST['addLocation'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        // Create connection
        
        $name = $_POST['locationName'];
        $desc = $_POST['locationDesc'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('INSERT INTO locations (location_name, description) VALUES (?, ?)');
        $stmt->bind_param('ss', $name, $desc);
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    if(isset($_POST['deletePokemon'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        // Create connection
        
        $name = $_POST['pokemonName'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('DELETE FROM pokemon WHERE name = ?');
        $stmt->bind_param('s', $name);
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    if(isset($_POST['deleteType'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        // Create connection
        
        $type = $_POST['pokemonType'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('DELETE FROM types WHERE type_name = ?');
        $stmt->bind_param('s', $type);
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    if(isset($_POST['deleteLocation'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        // Create connection
        
        $location = $_POST['locationName'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('DELETE FROM locations WHERE location_name = ?');
        $stmt->bind_param('s', $location);
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }

    if(isset($_POST['deleteTrainer'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        // Create connection
        
        $name = $_POST['trainerName'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('DELETE FROM trainer_class WHERE class_name = ?');
        $stmt->bind_param('s', $name);
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    if(isset($_POST['addPokeType'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        $name = $_POST['pokemonName'];
        $type = $_POST['pokemonType'];
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('SELECT type_id FROM types WHERE type_name = ?');
        $stmt->bind_param('s', $type);
        $stmt->execute();
        $stmt->bind_result($tid);
        $results = $stmt->fetch();
        
        $conn2 = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn2->prepare('SELECT pokemon_id FROM pokemon WHERE name = ?');
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $stmt->bind_result($pid);
        $results = $stmt->fetch();
        
        $conn3 = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn3->prepare('INSERT INTO pokemon_types (pid, tid) VALUES (?, ?)');
        $stmt->bind_param('dd', $pid, $tid);
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    if(isset($_POST['addMove'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        $name = $_POST['moveName'];
        $base = $_POST['baseDmg'];
        $power = $_POST['power'];
        $desc = $_POST['moveDesc'];
        $type = $_POST['moveType'];
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('SELECT type_id FROM types WHERE type_name = (?)');
        $stmt->bind_param('s', $type);
        $stmt->execute();
        $stmt->bind_result($moveType);
        $results = $stmt->fetch();

        $conn2 = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn2->prepare('INSERT INTO moves (move_name, type, base_dmg, power_pts, description) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sddds', $name, $moveType, $base, $power, $desc);
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    if(isset($_POST['deleteMove'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        // Create connection
        
        $move = $_POST['moveOptions'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('DELETE FROM moves WHERE move_name = ?');
        $stmt->bind_param('s', $move);
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    if(isset($_POST['updateMove'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "wqTNDsuHj21IEyZm";
        $dbname = "anderleo-db";
        
        // Create connection
        $base = $_POST['baseDmg'];
        $power = $_POST['power'];
        $move = $_POST['moveName'];
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare('UPDATE moves SET base_damage = (?), power_pts = (?) WHERE move_name = (?)');
        $stmt->bind_param('dds', $base, $power, $move);
        
        $stmt->execute();
        $stmt->close();
                            
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $conn->close();
    }
    
    header("Location:main.php");
    exit();
?>