<?php
$generos = buscarGeneros($pdo);
?>

<div class="form-container">
  <h2>Cadastrar Novo Filme</h2>
  <p>Preencha os campos abaixo para adicionar um novo filme à Cine-Teca.</p>

  <form action="salvar_filme.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="titulo">Título do Filme:</label>
      <input type="text" id="titulo" name="titulo" required>
    </div>

    <div class="form-group">
      <label for="sinopse">Sinopse:</label>
      <textarea id="sinopse" name="sinopse" rows="4" required></textarea>
    </div>

    <div class="form-group">
      <label for="ano_lancamento">Ano de Lançamento:</label>
      <input type="number" id="ano_lancamento" name="ano_lancamento" required>
    </div>

    <div class="form-group">
      <label for="diretor">Diretor:</label>
      <input type="text" id="diretor" name="diretor" required>
    </div>

    <div class="form-group">
      <label for="duracao">Duração (minutos):</label>
      <input type="number" id="duracao" name="duracao" required>
    </div>

    <div class="form-group">
      <label for="genero_id">Gênero:</label>
      <select id="genero_id" name="genero_id" required>
        <option value="">Selecione um gênero</option>
        <?php foreach ($generos as $genero): ?>
        <option value="<?= $genero['id'] ?>"><?= htmlspecialchars($genero['nome']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label for="poster">Pôster do Filme (Imagem):</label>
      <input type="file" id="poster" name="poster" accept="image/png, image/jpeg, image/webp" required>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Cadastrar Filme</button>
    </div>
  </form>
</div>