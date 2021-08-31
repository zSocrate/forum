<?php
try{
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $pdo = new PDO('mysql:host=localhost;dbname=forum;charset=utf8;', 'root', '');
}catch(Exception $e){
    die('Une erreur a été trouvée : ' . $e->getMessage());
}
