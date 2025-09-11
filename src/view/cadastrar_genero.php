<?php
$generos = listarGeneros();
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Cadastrar Novo Filme</h2>
        </div>
        <div class="card-body">
            <form action="src/controller/gerenciador_controller.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="acao" value="cadastrar_filme">

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="titulo" class="form-label">Título do Filme</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ex: A Origem" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="genero_id" class="form-label">Gênero</label>
                        <select id="genero_id" name="genero_id" class="form-select" required>
                            <option value="" selected disabled>Selecione um gênero</option>
                            <?php foreach ($generos as $genero): ?>
                            <option value="<?= $genero['id'] ?>"><?= htmlspecialchars($genero['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="sinopse" class="form-label">Sinopse</label>
                    <textarea class="form-control" id="sinopse" name="sinopse" rows="4" placeholder="Descreva a trama do filme."></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ano" class="form-label">Ano de Lançamento</label>
                        <input type="number" class="form-control" id="ano" name="ano" min="1895" max="<?= date('Y') + 1 ?>" placeholder="Ex: 2010" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="duracao" class="form-label">Duração (em minutos)</label>
                        <input type="number" class="form-control" id="duracao" name="duracao" min="1" placeholder="Ex: 148" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="imagem" class="form-label">Pôster do Filme</label>
                    <input type="file" class="form-control" id="imagem" name="imagem" accept="image/png, image/jpeg, image/webp" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="index.php?page=filmes_listar" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Cadastrar Filme
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
