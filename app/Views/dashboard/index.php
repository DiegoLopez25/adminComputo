
<?= $this->extend('templates/admin_template')?>
<?= $this->section('content')?>


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Bienvenido/a <?= session("nombre")." ".session("apellido")?></h1>
<?php if (session()->getFlashdata('alert-type')): ?>
                <div class="col-12 mt-2">
                    <div class="alert <?= session()->getFlashdata('alert-type'); ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <h5><i class="icon fas fa-info"></i> <?= session()->getFlashdata('alert-title'); ?></h5>
                        <?= session()->getFlashdata('alert-message'); ?>
                    </div>
                </div>
                    <?php endif ?>
</div>
<!-- /.container-fluid -->
<?= $this->endSection()?>