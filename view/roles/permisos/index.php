<?php 
include "view/body_header.php";

$id=View::GET();

if(is_numeric($id))
{
    $rol=new rol(new Connexion);
    $rol->setpk($id);
    $rol=$rol->getAllById();
    if(mysqli_num_rows($rol))
    {
        $rol=$rol->fetch_array(MYSQLI_ASSOC);
    }
    else
    {
        echo "<script>window.location.replace('".RUTA."')</script>";
    }
}
else
{
    echo "<script>window.location.replace('".RUTA."')</script>";
}

?>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Permisos del Rol: <?=$rol['name']?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=RUTA?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?=RUTA?>roles">Roles</a></li>
                                <li class="breadcrumb-item active">Permisos</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Nuevo Permiso</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre </th>
                                        <th>Tipo</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $vista=new vista(new Connexion);
                                $vista->setfk_rol($rol['pk_rol']);
                                $vista=$vista->getAllByRolVista();
                                while ($row=mysqli_fetch_array($vista,MYSQLI_ASSOC)) {
                                  ?>
                                    <tr class="holiday-upcoming">
                                        <td><?=$row['id']?></td>
                                        <td><?php
                                                $asd=new vista(new Connexion);
                                                $asd->setpk($row['fk_vista']);
                                                $asd=$asd->getAllById();
                                                $asd=$asd->fetch_array(MYSQLI_ASSOC);
                                                echo $asd['vista'];
                                            ?>
                                        </td>
                                        <td><?=$asd['tipo']?></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" style="cursor: pointer;" onclick="eliminar(<?=$row['id']?>)" data-toggle="modal" data-target="#delete_holiday"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                  <?php
                                }
                                ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Add Holiday Modal -->
            <div class="modal custom-modal fade" id="add_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nuevo Permiso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-insert-permisos" action="<?=RUTA?>process.php/roles/permisos/insert/" method="POST">
                                <div class="form-group">
                                    <label>Nombre <span class="text-danger"></span></label>
                                    <input type="hidden" name="permisos_insert_rol" value="<?=$rol['pk_rol']?>">
                                    <select name="permisos_insert_vista" id="permisos_insert_vista">
                                    <optgroup label="vista">
                                    <?php
                                    $vista=new vista(new Connexion);
                                    $vista=$vista->getAllTipo('vista');
                                    while ($row=mysqli_fetch_array($vista,MYSQLI_ASSOC)) {
                                        ?>
                                            <option value="<?=$row['pk_vista']?>"><?=$row['vista']?></option>
                                        <?php
                                    }
                                    ?>
                                    </optgroup>
                                    <optgroup label="proceso">
                                    <?php
                                    $vista=new vista(new Connexion);
                                    $vista=$vista->getAllTipo('proceso');
                                    while ($row=mysqli_fetch_array($vista,MYSQLI_ASSOC)) {
                                        ?>
                                            <option value="<?=$row['pk_vista']?>"><?=$row['vista']?></option>
                                        <?php
                                    }
                                    ?>
                                    </optgroup>
                                   
                                    </select>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Holiday Modal -->

            <!-- Delete Holiday Modal -->
				<div class="modal custom-modal fade" id="delete_holiday" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Eliminar Rol</h3>
									<p>Esta Seguro de Eliminar?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">

										<div class="col-6">
                                        <form id="form-delete-permisos" method="POST" action="<?=RUTA?>process.php/roles/permisos/delete/">
                                        <input type="hidden" name="permisos_delete_id" id="permisos_delete_id">
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
				<!-- /Delete Holiday Modal -->
            
        </div>
        <!-- /Page Wrapper -->
        
    </div>
    <!-- /Main Wrapper -->