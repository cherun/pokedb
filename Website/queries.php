<?php
    if(isset($_POST['addTrainer'])){
        $servername = "oniddb.cws.oregonstate.edu";
        $username = "anderleo-db";
        $password = "ubEbNUFD6CXwxbCJ";
        $dbname = "anderleo-db";
                
        
       
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        $stmt = $conn->prepare('INSERT INTO trainer_class (class_name, description) VALUES (?, ?)');
        $stmt->bind_param('ss', $name, $desc);
        
        $name = $_POST['trainerName'];
        $desc = $_POST['trainerDesc'];
        
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
        $password = "ubEbNUFD6CXwxbCJ";
        $dbname = "anderleo-db";
        $location = $_POST['locationDropdown'];
        $name = $_POST['pokeDropdown'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        $stmt = $conn->prepare('SELECT location_id FROM locations WHERE location_name =?');
        $stmt->bind_param('s', $location);
        $stmt->execute();
        $stmt->bind_result($lid);
        $results = $stmt->fetch();
        
        $conn2 = new mysqli($servername, $username, $password, $dbname);
        $stmt2 = $conn2->prepare('SELECT pokemon_id from pokemon WHERE name =?');
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
    
    header("Location:main.php");
    exit();
?>