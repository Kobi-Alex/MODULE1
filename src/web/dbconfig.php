<?php
    require_once 'config.php';
    $airports = require './airports.php';

    $mysqli = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
    if($mysqli->connect_errno){
        die ("Failed to connect to MySQL: (" . $mysqli->connect_errno . ")" .
         $mysqli->connect_error);
    }
    echo "Success!";
    echo PHP_EOL;

    // Table CITY
    $sql = "CREATE TABLE IF NOT EXISTS city (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )";

    if($mysqli->query($sql) === TRUE){
        echo 'Table city created';
        echo PHP_EOL;
    }
    else {die('Error creating table city: '. $mysqli->error);}

    // Table STATE
    $sql = "CREATE TABLE IF NOT EXISTS state (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )";
    
    if($mysqli->query($sql) === TRUE){
        echo 'Table state created';
        echo PHP_EOL;
    }
    else {die('Error creating table state:'. $mysqli->error);}
    
    //Table AIRPORT
    $sql = "CREATE TABLE IF NOT EXISTS airport (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        code VARCHAR(255) NOT NULL,
        address VARCHAR(255),
        timezone VARCHAR(255),
        city_id INT UNSIGNED NOT NULL,
        FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE,
        state_id INT UNSIGNED NOT NULL,
        FOREIGN KEY (state_id) REFERENCES state (id) ON DELETE CASCADE
     )";

    if($mysqli->query($sql) === TRUE){
        echo 'Table airport created';
        echo PHP_EOL;
    }
    else {echo 'Error creating table airport: '. $mysqli->error;}


    foreach ($airports as $value) 
    {
        $sql = "SELECT* FROM city WHERE name = '" . $value['city'] . "'";
        $result = $mysqli -> query($sql);

        if($result -> num_rows == 0)
        {
            $stmt = $mysqli->prepare("INSERT INTO city (name) VALUES (?)");
            $stmt -> bind_param("s", htmlspecialchars($value['city']));
            if($stmt->execute()){echo 'Table city';}
            else {echo 'Error creating table city: '. $stmt->error;}
            $city_id = $mysqli->insert_id;
        }
        else
        {
            $row = $result->fetch_assoc();
            $city_id = $row['id'];
        }

        $sql1 = "SELECT* FROM state WHERE name = '" . $value['state'] . "'";
        $result1 = $mysqli -> query($sql1);

        if($result1 -> num_rows == 0)
        {
            $stmt = $mysqli->prepare("INSERT INTO state (name) VALUES (?)");
            $stmt -> bind_param("s", htmlspecialchars($value['state']));
            if($stmt->execute()) { echo 'Table state'; }
            else {echo 'Error creating table state: '. $stmt->error;}
            $state_id = $mysqli->insert_id;
       
           // $sql = "INSERT INTO position (name) VALUES ('" . $value['position'] . "')";
           // $mysqli->query($sql);
       }
       else
       {
           $row = $result1->fetch_assoc();
           $state_id = $row['id'];
       }

        $stmt = $mysqli->prepare( "INSERT INTO airport (name, code, city_id, state_id, address, timezone)
                                    values (?, ?, ?, ?, ?, ?)");
        $stmt -> bind_param("ssddss", $value['name'], $value['code'], $city_id, $state_id, 
                                $value['address'], $value['timezone']);
             
        if($stmt->execute()){
             echo 'success';
            echo PHP_EOL;
        }
        else {echo 'Error creating table person: '. $stmt->error;}

        // $sql = "SELECT* FROM person";
        // $result = $mysqli -> query($sql);
        // while($row = $result->fetch_assoc()){
        //     var_dump($row);
        // }   
    }

     $mysqli->close();