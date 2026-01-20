<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABE3 - Gestão Interna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body> <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-5">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= base_url() ?>">
        <i class="bi bi-layers-fill"></i> ABE3
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('pessoas') ?>">Colaboradores</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('cargos') ?>">Cargos</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container container-principal">