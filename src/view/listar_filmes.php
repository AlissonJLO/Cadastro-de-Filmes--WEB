<?php
$filmes = listarFilmesComGenero();
?>

<div class="listagem-container">
  <h2>Listagem de Filmes</h2>
  <p>Aqui estão todos os filmes cadastrados na Cine-Teca.</p>

  <table class="tabela-listagem">
    <thead>
      <tr>
        <th>Pôster</th>
        <th>Título</th>
        <th>Ano</th>
        <th>Gênero</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($filmes && count($filmes) > 0): ?>
      <?php foreach ($filmes as $filme): ?>
      <tr>
        <td>
          <img src="src/uploads/<?= htmlspecialchars($filme['caminho_imagem']) ?>"
            alt="Pôster de <?= htmlspecialchars($filme['titulo']) ?>" class="poster-pequeno">
        </td>
        <td><?= htmlspecialchars($filme['titulo']) ?></td>
        <td><?= htmlspecialchars($filme['ano_lancamento']) ?></td>
        <td><?= htmlspecialchars($filme['nome_genero'] ?? 'Sem Gênero') ?></td>
        <td>
          <div class="acoes">
            <a href="index.php?page=cadastrar_filme&edit=true&id=<?= $filme['id'] ?>"
              class="acao-btn btn-editar">Editar</a>
            <a href="src/service/forms.php?acao=deletar_filme&id=<?= $filme['id'] ?>" class="acao-btn btn-excluir"
              onclick="return confirm('Tem certeza?');">
              Excluir
            </a>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php else: ?>
      <tr>
        <td colspan="5" style="text-align:center;">Nenhum filme cadastrado ainda.</td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>