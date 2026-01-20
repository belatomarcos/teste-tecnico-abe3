<nav aria-label="breadcrumb" class="mb-4">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('pessoas') ?>">Colaboradores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gerenciar Histórico</li>
  </ol>
</nav>
<?php if($this->session->flashdata('sucesso')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= $this->session->flashdata('sucesso') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-custom shadow-sm mb-4">
            <div class="card-body text-center p-4">
                <div class="bg-light rounded-circle p-3 d-inline-block text-primary mb-3">
                    <i class="bi bi-person-fill fs-1"></i>
                </div>
                <h4 class="fw-bold mb-1"><?= $pessoa->nome ?></h4>
                <p class="text-muted mb-0"><?= $pessoa->email ?></p>
                <small class="text-secondary">ID: #<?= $pessoa->id ?></small>
            </div>
        </div>
        <div class="card card-custom shadow-sm border-0">
            <div class="card-header-gradient gradient-blue"></div>
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-plus-circle me-2"></i>Atribuir Cargo</h5>
                <?php if(validation_errors()): ?>
                    <div class="alert alert-danger small p-2">
                        <?= validation_errors() ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('historico/adicionar/'.$pessoa->id) ?>" method="post">
                    <input type="hidden" name="pessoa_id" value="<?= $pessoa->id ?>">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Cargo</label>
                        <select name="cargo_id" class="form-select" required>
                            <option value="">Selecione...</option>
                            <?php foreach($cargos as $cargo): ?>
                                <option value="<?= $cargo->id ?>" <?= set_select('cargo_id', $cargo->id) ?>>
                                    <?= $cargo->nome ?>
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
                        <div class="form-text small">Deixe em branco se for o cargo atual.</div>
                    </div>
                    <button type="submit" class="btn btn-custom btn-blue w-100 mt-2">
                        Salvar Cargo
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-custom shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Linha do Tempo Profissional</h5>
            </div>
            <div class="card-body px-4">
                <?php if(!empty($historico)): ?>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="text-secondary small">
                                <tr>
                                    <th>Cargo Ocupado</th>
                                    <th>Período</th>
                                    <th>Status</th>
                                    <th class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($historico as $h): ?>
                                    <?php 
                                        $hoje = date('Y-m-d');
                                        $inicio = $h->data_inicio;
                                        $fim = $h->data_fim;
                                        if ($inicio > $hoje) {
                                            $status_label = 'Agendado';
                                            $badge_class = 'bg-info text-dark';
                                            $row_class = '';
                                            $status_tipo = 'futuro';
                                        } elseif ($fim != null && $fim <= $hoje) {
                                            $status_label = 'Encerrado';
                                            $badge_class = 'bg-secondary';
                                            $row_class = 'text-muted';
                                            $status_tipo = 'passado';
                                        } else {
                                            $status_label = 'Ativo';
                                            $badge_class = 'bg-success';
                                            $row_class = 'bg-success bg-opacity-10';
                                            $status_tipo = 'ativo';
                                        }
                                    ?>
                                    <tr class="<?= $row_class ?>">
                                        <td>
                                            <span class="fw-bold d-block text-dark"><?= $h->nome_cargo ?></span>
                                            <?php if($status_tipo == 'ativo'): ?>
                                                <small class="text-success fw-bold">Cargo Atual</small>
                                            <?php elseif($status_tipo == 'futuro'): ?>
                                                <small class="text-info fw-bold">Inicia em breve</small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="small">
                                                <i class="bi bi-calendar-event me-1"></i>
                                                <?= date('d/m/Y', strtotime($h->data_inicio)) ?>
                                                até 
                                                <?= $h->data_fim ? date('d/m/Y', strtotime($h->data_fim)) : 'Presente' ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge <?= $badge_class ?>"><?= $status_label ?></span>
                                        </td>
                                       <td class="text-end">
                                            <?php if($status_tipo == 'ativo'): ?>
                                                <a href="<?= base_url('historico/encerrar/'.$h->id.'/'.$pessoa->id) ?>" class="btn btn-sm btn-outline-warning" onclick="return confirm('Deseja encerrar este cargo hoje?');" title="Encerrar Contrato Neste Cargo">
                                                    <i class="bi bi-stop-circle-fill"></i> Encerrar
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                            <a href="<?= base_url('historico/editar/'.$h->id) ?>" class="btn btn-sm btn-outline-primary ms-1" title="Editar Datas/Cargo">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="<?= base_url('historico/excluir/'.$h->id.'/'.$pessoa->id) ?>" class="btn btn-sm text-danger ms-2" onclick="return confirm('Tem certeza? Isso apagará este registro do histórico.');" title="Excluir Registro">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-clock-history fs-1 d-block mb-3 opacity-50"></i>
                        <p>Nenhum histórico registrado.</p>
                        <small>Use o formulário ao lado para atribuir o primeiro cargo.</small>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>