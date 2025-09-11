<?php
session_start();

require_once 'src/config/config.php';
require_once 'src/config/conexao.php';
require_once 'src/repository/genero.php';
require_once 'src/repository/filme.php';

require_once 'src/layout/header.php';
require_once 'src/layout/menu.php';
?>

<main class="conteudo-principal">
  <?php

    if (isset($_SESSION['mensagem'])) {
        $tipo = $_SESSION['mensagem']['tipo'];
        $texto = $_SESSION['mensagem']['texto'];
        echo "<div class='mensagem $tipo'>$texto</div>";
        unset($_SESSION['mensagem']);
    }


    $paginas_permitidas = [
        'home',
        'listar_filmes',
        'cadastrar_filme',
        'visualizar_filme',
        'listar_generos',
        'cadastrar_genero',
        'editar_genero',
    ];

    $pagina = $_GET['page'] ?? 'home';

    if (in_array($pagina, $paginas_permitidas)) {

        $filme_para_edicao = null;
        $genero_para_edicao = null;
        $generos = [];

        if ($pagina === 'cadastrar_filme') {
            $generos = buscarTodosGeneros();

            if (isset($_GET['id'])) {
                $id_filme = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($id_filme) {
                    $filme_para_edicao = buscarFilmePorId($id_filme);
                }
            }
        }

        $caminho_pagina = "src/view/{$pagina}.php";

        if (file_exists($caminho_pagina)) {
            include_once $caminho_pagina;
        } else {
            echo "<h2>Erro Interno: O arquivo para a página '{$pagina}' não foi encontrado.</h2>";
        }
    } else {
        echo "<h2>Erro 404: Página não encontrada.</h2>";
    }
    ?>
</main>

<?php
require_once 'src/layout/footer.php';
?>