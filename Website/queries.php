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
    header("Location:main.php");
    exit();
?>