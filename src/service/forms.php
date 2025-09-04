<?php

require_once '../config/config.php';
require_once '../config/conexao.php';
require_once '../repository/genero.php';
require_once '../repository/filme.php';

define('REDIRECT_GENEROS', '../../index.php?page=generos_listar');

$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';

switch ($acao) {
    case 'cadastrar_genero':
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        // MUDANÇA: Funções em camelCase
        if (cadastrarGenero($nome, $descricao)) {
            $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Gênero cadastrado!'];
        } else {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao cadastrar.'];
        }
        header('Location: ' . REDIRECT_GENEROS);
        exit;

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


    default:

        header('Location: ../../index.php');
        exit;
}
