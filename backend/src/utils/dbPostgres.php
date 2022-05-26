<?php

function connectDB()
{
    $host     = "db";
    $database = "postgres";
    $user     = "postgres";
    $password = "postgres";

    try {
       return new PDO("pgsql:host=$host;port=5432;dbname=$database",$user,$password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $err) {
        echo "Falha ao conectar ao banco de dados.";
        die($err->getMessage());
    }
}