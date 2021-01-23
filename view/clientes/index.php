<?php
include "view/body_header.php";
?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Clientes</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=RUTA?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Clientes</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> Nuevo Cliente</a>
                            <div class="view-icons">
                                <a href="<?=RUTA?>clientes" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                                <a href="<?=RUTA?>clientes/lista" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Client ID</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Client Name</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating"> 
                                <option>Select Company</option>
                                <option>Global Technologies</option>
                                <option>Delta Infotech</option>
                            </select>
                            <label class="focus-label">Company</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <a href="#" class="btn btn-success btn-block"> BUSCAR </a>  
                    </div>     
                </div>
                <!-- Search Filter -->
                
                <div class="row staff-grid-row">
                        <?php
                        $cliente=new cliente(new Connexion);
                        $cliente=$cliente->getAll();
                        while ($row=mysqli_fetch_array($cliente,MYSQLI_ASSOC)) {
                            ?>
                                <!--Profile -->
                                <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="client-profile.html" class="avatar"><img alt="" src="<?=$row['image']?>"></a>
                                    </div>
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Editar</a>
                                            <a onclick="eliminar(<?=$row['pk_cliente']?>);" class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a>
                                        </div>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="client-profile.html"><?=$row['nombres']?></a></h4>
                                    <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="client-profile.html"><?=$row['apellidos']?></a></h5>
                                    <a href="chat.html" class="btn btn-white btn-sm m-t-10">Mensage</a>
                                    <a href="<?=RUTA?>clientes/perfil/<?=$row['pk_cliente']?>" class="btn btn-white btn-sm m-t-10">Ver Perfil</a>
                                    </div>
                                </div>
                                <!--Profile -->
                            <?php
                        }
                        ?>
                        
                </div>
            </div>
            <!-- /Page Content -->
        
            <!-- Add Client Modal -->
            <div id="add_client" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nuevo Cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-insert-clientes" action="<?=RUTA?>process.php/clientes/insert/" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Nombres <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="clientes_insert_nombres">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Apellidos</label>
                                            <input class="form-control" type="text" name="clientes_insert_apellidos">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Correo <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="clientes_insert_email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Password <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="password" name="clientes_insert_password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Identificacion</label>
                                            <input class="form-control" type="text" name="clientes_insert_identificacion">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Telefono</label>
                                            <input class="form-control" type="text" name="clientes_insert_telefono">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Client Modal -->
            
            <!-- Edit Client Modal -->
            <div id="edit_client" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form id="form-edit-clientes" action="<?=RUTA?>process.php/clientes/insert/" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                             <input type="hidden" name="clientes_update_id" id="clientes_update_id">
                                            <label class="col-form-label">Nombres <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="clientes_insert_nombres">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Apellidos</label>
                                            <input class="form-control" type="text" name="clientes_insert_apellidos">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Correo <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="clientes_insert_email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Password <span class="text-danger">*</span></label>
                                            <input class="form-control floating" type="password" name="clientes_insert_password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Identificacion</label>
                                            <input class="form-control" type="text" name="clientes_insert_identificacion">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Telefono</label>
                                            <input class="form-control" type="text" name="clientes_insert_telefono">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Client Modal -->
            
            <!-- Delete Client Modal -->
            <div class="modal custom-modal fade" id="delete_client" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Eliminar Cliente</h3>
                                <p>¿Estás seguro de que quieres eliminar??</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                    <form id="form-delete-clientes" action="<?=RUTA?>process.php/clientes/delete/" method="POST">
                                    <input type="hidden" name="clientes_delete_id" id="clientes_delete_id">
                                    <button class="btn btn-primary submit-btn">Eliminar</button>
                                    </form>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete Client Modal -->
            
        </div>
        <!-- /Page Wrapper -->
        
    </div>
    <!-- /Main Wrapper -->