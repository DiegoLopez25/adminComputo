
<?= $this->extend('templates/admin_template')?>
<?= $this->section('content')?>


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Bienvenido/a <?= session("nombre")?></h1>
    
</div>
<!-- /.container-fluid -->
<?= $this->endSection()?>