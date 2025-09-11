<?php
// Chama a função do seu repositório para buscar os filmes com o nome do gênero
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
          <img src="src/uploads/<?= basename(htmlspecialchars($filme['imagem'])) ?>" alt="Pôster"
            class="poster-pequeno">
        </td>
        <td><?= htmlspecialchars($filme['titulo']) ?></td>
        <td><?= htmlspecialchars($filme['ano']) ?></td>
        <td><?= htmlspecialchars($filme['nome_genero']) ?></td>
        <td>
          <div class="acoes">
            <a href="index.php?page=visualizar_filme&id=<?= $filme['id'] ?>" class="acao-btn btn-visualizar">Ver</a>
            <a href="index.php?page=editar_filme&id=<?= $filme['id'] ?>" class="acao-btn btn-editar">Editar</a>
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