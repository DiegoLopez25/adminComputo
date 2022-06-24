<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>


<!-- Begin Page Content -->
<div class="container-fluid">
        <?php if (session()->getFlashdata('alert-type')): ?>
                <div class="col-12 mt-2">
                    <div class="alert <?= session()->getFlashdata('alert-type'); ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <h5><i class="icon fas fa-info"></i> <?= session()->getFlashdata('alert-title'); ?></h5>
                        <?= session()->getFlashdata('alert-message'); ?>
                    </div>
                </div>
                    <?php endif ?>
                
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between col-sm-12 col-xs-12">
        <h1 class="h3 text-gray-800 float-left "><?=$title?></h1>
        <div class="d-none d-sm-inline-block"><a href="<?= site_url('/dashboard') ?>">Home</a> / <a>Lista <?=$title?></a></div>
    </div>
    <div class="row mb-3 col-sm-12 col-xs-12">
        <div class="col-md-3 col-sm-12 offset-md-9">
            <a data-toggle="modal" data-target="#modal-new" class="btn btn-success float-right ml-0"><i class="fas fa-plus"></i> Nuevo <?=$title?></a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="font-weight-bold text-primary">Lista <?=$title?></h4>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tbl_lista" class="table table-hover table-bordered dataTable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>tipo incidente</th>
                                                <th>Fecha / hora</th>
                                                <th>Estado incidente</th>
                                                <th>usuario</th>
                                                <th>Centro de computo</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($incidentes) :?>
                                                <?php foreach ($incidentes as $I) : ?>
                                                    <tr>
                                                        <td><?php echo $I->id; ?></td>
                                                        <td><?php echo $I->tipo_incidente; ?></td>
                                                        <td><?php echo $I->fecha_hora_incidente; ?></td>
                                                        <td><span class="<?php if($I->estado_incidente=="Activo"){ echo 'bg-danger';}else{ echo 'bg-success';}?> text-white rounded"><?php echo $I->estado_incidente; ?></span></td>
                                                        <td><?php echo $I->usuario; ?></td>
                                                        <td><?php echo $I->centro_computo; ?></td>
                                                        <td class="project-actions ">
                                                        <a data-toggle="modal" data-target="#modal-<?php echo $I->id; ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                                            <a data-toggle="modal" data-target="#modal-view-<?php echo $I->id; ?>"  class="btn btn-info btn-sm"> <i class=" text-white fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add Modal-->
        <form action="<?= base_url("/incidente/addEdit/0"); ?>" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="modal-new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title text-white" id="modal-new">Nuevo <?=$title?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label for="" class="col-form-label">descripcion:</label>
                                    <textarea type="text" name="descripcion" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Subir foto:</label>
                                    <div class="custom-file">
                                                            
                                        <input type="file" class="custom-file-input" name="imagen" id="imagen">
                                        <label class="custom-file-label" for="customFile">Subir archivo...</label>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tipoIncidente">tipo de incidente:</label>
                                    <select name="id_tipo_incidente" id="id_tipo_incidente" class="form-control">
                                        <option value="" selected disabled>Seleccione...</option>

                                        <?php foreach($tipoIncidentes as $ti){?>
                                            <option value="<?=$ti['id']?>"><?=$ti["nombre"]?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_centro_computo">centro de computo:</label>
                                    <select name="id_centro_computo" id="id_centro_computo" class="form-control">
                                        <option value="" selected disabled>Seleccione</option>

                                        <?php foreach($centroComputo as $cc){?>
                                            <option value="<?=$cc['id']?>"><?=$cc["nombre"]?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipoIncidente">Dispositivo:</label>
                                    <select name="id_dispositivo" id="id_dispositivo" class="form-control">
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                            <input type="hidden" name="id" id="id" value="<?= $inc['id']?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="<?= session()->id?>" name="id_usuario"></input>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--End add Modal-->
        <!-- result Modal-->
        <?php foreach($resolucion as $re):?>
        <form action="<?= base_url("/incidente/addEdit/".$re->id); ?>" method="post" enctype="multipart/form-data" id="frmResolucion">
            <div class="modal fade" id="modal-<?=$re->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title text-white">Resolucion de <?=$title?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>   
                        </div>
                        <div class="modal-body">
                        <div class="alert alert-warning alert-dismissible">
                            <h6><i class="icon fa fa-exclamation-triangle"></i> Una vez dado resolucion al incidente este no puede ser modificado</h6>

                        </div>
                                <div class="form-group">
                                    <label for="" class="col-form-label">Incidente</label>
                                    <input type="text" name="tipo_incidente" value="<?php if(property_exists($re,'descripcion')){echo $re->descripcion;}else{ echo null;}?>" class="form-control" disabled></input>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-form-label">Mensaje de Resolucion:</label>
                                    <textarea type="text" name="mensaje_resolucion" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="imagen_resolucion">foto resolucion: </label>
                                    <div class="custom-file">
                                                            
                                        <input type="file" class="custom-file-input" name="imagen_resolucion" id="imagen_resolucion">
                                        <label class="custom-file-label" for="customFile">Subir archivo...</label>
                                    </div>
                                </div>
                                <div class="form-group">
										<input type="hidden" name="id" id="id" value="<?= $re->id?>" class="form-control">
								</div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-warning" type="submit"><i class="far fa-save"></i>Dar Resolucion</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php endforeach; ?>
        <!--End add Modal-->
        <!-- View Modal-->
        <?php foreach($resolucion as $re):?>
            <div class="modal fade" id="modal-view-<?php echo $re->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title text-white" id="modal-new">Detalle <?=$title?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                Incidente
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="">Foto Evidencia:</label>
                                                    <img class="img-fluid rounded"  src="<?=base_url().$re->foto_evidencia?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tipo de incidente:</label>
                                                    <input type="text" class="form-control " disabled value="<?=$re->tipo_incidente?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Descripcion:</label>
                                                    <textarea type="text" class="form-control" disabled><?=$re->descripcion?>
                                                    </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Fecha / hora de incidente:</label>
                                                    <input type="text" class="form-control " disabled value="<?=$re->fecha_hora_incidente?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Dispositivo:</label>
                                                    <input type="text" class="form-control " disabled value="<?=$re->dispositivo?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Notificacion de usuario:</label>
                                                    <input type="text" class="form-control " disabled value="<?=$re->usuario?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Estado de incidente:</label>
                                                    <input type="text" class="form-control <?php if($re->estado_incidente=="Activo"){ echo 'bg-danger';}else{ echo 'bg-success';}?> rounded text-white" disabled value="<?=$re->estado_incidente?>">
                                                </div>

                                                
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                                <div class="card-header">
                                                    Resolucion
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="">Foto Evidencia:</label>
                                                        <img class="img-fluid rounded" src="<?=base_url().$re->foto_resolucion?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Mensaje resolucion:</label>
                                                        <textarea type="text" class="form-control " disabled><?php if($re->mensaje_resolucion != ""){echo $re->mensaje_resolucion;}else{echo 'Sin resolucion';}?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">fecha / hora de resolucion:</label>
                                                        <input type="text" class="form-control " value="<?php if($re->fecha_hora_resolucion){echo $re->fecha_hora_resolucion;}else{echo 'Sin fecha';}?>" disabled>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>