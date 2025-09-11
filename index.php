<?php
session_start(); // Sempre inicie a sessão no topo!

require_once 'src/config/config.php';
require_once 'src/config/conexao.php';
require_once 'src/repository/genero.php';
require_once 'src/repository/filme.php';


require_once 'src/layout/header.php';
require_once 'src/layout/menu.php';
?>

<main class="conteudo-principal">
  <?php
    // Bloco para exibir mensagens de sucesso ou erro (seu código estava correto)
    if (isset($_SESSION['mensagem'])) {
        $tipo = $_SESSION['mensagem']['tipo']; // 'sucesso' ou 'erro'
        $texto = $_SESSION['mensagem']['texto'];
        echo "<div class='mensagem $tipo'>$texto</div>";
        unset($_SESSION['mensagem']); // Remove a mensagem para não ser exibida novamente
    }

    // --- LÓGICA DE ROTEAMENTO CORRIGIDA E SEGURA ---

    // 1. Defina aqui todas as páginas que seu sistema pode carregar (Whitelist)
    $paginas_permitidas = [
        'home',
        'listar_filmes',
        'cadastrar_filme',
        'editar_filme',
        'visualizar_filme',
        'listar_generos',
        'cadastrar_genero',
        'editar_genero'
    ];

    // 2. Pega a página da URL. Se não vier nada, o padrão é 'home'.
    $pagina = $_GET['page'] ?? 'home';

    // 3. VERIFICA se a página solicitada está na nossa lista de permissões
    if (in_array($pagina, $paginas_permitidas)) {
        if ($pagina === 'cadastrar_filme' || $pagina === 'editar_filme') {
            $generos = buscarTodosGeneros(); // Chamando a função do repositório
        }
        // 4. Monta o caminho para o arquivo da view (caminho corrigido)
        $caminho_pagina = "src/view/{$pagina}.php";

        // 5. Verifica se o arquivo realmente existe no caminho
        if (file_exists($caminho_pagina)) {
            include_once $caminho_pagina; // Carrega a página solicitada
        } else {
            // Este erro só deve aparecer para o desenvolvedor, se o arquivo estiver faltando
            echo "<h2>Erro Interno: O arquivo para a página '{$pagina}' não foi encontrado.</h2>";
        }
    } else {
        // 6. Se a página não é permitida, mostra o erro 404
        echo "<h2>Erro 404: Página não encontrada.</h2>";
    }
    ?>
</main>

<?php
require_once 'src/layout/footer.php';
?>