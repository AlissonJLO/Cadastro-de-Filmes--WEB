<?php
$generos = listarGeneros();
?>

<div class="listagem-container">
  <h2>Listagem de Gêneros</h2>
  <p>Aqui estão todos os gêneros cadastrados na Cine-Teca.</p>

  <table class="tabela-listagem">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($generos && count($generos) > 0): ?>
        <?php foreach ($generos as $genero): ?>
        <tr>
          <td><?= htmlspecialchars($genero['nome']) ?></td>
          <td><?= htmlspecialchars($genero['descricao']) ?></td>
          <td>
            <div class="acoes">
              <a href="index.php?page=editar_genero&id=<?= $genero['id'] ?>" class="acao-btn btn-editar">Editar</a>
              <a href="src/service/forms.php?acao=deletar_genero&id=<?= $genero['id'] ?>" class="acao-btn btn-excluir"
                onclick="return confirm('Tem certeza que deseja excluir este gênero?');">
                Excluir
              </a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" style="text-align:center;">Nenhum gênero cadastrado ainda.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
