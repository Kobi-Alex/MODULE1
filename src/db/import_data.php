<?php

    require_once 'pdo_ini.php';
    $airports = require_once 'airports.php';

    echo 'Import is started';
    echo PHP_EOL;

    foreach ($airports as $airport) {
       
        //cities
        $stmt =$pdo->prepare('SELECT `id` FROM `cities` WHERE `name` = :name');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->bindParam(':name', $airport_name);
        $airport_name = htmlspecialchars(trim($airport['city']));

        $stmt->execute(); // виконуємо запит
        $city = $stmt->fetch();
        // $city = $stmt->fetchAll();
        
        if (!$city)
        {
            $stmt = $pdo->prepare('INSERT INTO `cities` (`name`) VALUES (:name)');
            $stmt->execute(['name'=>$airport['city']]);
            $city_id  = $pdo->lastInsertId();
        }
        else{
            $city_id  = $city['id'];
        }
        
        
        //states
        $stmt =$pdo->prepare('SELECT `id` FROM `states` WHERE `name` = :name');
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->bindParam(':name', $airport_name);
        $airport_name = htmlspecialchars(trim($airport['state']));
    
        $stmt->execute(); // виконуємо запит
        $state = $stmt->fetch();
        
        if (!$state)
        {
            $stmt = $pdo->prepare('INSERT INTO `states` (`name`) VALUES (:name)');
            $stmt->execute(['name'=>$airport['state']]);
            $state_id  = $pdo->lastInsertId();
        }
        else{
            $state_id  = $state['id'];
        }

        //airports
        $stmt = $pdo->prepare('INSERT INTO `airports` (`name`, `code`, `city_id`, `state_id`, `address`, `timezone`) 
        VALUES (:name, :code, :city_id, :state_id, :address, :timezone)');
        $stmt->execute([
            'name'=>$airport['name'],
            'code'=>$airport['code'],
            'city_id'=>$city_id,
            'state_id'=>$state_id,
            'address'=>$airport['address'],
            'timezone'=>$airport['timezone']
        ]);
    }