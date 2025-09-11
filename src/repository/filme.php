<?php
function cadastrarFilme($titulo, $sinopse, $ano, $duracao, $genero_id, $imagem)
{
    $pdo = conectarBd();
    $sql = "INSERT INTO filmes (titulo, sinopse, ano, duracao, genero_id, imagem) VALUES (:titulo, :sinopse, :ano, :duracao, :genero_id, :imagem)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':titulo' => $titulo, ':sinopse' => $sinopse, ':ano' => $ano, ':duracao' => $duracao, ':genero_id' => $genero_id, ':imagem' => $imagem]);
}

function listarFilmesComGenero()
{
    $pdo = conectarBd();
    $stmt = $pdo->query("SELECT f.*, g.nome AS nome_genero FROM filmes f INNER JOIN generos g ON f.genero_id = g.id ORDER BY f.titulo ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function listarFilmesEmDestaque()
{
    $pdo = conectarBd();
    $stmt = $pdo->query("SELECT f.caminho_imagem AS imagem FROM filmes f WHERE f.destaque = TRUE");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarFilmePorId($id)
{
    $pdo = conectarBd();
    $sql = "SELECT * FROM filmes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function atualizarFilme($id, $titulo, $sinopse, $ano, $duracao, $genero_id, $imagem)
{
    $pdo = conectarBd();
    $sql = "UPDATE filmes SET titulo = :titulo, sinopse = :sinopse, ano = :ano, duracao = :duracao, genero_id = :genero_id, imagem = :imagem WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':titulo' => $titulo,
        ':sinopse' => $sinopse,
        ':ano' => $ano,
        ':duracao' => $duracao,
        ':genero_id' => $genero_id,
        ':imagem' => $imagem
    ]);
}

function deletarFilme($id)
{
    $pdo = conectarBd();
    $sql = "DELETE FROM filmes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}