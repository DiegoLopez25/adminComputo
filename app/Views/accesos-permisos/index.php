<?= $this->extend('templates/admin_template')?>
<?= $this->section('content')?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<form
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

    <!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter">3+</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Alerts Center
            </h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-success">
                        <i class="fas fa-donate text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div>
    </li>


    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get('nombre')." ".session()->get('apellido');?></span>
            <img class="img-profile rounded-circle"
                src="img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <a class="dropdown-item" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Settings
            </a>
            <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                Activity Log
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between col-sm-12 col-xs-12">
        <h1 class="h3 text-gray-800 float-left ">Usuarios</h1>
        <div class="d-none d-sm-inline-block"><a href="<?=site_url('/dashboard')?>">Home</a> / <a href="http://">Lista de usuarios</a></div> 
    </div>
    <div class="row mb-3 col-sm-12 col-xs-12">
        <div class="col-md-3 col-sm-12 offset-md-9 ">
            <a href="#" class="btn btn-success float-right"><i class="fas fa-plus"></i> <span>Nuevo usuario</span></a>
        </div>
    </div>

    <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header"> 
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold text-primary">Lista Usuarios</h4>
                            <div class="d-none d-sm-inline-block">
                                <div class="input-group input-group-sm" style="width: 225px;">
                                    <select name="opciones" class="form-control float-left" id="filtro">
                                        <option selected value="nombre">Nombre</option>
                                        <option value="dui">dui</option>
                                    </select>
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>nombre</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                    <th>Rol</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                   <tr>
                                    <td>9</td>
                                    <td>Diego</td>
                                    <td>diego25</td>
                                    <td><span class="text-white bg-danger rounded">Inactivo</span></td>
                                    <td>Administrador</td>
                                    <td class="project-actions "> 
                                        <a data-toggle="modal" data-target="#modal-access" onclick="seleccionarClienteParaBorrar(9)" class="btn btn-warning btn-sm"> <i class=" text-white fa fa-key"></i></a>
                                        <a href="http://codeigniter-crud-diego.test/cliente/addEdit/9" class="btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        <a data-toggle="modal" data-target="#modal-delete" onclick="seleccionarClienteParaBorrar(9)" class="btn btn-danger btn-sm"> <i class=" text-white fa fa-trash"></i></a>
                                    </td>
                                </tr>   
                             </tbody>
                        </table>
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-md-10">
                                
<nav aria-label="Page navigation">
    <ul class="pagination pagination-sm">
    
            <li class=" active page-item">
            <a class="page-link" href="http://codeigniter-crud-diego.test/index.php/cliente?page=1">
                1            </a>
        </li>
            <li>
            <a class="page-link" href="http://codeigniter-crud-diego.test/index.php/cliente?page=2">
                2            </a>
        </li>
            <li>
            <a class="page-link" href="http://codeigniter-crud-diego.test/index.php/cliente?page=3">
                3            </a>
        </li>
    
            <li class=" page-item">
            <a class="page-link" href="http://codeigniter-crud-diego.test/index.php/cliente?page=4" aria-label="Next">
                <strong aria-hidden="true">&gt;</strong>
            </a>
        </li>
        <li class=" page-item">
            <a class="page-link" href="http://codeigniter-crud-diego.test/index.php/cliente?page=203" aria-label="Last">
                <strong aria-hidden="true">&gt;&gt;</strong>
            </a>
        </li>
        </ul>
</nav>                            </div>
                            <div class="col-md-2">
                                <form id="frmPageSize" action="http://codeigniter-crud-diego.test/index.php/cliente" method="get">
                                    <select name="pageSize" class="form-control float-right" style="width: 70px">
                                         
                                            <option selected="" value="5">5</option>
                                         
                                            <option value="10">10</option>
                                         
                                            <option value="25">25</option>
                                         
                                            <option value="50">50</option>
                                         
                                            <option value="100">100</option>
                                                                            </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete Modal-->
            <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Eliminar Usuario</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url("usuario/delete");?>" id="frmDelete" method="post">
                                            <input type="hidden" id="deleteId" name="id">
                            </form>
                            ¿Desea eliminar este Usuario?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-danger" onclick=""><i class="fa fa-trash"></i>S&iacute, Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Accesos Modal-->
            <div class="modal fade" id="modal-access" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Accesos y Permisos</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url("usuario/delete");?>" id="frmDelete" method="post">
                                            <input type="hidden" id="deleteId" name="id">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-danger" onclick=""><i class="fa fa-trash"></i>S&iacute, Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection()?>