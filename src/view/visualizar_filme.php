<?php

$id_filme = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);


if (!$id_filme) {

  echo "<h1>Filme não encontrado!</h1>";
  exit;
}


$filme = buscarFilmeCompletoPorId($id_filme);

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