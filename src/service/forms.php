<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/config.php';
require_once '../config/conexao.php';
require_once '../repository/genero.php';
require_once '../repository/filme.php';

define('REDIRECT_GENEROS', '../../index.php?page=listar_generos');
define('REDIRECT_FILMES', '../../index.php?page=listar_filmes');
define('UPLOAD_DIR', '../uploads/');

$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';

/**
 * Gerencia o upload da imagem do filme.
 * @param array $arquivo O array $_FILES['imagem'].
 * @param string|null $imagem_atual O nome do arquivo da imagem existente.
 * @return string|false O novo nome do arquivo ou o nome do arquivo antigo. Retorna false em caso de erro de upload.
 */
function gerenciarUploadImagem($arquivo, $imagem_atual = null)
{

    if (isset($arquivo) && $arquivo['error'] === UPLOAD_ERR_OK && !empty($arquivo['name'])) {

        $caminho_antigo = $imagem_atual ? UPLOAD_DIR . $imagem_atual : null;


        if ($caminho_antigo && file_exists($caminho_antigo)) {
            unlink($caminho_antigo);
        }

        $nome_arquivo = uniqid('filme_') . '_' . basename($arquivo['name']);
        $novo_caminho = UPLOAD_DIR . $nome_arquivo;

        if (move_uploaded_file($arquivo['tmp_name'], $novo_caminho)) {
            return $nome_arquivo;
        } else {
            return false;
        }
    }
    return $imagem_atual;
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
        $destaque = isset($_POST['destaque']) ? 1 : 0;

        $nome_imagem = gerenciarUploadImagem($_FILES['imagem']);

        if ($nome_imagem !== false) {
            if (cadastrarFilme($titulo, $sinopse, $ano, $duracao, $genero_id, $nome_imagem, $destaque)) {
                $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Filme cadastrado com sucesso!'];
            } else {
                $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao cadastrar o filme.'];
            }
        } else {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro no upload da imagem.'];
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
        $destaque = isset($_POST['destaque']) ? 1 : 0;

        $nome_imagem = gerenciarUploadImagem($_FILES['imagem'], $imagem_atual);

        if ($nome_imagem !== false) {
            if (atualizarFilme($id, $titulo, $sinopse, $ano, $duracao, $genero_id, $nome_imagem, $destaque)) {
                $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Filme atualizado com sucesso!'];
            } else {
                $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao atualizar o filme.'];
            }
        } else {
            // Se gerenciarUploadImagem retornou false, significa que houve um erro no upload
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Ocorreu um erro com o upload da nova imagem.'];
        }
        header('Location: ' . REDIRECT_FILMES);
        exit;

    case 'deletar_filme':
        $id = $_GET['id'] ?? 0;
        $filme = buscarFilmePorId($id);

        if ($filme) {
            $imagem_path = $filme['caminho_imagem'];

            if (deletarFilme($id)) {

                if ($imagem_path && file_exists(UPLOAD_DIR . $imagem_path)) {
                    unlink(UPLOAD_DIR . $imagem_path);
                }
                $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Filme excluído com sucesso!'];
            } else {
                $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao excluir o filme do banco de dados.'];
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