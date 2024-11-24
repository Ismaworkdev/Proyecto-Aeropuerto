<?php
try {
    $pdo = new PDO('mysql:host=localhost:3307;dbname=proyecto-aeropuerto', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
    echo '<h4>Conexión establecida</h4>';
} catch (PDOException $e) {
    echo 'Error en la conexión: ' . $e->getMessage();
}
