<?php 
include "view/body_header.php";

$id=View::GET();

if(is_numeric($id))
{
    $proyecto=new proyecto(new Connexion);
    $proyecto->setpk($id);
    $proyecto=$proyecto->getAllById();
    if(mysqli_num_rows($proyecto))
    {
        $proyecto=$proyecto->fetch_array(MYSQLI_ASSOC);
    }
    else
    {
        echo "<script>window.location.replace('".RUTA."proyectos');</script>";
    }

}
else
{
    echo "<script>window.location.replace('".RUTA."proyectos');</script>";
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
                            <h3 class="page-title">Añadir Tareas -> <?=$proyecto['name']?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=RUTA?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?=RUTA?>proyectos">Proyectos</a></li>
                                <li class="breadcrumb-item active">Tareas</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Nueva Tarea</a>
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
                                        <th>Nombre</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Final</th>
                                        <th>Añadir Sub-Tarea</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $task=new task(new Connexion);
                                $task->setfk_proyecto($proyecto['pk_proyecto']);
                                $task=$task->getAllByFkProyecto();
                                while ($row=mysqli_fetch_array($task,MYSQLI_ASSOC)) {
                                  ?>
                                    <tr class="holiday-upcoming">
                                        <td><?=$row['pk_task']?></td>
                                        <td><?=$row['name']?></td>
                                        <td><?=$row['start_date']?></td>
                                        <td><?php 
                                          echo date("Y-m-d",strtotime($row['start_date']."+ ".$row['duration']." days")); 
                                        ?></td>
                                        <td><a class="btn btn-primary" href="<?=RUTA?>proyectos/tarea/child/<?=$row['pk_task']?>">Añadir</a></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target="#edit_holiday" onclick="modal_edit(<?=$row['pk_task']?>)"><i class="fa fa-pencil m-r-5"></i> Editar</a>
                                                    <a class="dropdown-item" style="cursor: pointer;" onclick="eliminar(<?=$row['pk_task']?>)" data-toggle="modal" data-target="#delete_holiday"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a>
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
                            <h5 class="modal-title">Nueva Tarea</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-insert-tarea" action="<?=RUTA?>process.php/proyectos/tarea/insert/" method="POST">
                                <div class="form-group">
                                    <label>Nombre <span class="text-danger"></span></label>
                                    <input class="form-control" type="text" name="tarea_insert_name">
                                    <input class="form-control" type="hidden" name="tarea_insert_fk_proyecto" value="<?=$proyecto['pk_proyecto']?>">
                                </div>
                               <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha Inicio <span class="text-danger"></span></label>
                                    <input class="form-control datetimepicker" type="text" name="tarea_insert_start_date">
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha Fin <span class="text-danger"></span></label>
                                    <input class="form-control datetimepicker" type="text" name="tarea_insert_end_date">
                                </div>
                                </div>
                               </div>
                               <div class="form-group">
                                            <label>Area Asignada</label>
                                            <select class="select" name="tarea_insert_fk_area">
                                               <?php 
                                               $area=new area(new Connexion);
                                               $area=$area->getAll();
                                                while ($row=mysqli_fetch_array($area,MYSQLI_ASSOC)) {
                                                    ?>
                                                    <option value="<?=$row['pk_area']?>"><?=$row['name']?></option>
                                                    <?php
                                                }
                                               ?>
                                            </select>
                                </div>
                                <div class="form-group">
                                <label>Descripcion</label>
                                <textarea rows="4" name="tarea_insert_descripcion" class="form-control" placeholder="Ingrese un descripcion del proyecto a realizar"></textarea>
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
            
            <!-- Edit Holiday Modal -->
            <div class="modal custom-modal fade" id="edit_holiday" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Tarea</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-edit-tarea" action="<?=RUTA?>process.php/proyectos/tarea/update/" method="POST">
                            <div class="form-group">
                                    <label>Nombre <span class="text-danger"></span></label>
                                    <input class="form-control" type="text" name="tarea_edit_name" id="tarea_edit_name">
                                    <input class="form-control" type="hidden" name="tarea_edit_pk_tarea" id="tarea_edit_pk_tarea">
                                    <input class="form-control" type="hidden" name="tarea_edit_fk_proyecto" value="<?=$proyecto['pk_proyecto']?>">
                                </div>
                               <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha Inicio <span class="text-danger"></span></label>
                                    <input class="form-control datetimepicker" type="text" name="tarea_edit_start_date" id="tarea_edit_start_date">
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha Fin <span class="text-danger"></span></label>
                                    <input class="form-control datetimepicker" type="text" name="tarea_edit_end_date" id="tarea_edit_end_date">
                                </div>
                                </div>
                               </div>
                               <div class="form-group">
                                            <label>Area Asignada</label>
                                            <select class="select" name="tarea_edit_fk_area">
                                               <?php 
                                               $area=new area(new Connexion);
                                               $area=$area->getAll();
                                                while ($row=mysqli_fetch_array($area,MYSQLI_ASSOC)) {
                                                    ?>
                                                    <option value="<?=$row['pk_area']?>"><?=$row['name']?></option>
                                                    <?php
                                                }
                                               ?>
                                            </select>
                                </div>
                                <div class="form-group">
                                <label>Descripcion</label>
                                <textarea rows="4" name="tarea_edit_descripcion" id="tarea_edit_descripcion" class="form-control summernote"  placeholder="Ingrese un descripcion del proyecto a realizar"></textarea>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Holiday Modal -->

            <!-- Delete Holiday Modal -->
				<div class="modal custom-modal fade" id="delete_holiday" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Eliminar la Tarea</h3>
									<p>Esta Seguro de Eliminar?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">

										<div class="col-6">
                                        <form id="form-delete-tarea" method="POST" action="<?=RUTA?>process.php/proyectos/tarea/delete/">
                                        <input type="hidden" name="tarea_delete_id" id="tarea_delete_id">
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