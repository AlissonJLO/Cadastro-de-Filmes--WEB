<?php
function cadastrarFilme($titulo, $sinopse, $ano, $duracao, $genero_id, $imagem, $destaque)
{
    $pdo = conectarBd();

    // 2. Adicione a coluna 'destaque' na instrução SQL
    $sql = "INSERT INTO filmes (titulo, sinopse, ano_lancamento, duracao_minutos, genero_id, caminho_imagem, destaque)
            VALUES (:titulo, :sinopse, :ano, :duracao, :genero_id, :imagem, :destaque)";

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':titulo' => $titulo,
        ':sinopse' => $sinopse,
        ':ano' => $ano,
        ':duracao' => $duracao,
        ':genero_id' => $genero_id,
        ':imagem' => $imagem,
        ':destaque' => $destaque
    ]);
}

function listarFilmesComGenero()
{
    $pdo = conectarBd();
    $sql = "SELECT f.*, g.nome AS nome_genero
            FROM filmes f
            LEFT JOIN generos g ON f.genero_id = g.id
            ORDER BY f.titulo ASC";

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function listarFilmesEmDestaque()
{
    $pdo = conectarBd();
    // A query foi ajustada para buscar os dados necessários e limitar o resultado.
    $stmt = $pdo->query("SELECT f.titulo, f.caminho_imagem
                         FROM filmes f
                         WHERE f.destaque = TRUE
                         ORDER BY f.id DESC
                         LIMIT 5");
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

function atualizarFilme($id, $titulo, $sinopse, $ano, $duracao, $genero_id, $imagem, $destaque)
{
    $pdo = conectarBd();
    // Adicione a coluna 'destaque' ao UPDATE
    $sql = "UPDATE filmes SET
                titulo = :titulo,
                sinopse = :sinopse,
                ano_lancamento = :ano,
                duracao_minutos = :duracao,
                genero_id = :genero_id,
                caminho_imagem = :imagem,
                destaque = :destaque
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    // Adicione o bind do :destaque
    return $stmt->execute([
        ':id' => $id,
        ':titulo' => $titulo,
        ':sinopse' => $sinopse,
        ':ano' => $ano,
        ':duracao' => $duracao,
        ':genero_id' => $genero_id,
        ':imagem' => $imagem,
        ':destaque' => $destaque
    ]);
}

function deletarFilme($id)
{
    $pdo = conectarBd();
    $sql = "DELETE FROM filmes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}