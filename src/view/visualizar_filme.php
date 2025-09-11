<?php
// Pega o ID do filme da URL. É importante validar se é um número.
$id_filme = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Se o ID for inválido ou não existir, redireciona ou mostra erro
if (!$id_filme) {
  // Você pode criar uma página de erro ou redirecionar
  echo "<h1>Filme não encontrado!</h1>";
  exit;
}

// Busca os dados completos do filme usando a nova função
$filme = buscarFilmeCompletoPorId($id_filme);

// Se a busca não retornar um filme, exibe uma mensagem
if (!$filme) {
  echo "<h1>Filme não encontrado!</h1>";
  exit;
}
?>

<div class="filme-detalhes-container">
  <div class="poster-container">
    <img src="src/uploads/<?= htmlspecialchars($filme['caminho_imagem']) ?>"
      alt="Pôster de <?= htmlspecialchars($filme['titulo']) ?>">
  </div>

  <div class="info-container">
    <h2><?= htmlspecialchars($filme['titulo']) ?></h2>

    <div class="info-meta">
      <span><strong>Ano:</strong> <?= htmlspecialchars($filme['ano_lancamento']) ?></span>
      <span><strong>Duração:</strong> <?= htmlspecialchars($filme['duracao_minutos']) ?> min</span>
      <span><strong>Gênero:</strong> <?= htmlspecialchars($filme['nome_genero'] ?? 'Não especificado') ?></span>
    </div>

    <div class="info-sinopse">
      <h3>Sinopse</h3>
      <p><?= nl2br(htmlspecialchars($filme['sinopse'])) ?></p>
    </div>

    <div class="info-acoes">
      <h3>Ações</h3>
      <a href="index.php?page=cadastrar_filme&id=<?= $filme['id'] ?>" class="acao-btn btn-editar">Editar Filme</a>
      <a href="src/service/forms.php?acao=deletar_filme&id=<?= $filme['id'] ?>" class="acao-btn btn-excluir"
        onclick="return confirm('Tem certeza que deseja excluir este filme?');">
        Excluir Filme
      </a>
    </div>
  </div>
</div>