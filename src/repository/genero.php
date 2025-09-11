<?php

function cadastrarGenero($nome, $descricao)
{
    $pdo = conectarBd();
    $sql = "INSERT INTO generos (nome, descricao) VALUES (:nome, :descricao)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':nome' => $nome, ':descricao' => $descricao]);
}

function buscarTodosGeneros()
{
    $pdo = conectarBd();
    $stmt = $pdo->query("SELECT * FROM generos ORDER BY nome ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarGeneroPorId($id)
{
    $pdo = conectarBd();
    $sql = "SELECT * FROM generos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function atualizarGenero($id, $nome, $descricao)
{
    $pdo = conectarBd();
    $sql = "UPDATE generos SET nome = :nome, descricao = :descricao WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id, ':nome' => $nome, ':descricao' => $descricao]);
}

function deletarGenero($id)
{
    $pdo = conectarBd();
    $sql = "DELETE FROM generos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}