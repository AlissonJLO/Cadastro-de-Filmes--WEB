<?php
$is_edit = isset($filme_para_edicao) && $filme_para_edicao;

$titulo_pagina = $is_edit ? 'Editar Filme' : 'Cadastrar Novo Filme';
$texto_botao = $is_edit ? 'Atualizar' : 'Cadastrar Filme';
$acao_form = $is_edit ? 'editar_filme' : 'cadastrar_filme';


$id_filme = $filme_para_edicao['id'] ?? '';
$titulo_filme = $filme_para_edicao['titulo'] ?? '';
$sinopse_filme = $filme_para_edicao['sinopse'] ?? '';
$ano_filme = $filme_para_edicao['ano'] ?? '';
$duracao_filme = $filme_para_edicao['duracao'] ?? '';
$genero_id_filme = $filme_para_edicao['genero_id'] ?? '';
$destaque_filme = $filme_para_edicao['destaque'] ?? false;
$imagem_atual = $filme_para_edicao['caminho_imagem'] ?? '';
?>

<div class="form-container">
  <h2><?= $titulo_pagina ?></h2>
  <p>Preencha os campos abaixo para <?= strtolower($texto_botao) ?> as informações do filme.</p>

  <form action="src/service/forms.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="acao" value="<?= $acao_form ?>">
    <input type="hidden" name="id" value="<?= $id_filme ?>">
    <input type="hidden" name="imagem_atual" value="<?= $imagem_atual ?>">

    <div class="form-group">
      <label for="titulo">Título do Filme:</label>
      <input type="text" id="titulo" name="titulo" required value="<?= htmlspecialchars($titulo_filme) ?>">
    </div>

    <div class="form-group">
      <label for="sinopse">Sinopse:</label>
      <textarea id="sinopse" name="sinopse" rows="4" required><?= htmlspecialchars($sinopse_filme) ?></textarea>
    </div>

    <div class="form-group">
      <label for="ano">Ano de Lançamento:</label>
      <input type="number" id="ano" name="ano" required value="<?= htmlspecialchars($ano_filme) ?>">
    </div>

    <div class="form-group">
      <label for="duracao">Duração (minutos):</label>
      <input type="number" id="duracao" name="duracao" required value="<?= htmlspecialchars($duracao_filme) ?>">
    </div>

    <div class="form-group">
      <label for="genero_id">Gênero:</label>
      <select id="genero_id" name="genero_id" required>
        <option value="">Selecione um gênero</option>
        <?php foreach ($generos as $genero): ?>
        <option value="<?= $genero['id'] ?>" <?= ($genero['id'] == $genero_id_filme) ? 'selected' : '' ?>>
          <?= htmlspecialchars($genero['nome']) ?>
        </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group form-group-checkbox">
      <input type="checkbox" id="destaque" name="destaque" value="1" <?= $destaque_filme ? 'checked' : '' ?>>
      <label for="destaque">Marcar como Destaque</label>
    </div>

    <div class="form-group">
      <label for="imagem">Pôster do Filme (Nova Imagem):</label>
      <input type="file" id="imagem" name="imagem" accept="image/*">
      <?php if ($is_edit && $imagem_atual): ?>
      <p style="margin-top: 10px;">Imagem atual:</p>
      <img src="src/uploads/<?= htmlspecialchars($imagem_atual) ?>" alt=" atual"
        style="max-width: 100px; border-radius: 5px;">
      <?php endif; ?>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary"><?= $texto_botao ?></button>
    </div>
  </form>
</div>