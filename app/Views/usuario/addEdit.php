<?= $this->extend('templates/admin_template')?>
<?= $this->section('content')?>


<!-- Begin Page Content -->
<div class="container-fluid">
    
    <a href="/usuario" class="btn btn-primary mb-4"><i class="fa fa-arrow-left"></i> Regresar a la lista</a>
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
        <div class="d-none d-sm-inline-block"><a href="<?=site_url('/dashboard')?>">Home</a> / <a href="<?=site_url('/usuario')?>">Lista <?=$title?></a> / <a>Nuevo <?=$title?></a></div> 
    </div>

    <div class="col-md-12 mt-3">
				<form action="<?=base_url('usuario/addEdit/'.$usuarios['id']); ?>" autocomplete="true" method="post" id="frmUsuario">
					<div class="card card-outline card-<?= $color?>">
						<div class="card-header bg-<?= $color?>">
							<h3 class="card-title text-white"><?= $title?></h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
										<label for="">nombre:</label>
										<input value="<?= isset($usuarios['nombre']) ? $usuarios['nombre']:null; ?>" type="text" name="nombre" id="nombre" class="form-control">
									</div>
                                    <div class="form-group">
										<label for="">apellido:</label>
										<input value="<?= isset($usuarios['apellido']) ? $usuarios['apellido']:null; ?>" type="text" name="apellido" id="apellido" class="form-control">
									</div>
                                    <div class="form-group">
										<label for="">usuario:</label>
										<input value="<?= isset($usuarios['usuario']) ? $usuarios['usuario']:null; ?>" type="text" name="usuario" id="usuario" class="form-control">
									</div>
                                    <div class="form-group">
                                    <?php

                                        if(isset($usuarios['id_rol'])){
                                            echo '<label for="">Rol:</label>
                                            <select name="id_rol" id="id_rol" class="form-control">
                                            '.'<option value="'.$usuarios['id_rol'].'" selected>'.$rol[0]->nombre.'</option>';

                                            foreach($roles as $r){
                                                if($r["id"] != $usuarios["id_rol"]){
                                                    echo '<option value="'.$r["id"].'">'.$r["nombre"].'</option>';
                                                }
                                                
                                            }
                                            echo '</select>';
                                            
                                        }else if(!isset($usuarios['id_rol'])){
                                            echo '<label for="">Rol:</label>
                                            <select  name="id_rol" id="id_rol" class="form-control">
                                            '.'<option value="" selected disabled>Seleccione un Rol</option>';

                                            foreach($roles as $r){
                                                echo '<option value="'.$r["id"].'">'.$r["nombre"].'</option>';
                                            }
                                            echo '</select>';
                                        }                               			
                                        ?>
                                    </div>
								</div>
								<div class="col-md-6">
                                    <div class="form-group">
										<label for="">email:</label>
										<input value="<?= isset($usuarios['email']) ? $usuarios['email']:null; ?>" type="email" name="email" id="email" class="form-control">
									</div>
                                    <div class="form-group">
										<label for="">dui:</label>
										<input value="<?= isset($usuarios['dui']) ? $usuarios['dui']:null; ?>" type="text" name="dui" id="dui" class="form-control">
									</div>
                                    <div class="form-group">
										<label for="">contrase&ntilde;a:</label>
										<input value="<?= isset($usuarios['password']) ? $usuarios['password']:null; ?>" type="text" name="password" id="password" class="form-control">
									</div>

                                    <div class="form-group">
                                    <?php

                                    if(isset($usuarios['id_estado'])){
                                        echo '<label for="estado">Estado:</label>
                                        <select value="" name="id_estado" id="id_estado" class="form-control">
                                        '.'<option value="'.$usuarios['id_estado'].'" selected>'.$std[0]->estado.'</option>';

                                        foreach($estados as $estado){
                                            if($estado["id"] != $usuarios["id_estado"]){
                                                echo '<option value="'.$estado["id"].'">'.$estado["estado"].'</option>';
                                            }
                                            
                                        }
                                        echo '</select>';
                                        ;
                                    }                                  			
                                    ?>
                                    </div>
                                    <div class="form-group">
										<input type="hidden" name="id" id="id" value="<?= $usuarios['id']?>" class="form-control">
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