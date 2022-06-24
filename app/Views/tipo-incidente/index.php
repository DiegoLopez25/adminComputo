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
            <a href="<?= base_url('tipo-incidente/addEdit/0') ?>" class="btn btn-success float-right ml-0"><i class="fas fa-plus"></i> Nuevo <?=$title?></a>
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
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($tipoIncidente) :?>
                                                <?php foreach ($tipoIncidente as $ti) : ?>
                                                    <tr>
                                                        <td><?php echo $ti['id']; ?></td>
                                                        <td><?php echo $ti['nombre']; ?></td>
                                                        <td><?php echo $ti['descripcion']; ?></td>
                                                        <td class="project-actions ">
                                                            <a href="<?= base_url('/tipo-incidente/addEdit/'.$ti['id'])?>" class="btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                                            <a data-toggle="modal" data-target="#modal-delete" onclick="seleccionarTipoIncidenteParaBorrar(<?= $ti['id'] ?>)" class="btn btn-danger btn-sm"> <i class=" text-white fa fa-trash"></i></a>
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
        <!-- Logout Modal-->
        <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Eliminar <?=$title?></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url("/tipo-incidente/delete"); ?>" id="frmDelete" method="post">
                            <input type="hidden" id="deleteId" name="id">
                        </form>
                        ¿Desea eliminar este <?=$title?>?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-danger" onclick="borrarTipoIncidente()"><i class="fa fa-trash"></i>S&iacute, Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
           
        function seleccionarTipoIncidenteParaBorrar(val){
            document.getElementById('deleteId').value = val
        }

        function borrarTipoIncidente(){
            document.getElementById('frmDelete').submit()
        }
    </script>
<!-- /.container-fluid -->
<?= $this->endSection() ?>