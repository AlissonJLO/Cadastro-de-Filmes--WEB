<?php

require_once 'config.php';
function conectarBd()
{
    $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
    try {
        return new PDO($dsn, DB_USER, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {
        // Em um sistema real, logaria o erro em vez de exibi-lo
        die("Erro de conexão com o banco de dados: " . $e->getMessage());
    }
}
