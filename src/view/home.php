<?php
// Busca os filmes em destaque utilizando a função do repositório
$filmes_em_destaque = listarFilmesEmDestaque();
?>

<main class="conteudo-principal">
  <section class="destaque">
    <h2>Destaques da Semana</h2>

    <div class="destaque-container">
      <?php // Verifica se a lista de filmes não está vazia 
      ?>
      <?php if ($filmes_em_destaque && count($filmes_em_destaque) > 0): ?>

      <?php // Inicia o loop para exibir cada filme em destaque 
        ?>
      <?php foreach ($filmes_em_destaque as $filme): ?>
      <div class="destaque-item">
        <img src="src/uploads/<?= htmlspecialchars($filme['caminho_imagem']) ?>"
          alt="Pôster de <?= htmlspecialchars($filme['titulo']) ?>">
        <h3><?= htmlspecialchars($filme['titulo']) ?></h3>
      </div>
      <?php endforeach; ?>

      <?php else: ?>
      <?php // Mensagem exibida se não houver filmes marcados como destaque 
        ?>
      <p style="text-align: center; width: 100%;">Nenhum filme em destaque no momento.</p>
      <?php endif; ?>
    </div>
  </section>
</main>