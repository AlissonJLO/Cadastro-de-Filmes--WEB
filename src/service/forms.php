<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/config.php';
require_once '../config/conexao.php';
require_once '../repository/genero.php';
require_once '../repository/filme.php';

// DENTRO DE forms.php - CORRIGIDO
define('REDIRECT_GENEROS', '../../index.php?page=listar_generos');
define('REDIRECT_FILMES', '../../index.php?page=listar_filmes');
define('UPLOAD_DIR', '../uploads/');

$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';

// --- FUNÇÕES AUXILIARES (Específicas para Filmes) ---

/**
 * Gerencia o upload da imagem do filme.
 * @param array $arquivo O array $_FILES['imagem'].
 * @param string|null $imagem_atual O caminho da imagem existente (para edições).
 * @return string|false|null O novo caminho da imagem, o caminho antigo ou false em caso de erro.
 */
function gerenciarUploadImagem($arquivo, $imagem_atual_path = null)
{
    if (isset($arquivo) && $arquivo['error'] === UPLOAD_ERR_OK) {
        // Se já existe uma imagem, remove o arquivo antigo
        if ($imagem_atual_path && file_exists(UPLOAD_DIR . basename($imagem_atual_path))) {
            unlink(UPLOAD_DIR . basename($imagem_atual_path));
        }

        $nome_arquivo = uniqid('filme_') . '_' . basename($arquivo['name']);

        // Move para o diretório de uploads
        if (move_uploaded_file($arquivo['tmp_name'], UPLOAD_DIR . $nome_arquivo)) {
            return $nome_arquivo; // RETORNA APENAS O NOME DO ARQUIVO
        }
        return false; // Falha no upload
    }
    // Se não houver novo upload, retorna o nome do arquivo antigo
    return basename($imagem_atual_path);
}

switch ($acao) {



    case 'editar_genero':
        $id = $_POST['id'] ?? 0;
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        if (atualizarGenero($id, $nome, $descricao)) {
            $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Gênero atualizado!'];
        } else {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao atualizar.'];
        }
        header('Location: ' . REDIRECT_GENEROS);
        exit;

    case 'deletar_genero':
        $id = $_GET['id'] ?? 0;
        if (deletarGenero($id)) {
            $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Gênero excluído!'];
        } else {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao excluir.'];
        }
        header('Location: ' . REDIRECT_GENEROS);
        exit;

    case 'cadastrar_filme':
        $titulo = $_POST['titulo'] ?? '';
        $sinopse = $_POST['sinopse'] ?? '';
        $ano = $_POST['ano'] ?? '';
        $duracao = $_POST['duracao'] ?? '';
        $genero_id = $_POST['genero_id'] ?? 0;

        $imagem_path = gerenciarUploadImagem($_FILES['imagem']);

        if ($imagem_path && cadastrarFilme($titulo, $sinopse, $ano, $duracao, $genero_id, $imagem_path, $destaque)) {
            $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Filme cadastrado com sucesso!'];
        } else {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao cadastrar o filme.'];
        }
        header('Location: ' . REDIRECT_FILMES);
        exit;

    case 'editar_filme':
        $id = $_POST['id'] ?? 0;
        $titulo = $_POST['titulo'] ?? '';
        $sinopse = $_POST['sinopse'] ?? '';
        $ano = $_POST['ano'] ?? '';
        $duracao = $_POST['duracao'] ?? '';
        $genero_id = $_POST['genero_id'] ?? 0;
        $imagem_atual = $_POST['imagem_atual'] ?? null;

        $imagem_path = gerenciarUploadImagem($_FILES['imagem'], $imagem_atual);

        if ($imagem_path && atualizarFilme($id, $titulo, $sinopse, $ano, $duracao, $genero_id, $imagem_path)) {
            $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Filme atualizado com sucesso!'];
        } else {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao atualizar o filme.'];
        }
        header('Location: ' . REDIRECT_FILMES);
        exit;

    case 'deletar_filme':
        $id = $_GET['id'] ?? 0;
        $filme = buscarFilmePorId($id);

        if ($filme) {
            $imagem_path = $filme['imagem'];
            if (deletarFilme($id)) {
                if (file_exists($imagem_path)) {
                    unlink($imagem_path);
                }
                $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Filme excluído com sucesso!'];
            } else {
                $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao excluir o filme.'];
            }
        } else {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Filme não encontrado.'];
        }
        header('Location: ' . REDIRECT_FILMES);
        exit;

    default:
        header('Location: ../../index.php');
        exit;
}