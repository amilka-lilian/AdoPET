<?php
// AdoPET/db.php

$db_config = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'adopet'
];

function get_db_connection() {
    global $db_config;
    try {
        $conn = new mysqli($db_config['host'], $db_config['user'], $db_config['password'], $db_config['database']);
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");
        return $conn;
    } catch (Exception $e) {
        // Em um ambiente de produ��o, seria melhor logar o erro do que exibi-lo.
        die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }
}
?>