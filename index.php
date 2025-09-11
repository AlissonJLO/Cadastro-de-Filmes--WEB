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
    // Sistema de mensagens flash (já estava correto)
    if (isset($_SESSION['mensagem'])) {
        $tipo = $_SESSION['mensagem']['tipo'];
        $texto = $_SESSION['mensagem']['texto'];
        echo "<div class='mensagem $tipo'>$texto</div>";
        unset($_SESSION['mensagem']);
    }

    // Lista de páginas permitidas (já estava correto)
    $paginas_permitidas = [
        'home',
        'listar_filmes',
        'cadastrar_filme',
        'visualizar_filme',
        'listar_generos',
        'cadastrar_genero',
    ];

    $pagina = $_GET['page'] ?? 'home';

    if (in_array($pagina, $paginas_permitidas)) {
        // --- LÓGICA DE PRÉ-CARREGAMENTO DE DADOS ---

        // Variáveis que serão passadas para as views
        $filme_para_edicao = null;
        $genero_para_edicao = null; // ADICIONADO: para edição de gênero
        $generos = []; // Inicializa como array vazio

        // Se a página for o formulário de FILME...
        if ($pagina === 'cadastrar_filme') {
            // ... busca a lista de todos os gêneros para o <select>
            $generos = buscarTodosGeneros();

            // ... e se tiver um ID na URL, busca o filme para edição
            if (isset($_GET['id'])) {
                $id_filme = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($id_filme) {
                    $filme_para_edicao = buscarFilmePorId($id_filme);
                }
            }
        }

        // ADICIONADO: Se a página for o formulário de GÊNERO e tiver um ID...
        if ($pagina === 'cadastrar_genero' && isset($_GET['id'])) {
            $id_genero = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if ($id_genero) {
                // ... busca o gênero específico para preencher o formulário de edição
                $genero_para_edicao = buscarGeneroPorId($id_genero); // Assumindo que você tem essa função
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