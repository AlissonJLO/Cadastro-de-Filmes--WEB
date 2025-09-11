<div class="form-container">
  <h2>Cadastrar Novo Filme</h2>
  <p>Preencha os campos abaixo para adicionar um novo filme à Cine-Teca.</p>

  <form action="src/service/forms.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="acao" value="cadastrar_filme">

    <div class="form-group">
      <label for="titulo">Título do Filme:</label>
      <input type="text" id="titulo" name="titulo" required>
    </div>

    <div class="form-group">
      <label for="sinopse">Sinopse:</label>
      <textarea id="sinopse" name="sinopse" rows="4" required></textarea>
    </div>

    <div class="form-group">
      <label for="ano">Ano de Lançamento:</label>
      <input type="number" id="ano" name="ano" required>
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
    <div class="form-group form-group-checkbox">
      <input type="checkbox" id="destaque" name="destaque" value="1">
      <label for="destaque">Marcar como Destaque</label>
    </div>

    <div class="form-group">
      <label for="imagem">Pôster do Filme (Imagem):</label>
      <input type="file" id="imagem" name="imagem" accept="image/*" required>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Cadastrar Filme</button>
    </div>
  </form>
</div>