<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom shadow-sm">
            <div class="card-header-gradient gradient-blue"></div>
            
            <div class="card-body p-5">
                <h3 class="fw-bold mb-4">
                    <?= isset($cargo) ? 'Editar Cargo' : 'Novo Cargo' ?>
                </h3>

                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= validation_errors() ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php 
                    $url_action = isset($cargo) ? 'cargos/editar/'.$cargo->id : 'cargos/adicionar';
                ?>

                <form action="<?= base_url($url_action) ?>" method="post">
                    
                    <div class="mb-4">
                        <label for="nome" class="form-label fw-bold text-secondary">Nome do Cargo</label>
                        <input type="text" 
                               class="form-control form-control-lg" 
                               id="nome" 
                               name="nome" 
                               placeholder="Ex: Desenvolvedor Senior"
                               value="<?= isset($cargo) ? $cargo->nome : set_value('nome') ?>" 
                               required>
                        <div class="form-text">O nome deve ser único e descritivo.</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <a href="<?= base_url('cargos') ?>" class="text-decoration-none text-muted">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-custom btn-blue px-5">
                            <i class="bi bi-check-lg"></i> Salvar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>