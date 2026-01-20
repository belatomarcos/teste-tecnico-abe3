<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold text-secondary">Gerenciar Cargos</h2>
        <p class="text-muted">Lista de funções cadastradas no sistema.</p>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?= base_url('cargos/adicionar') ?>" class="btn btn-custom btn-green">
            <i class="bi bi-plus-lg"></i> Novo Cargo
        </a>
    </div>
</div>
<div class="card card-custom shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3" style="width: 10%;">ID</th>
                        <th class="py-3">Nome do Cargo</th>
                        <th class="text-end pe-4 py-3" style="width: 20%;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cargos)): ?>
                        <?php foreach ($cargos as $cargo): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-muted">#<?= $cargo->id ?></td>
                                <td class="fw-medium"><?= $cargo->nome ?></td>
                                <td class="text-end pe-4">
                                    <a href="<?= base_url('cargos/ocupantes/'.$cargo->id) ?>"  class="btn btn-sm btn-outline-info me-1" title="Gerenciar Ocupantes">
                                        <i class="bi bi-people-fill"></i>
                                    </a>
                                    <a href="<?= base_url('cargos/editar/'.$cargo->id) ?>" class="btn btn-sm btn-outline-primary me-2" title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="<?= base_url('cargos/excluir/'.$cargo->id) ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Tem certeza que deseja excluir este cargo?');"
                                       title="Excluir">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                Nenhum cargo cadastrado ainda.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>