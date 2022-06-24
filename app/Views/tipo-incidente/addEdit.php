<?= $this->extend('templates/admin_template')?>
<?= $this->section('content')?>


<!-- Begin Page Content -->
<div class="container-fluid">
    
    <a href="/centro-computo" class="btn btn-primary mb-4"><i class="fa fa-arrow-left"></i> Regresar a la lista</a>
    <?php if ($hasValidationErrors): ?>
		<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			<h5><i class="icon fas fa-info"></i>Tiene algunos errores de validacion</h5>
			<ul>
				<?php foreach($errors as $error) :?>
				<li><?= esc($error)?></li>
				<?php endforeach ?>
			</ul>
		</div>
	<?php endif ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between col-sm-12 col-xs-12">
        <h1 class="h3 text-gray-800 float-left "><?=$title?></h1>
        <div class="d-none d-sm-inline-block"><a href="<?=site_url('/dashboard')?>">Home</a> / <a href="<?=site_url('/tipo-incidente')?>">Lista <?=$title?></a> / <a>Nuevo <?=$title?></a></div> 
    </div>

    <div class="col-md-12 mt-3">
				<form action="<?=base_url('tipo-incidente/addEdit/'.$tipoIncidente['id']); ?>" autocomplete="true" method="post" id="frmCliente">
					<div class="card card-outline card-<?= $color?>">
						<div class="card-header bg-<?= $color?>">
							<h3 class="card-title text-white"><?= $title?></h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									
									<div class="form-group">
										<label for="">nombre:</label>
										<input value="<?= isset($tipoIncidente['nombre']) ? $tipoIncidente['nombre']:null; ?>" type="text" name="nombre" id="nombre" class="form-control">
									</div>
                                    <div class="form-group">
										<input type="hidden" name="id" id="id" value="<?= $tipoIncidente['id']?>" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
                                    <label for="">descripcion:</label>
										<input value="<?= isset($tipoIncidente['descripcion']) ? $tipoIncidente['descripcion']:null; ?>" type="text" name="descripcion" id="descripcion" class="form-control">
									</div>			
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" id="btnGuardar" onclick="sendForm()" class=" btn btn-<?= $color?>">
							<i class="<?= $icono?>"></i> <?= $accion?> 
							</button>
						</div>
					</div>
				</form>
			</div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection()?>