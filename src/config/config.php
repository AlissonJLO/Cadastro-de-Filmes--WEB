<?php
// config.php

// Configurações do Banco de Dados PostgreSQL
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'ap1_filmes');
define('DB_USER', 'postgres');
define('DB_PASSWORD', 'postgres');

// Inicia a sessão em todas as páginas
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('America/Cuiaba');
