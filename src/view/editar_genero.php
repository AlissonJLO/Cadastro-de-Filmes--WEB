<?php
$id = $_GET['id'];
$nome = $_GET['nome'];
?>
<div class="form-container">
  <h2>Editar Gênero: "<?= $nome ?>" </h2>
  
  <form action="src/service/forms.php" method="POST">

    <input type="hidden" name="acao" value="editar_genero">

    <div class="form-group">
      <input type="hidden" name="id" value="<?= $id ?>">
    </div>

    <div class="form-group">
      <label for="nome">Nome do Gênero:</label>
      <input type="text" id="nome" name="nome" required>
    </div>

    <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea id="descricao" name="descricao" rows="4"></textarea>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Atualizar Gênero</button>
    </div>
    
  </form>
</div>
