<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold text-secondary">Gerenciar Colaboradores</h2>
        <p class="text-muted">Equipe cadastrada e seus cargos atuais.</p>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?= base_url('pessoas/adicionar') ?>" class="btn btn-custom btn-blue">
            <i class="bi bi-person-plus-fill"></i> Novo Colaborador
        </a>
    </div>
</div>
<div class="card card-custom shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3" style="width: 5%;">ID</th>
                        <th class="py-3">Colaborador</th>
                        <th class="py-3">Contato</th>
                        <th class="py-3">Cargo Atual</th>
                        <th class="text-end pe-4 py-3" style="width: 25%;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pessoas)): ?>
                        <?php foreach ($pessoas as $pessoa): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-muted">#<?= $pessoa->id ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 text-primary me-3">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark"><?= $pessoa->nome ?></h6>
                                            <small class="text-muted">Cadastrado em <?= date('d/m/Y', strtotime($pessoa->created_at)) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-secondary">
                                        <i class="bi bi-envelope me-1"></i> <?= $pessoa->email ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($pessoa->cargo_atual): ?>
                                        <span class="badge bg-success bg-opacity-10 text-white-50 border border-success px-3 py-2 rounded-pill">
                                            <?= $pessoa->cargo_atual ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary bg-opacity-10 text-white-50 border border-secondary px-3 py-2 rounded-pill">
                                            <i class="bi bi-exclamation-circle me-1"></i> Não atribuído
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= base_url('historico/gerenciar/'.$pessoa->id) ?>" 
                                       class="btn btn-sm btn-outline-info me-1" 
                                       title="Ver Histórico de Cargos">
                                        <i class="bi bi-clock-history"></i>
                                    </a>
                                    <a href="<?= base_url('pessoas/editar/'.$pessoa->id) ?>" 
                                       class="btn btn-sm btn-outline-primary me-1" 
                                       title="Editar Dados">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="<?= base_url('pessoas/excluir/'.$pessoa->id) ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Tem certeza? Isso apagará também todo o histórico dessa pessoa.');"
                                       title="Excluir">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-3"></i>
                                Ninguém cadastrado ainda. Clique em "Novo Colaborador".
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-3">
            <?= $paginacao ?>
        </div>
    </div>
</div>