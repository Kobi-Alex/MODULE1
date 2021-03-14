<?php

    // підє
    require_once 'config.php';

    try {
        $pdo = new \PDO(
            sprintf("mysql::host=%s; dbname=%s", SERVER_NAME, DB_NAME), //форматування стрічки
            USER_NAME,
            PASSWORD
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        die("Connected failed: " . $e->getMEssage());
    }

