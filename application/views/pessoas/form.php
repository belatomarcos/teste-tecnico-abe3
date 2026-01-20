<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom shadow-sm">
            <div class="card-header-gradient gradient-blue"></div>
            <div class="card-body p-5">
                <h3 class="fw-bold mb-4">
                    <?= isset($pessoa) ? 'Editar Colaborador' : 'Novo Colaborador' ?>
                </h3>
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= validation_errors() ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <?php 
                    $url_action = isset($pessoa) ? 'pessoas/editar/'.$pessoa->id : 'pessoas/adicionar';
                ?>
                <form action="<?= base_url($url_action) ?>" method="post">
                    <div class="mb-4">
                        <label for="nome" class="form-label fw-bold text-secondary">Nome Completo</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                            <input type="text" 
                                   class="form-control form-control-lg border-start-0 ps-0" 
                                   id="nome" 
                                   name="nome" 
                                   placeholder="Ex: Marcos Belato"
                                   value="<?= isset($pessoa) ? $pessoa->nome : set_value('nome') ?>" 
                                   required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold text-secondary">E-mail Corporativo</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                            <input type="email" 
                                   class="form-control form-control-lg border-start-0 ps-0" 
                                   id="email" 
                                   name="email" 
                                   placeholder="Ex: marcos@empresa.com"
                                   value="<?= isset($pessoa) ? $pessoa->email : set_value('email') ?>" 
                                   required>
                        </div>
                        <div class="form-text">Usaremos para login e notificações futuras.</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <a href="<?= base_url('pessoas') ?>" class="text-decoration-none text-muted">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-custom btn-blue px-5">
                            <i class="bi bi-check-lg"></i> Salvar Dados
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>