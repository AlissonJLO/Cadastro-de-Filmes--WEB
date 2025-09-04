<?php

require_once 'src/config/config.php';
require_once 'src/config/conexao.php';
require_once 'src/repository/genero.php';
require_once 'src/repository/filme.php';


require_once 'src/layout/header.php';
require_once 'src/layout/menu.php';
?>
<main>
    <?php
    if (isset($_SESSION['mensagem'])) {
        $tipo = $_SESSION['mensagem']['tipo'];
        $texto = $_SESSION['mensagem']['texto'];
        echo "<div class='mensagem $tipo'>$texto</div>";
        unset($_SESSION['mensagem']);
    }

    $page = $_GET['page'] ?? 'home';
    $page_path = "templates/{$page}.php";

    if (file_exists($page_path)) {
        include_once $page_path;

        echo "<h2>Erro 404: Página não encontrada.</h2>";
    }
    ?>
</main>

<?php
require_once 'src/layout/footer.php';
?>