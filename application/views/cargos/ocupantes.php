<nav aria-label="breadcrumb" class="mb-4">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('cargos') ?>">Cargos</a></li>
    <li class="breadcrumb-item active">Gerenciar Ocupantes</li>
  </ol>
</nav>
<div class="card card-custom shadow-sm mb-4">
    <div class="card-body p-4 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <div class="bg-warning bg-opacity-10 rounded-circle p-3 text-warning me-3">
                <i class="bi bi-briefcase-fill fs-3" style="color: var(--brand-yellow)"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-0"><?= $cargo->nome ?></h2>
                <p class="text-muted mb-0">Gestão de colaboradores vinculados a esta função.</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-custom shadow-sm h-100">
            <div class="card-header-gradient"></div>
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-person-plus-fill me-2"></i>Adicionar Colaborador</h5>
                <?php if(validation_errors()): ?>
                    <div class="alert alert-danger small p-2"><?= validation_errors() ?></div>
                <?php endif; ?>
                <?php if($this->session->flashdata('sucesso')): ?>
                    <div class="alert alert-success small p-2"><?= $this->session->flashdata('sucesso') ?></div>
                <?php endif; ?>
                <form action="<?= base_url('cargos/adicionar_ocupante/'.$cargo->id) ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Colaborador</label>
                        <select name="pessoa_id" class="form-select" required>
                            <option value="">Selecione...</option>
                            <?php foreach($pessoas as $p): ?>
                                <option value="<?= $p->id ?>" <?= set_select('pessoa_id', $p->id) ?>>
                                    <?= $p->nome ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Data Início</label>
                        <input type="date" name="data_inicio" class="form-control" value="<?= set_value('data_inicio') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Data Fim (Opcional)</label>
                        <input type="date" name="data_fim" class="form-control" value="<?= set_value('data_fim') ?>">
                    </div>
                    <button type="submit" class="btn btn-custom btn-blue w-100 mt-2">Vincular</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-custom shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Histórico de Ocupantes</h5>
            </div>
            <div class="card-body px-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="text-secondary small">
                            <tr>
                                <th>Colaborador</th>
                                <th>Período</th>
                                <th>Status</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($ocupantes)): ?>
                                <?php foreach($ocupantes as $oc): ?>
                                    <?php 
                                        $hoje = date('Y-m-d');
                                        // Reutilizando a lógica de status
                                        if ($oc->data_inicio > $hoje) {
                                            $status_label = 'Agendado'; $bg = 'bg-info text-dark';
                                        } elseif ($oc->data_fim != null && $oc->data_fim <= $hoje) {
                                            $status_label = 'Encerrado'; $bg = 'bg-secondary';
                                        } else {
                                            $status_label = 'Ativo'; $bg = 'bg-success';
                                        }
                                    ?>
                                    <tr>
                                        <td class="fw-bold"><?= $oc->nome_pessoa ?></td>
                                        <td class="small text-muted">
                                            <?= date('d/m/Y', strtotime($oc->data_inicio)) ?> até 
                                            <?= $oc->data_fim ? date('d/m/Y', strtotime($oc->data_fim)) : 'Presente' ?>
                                        </td>
                                        <td><span class="badge <?= $bg ?>"><?= $status_label ?></span></td>
                                        <td class="text-end">
                                            <a href="<?= base_url('historico/gerenciar/'.$oc->pessoa_id) ?>" 
                                               class="btn btn-sm btn-outline-primary"
                                               title="Ver Perfil Completo">
                                                <i class="bi bi-arrow-right"></i> Ver
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        Ninguém ocupou este cargo ainda.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>