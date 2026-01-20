<div class="row justify-content-center">
    <div class="col-md-6">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('historico/gerenciar/'.$pessoa->id) ?>">Voltar ao Histórico</a></li>
                <li class="breadcrumb-item active">Editar Registro</li>
            </ol>
        </nav>
        <div class="card card-custom shadow-sm border-0">
            <div class="card-header-gradient"></div>
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4">Editar Histórico de Cargo</h4>
                <div class="alert alert-light border mb-4">
                    <i class="bi bi-person-circle me-2"></i> 
                    Colaborador: <strong><?= $pessoa->nome ?></strong>
                </div>
                <?php if(validation_errors()): ?>
                    <div class="alert alert-danger small p-2">
                        <?= validation_errors() ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('historico/salvar_edicao/'.$historico->id) ?>" method="post">
                    <input type="hidden" name="pessoa_id" value="<?= $pessoa->id ?>">
                    <input type="hidden" name="historico_id" value="<?= $historico->id ?>">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Cargo</label>
                        <select name="cargo_id" class="form-select" required>
                            <?php foreach($cargos as $cargo): ?>
                                <option value="<?= $cargo->id ?>" 
                                    <?= ($cargo->id == $historico->cargo_id) ? 'selected' : '' ?>>
                                    <?= $cargo->nome ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted">Data Início</label>
                            <input type="date" name="data_inicio" class="form-control" 
                                   value="<?= $historico->data_inicio ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted">Data Fim</label>
                            <input type="date" name="data_fim" class="form-control" 
                                   value="<?= $historico->data_fim ?>">
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-custom btn-blue">
                            Salvar Alterações
                        </button>
                        <a href="<?= base_url('historico/gerenciar/'.$pessoa->id) ?>" class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>