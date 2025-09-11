<?php
$generos = listarGeneros();
?>
<div class="form-container">
  <h2>Cadastrar Novo Gênero</h2>
  <p>Preencha os campos abaixo para adicionar um novo gênero à Cine-Teca.</p>
  
  <form action="salvar_genero.php" method="POST">
    
    <div class="form-group">
      <label for="nome">Nome do Gênero:</label>
      <input type="text" id="nome" name="nome" required>
    </div>

    <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea id="descricao" name="descricao" rows="4"></textarea>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Cadastrar Gênero</button>
    </div>
    
  </form>
</div>
