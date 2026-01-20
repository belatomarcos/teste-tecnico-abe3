<div class="row mb-5">
    <div class="col-md-8">
        <h2 class="fw-bold text-dark">Painel de Controle</h2>
        <p class="text-muted">Selecione uma opção abaixo para gerenciar o quadro de colaboradores.</p>
    </div>
    <div class="col-md-4 text-end align-self-center">
        <span class="badge bg-secondary p-2">v1.0.0</span>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card card-custom shadow-sm h-100">
            <div class="card-header-gradient gradient-blue"></div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light p-3 rounded-circle text-primary me-3">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                    <h4 class="card-title mb-0">Colaboradores</h4>
                </div>
                <p class="card-text text-muted">Cadastre novos funcionários, atualize dados cadastrais e visualize a equipe ativa.</p>
                <a href="<?= base_url('pessoas') ?>" class="btn btn-custom btn-blue mt-3">
                    Acessar Gestão
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card card-custom shadow-sm h-100">
            <div class="card-header-gradient gradient-green"></div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light p-3 rounded-circle text-success me-3">
                        <i class="bi bi-briefcase-fill fs-4"></i>
                    </div>
                    <h4 class="card-title mb-0">Cargos & Funções</h4>
                </div>
                <p class="card-text text-muted">Gerencie a hierarquia da empresa, adicione novos cargos e edite nomenclaturas.</p>
                <a href="<?= base_url('cargos') ?>" class="btn btn-custom btn-green mt-3">
                    Acessar Cargos
                </a>
            </div>
        </div>
    </div>
</div>