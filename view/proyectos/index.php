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
                            <h3 class="page-title">Proyectos</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=RUTA?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Proyectos</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Crear Proyecto</a>
                            <div class="view-icons">
                                <a href="<?=RUTA?>proyectos" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                                <a href="<?=RUTA?>proyectos/lista/" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
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
                            <label class="focus-label">Nombre Proyecto</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Nombre de Empleado</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating"> 
                                <option>Seleccionar rol</option>
                                <option>Desarrollador web </option>
                                <option>Web Designer</option>
                                <option>Android Developer</option>
                                <option>Ios Developer</option>
                            </select>
                            <label class="focus-label">Designation</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <a href="#" class="btn btn-success btn-block"> Buscar </a>  
                    </div>     
                </div>
                <!-- Search Filter -->
                
                <div class="row">
                <!--START LIST PROJECTS-->
                    <?php
                    $proyecto=new proyecto(new Connexion);
                    $proyecto=$proyecto->getAll();
                    while ($row=mysqli_fetch_array($proyecto,MYSQLI_ASSOC)) {
                        ?>
                            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown dropdown-action profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a  onclick="editar(<?=$row['pk_proyecto']?>)" class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Editar</a>
                                                <a onclick="eliminar(<?=$row['pk_proyecto']?>)" class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a>
                                            </div>
                                        </div>
                                        <h4 class="project-title"><a href="<?=RUTA?>proyectos/view/<?=$row['pk_proyecto']?>"><?=$row['name']?></a></h4>
                                        <small class="block text-ellipsis m-b-15">
                                        <?php 
                                        $task=new task(new Connexion);
                                        $task->setfk_proyecto($row['pk_proyecto']);
                                        $task=$task->getAllByFkProyectoTask();
                                        $task=$task->fetch_array(MYSQLI_ASSOC);
                                        if($task['count']<>0)
                                        {
                                            ?>
                                            <span class="text-xs"><?=$task['count']?></span> <span class="text-muted">open tasks</span>
                                            <?php
                                            $task=new task(new Connexion);
                                            $task->setfk_proyecto($row['pk_proyecto']);
                                            $task=$task->getAllByFkProyectoTaskComplete();
                                            if($task)
                                            {   $task=$task->fetch_array(MYSQLI_ASSOC);
                                                ?>
                                                <span class="text-xs"><?=$task['count']?></span> <span class="text-muted">tasks completed</span>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <span class="text-xs">0</span> <span class="text-muted">tasks completed</span>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <span class="text-muted">Sin Tareas Asignadas</span>
                                            <?php
                                        }

                                        ?>
                                        </small>
                                        <p class="text-muted">
                                        <?php
                                        $texto=substr($row['descripcion'], 0, 140);
                                        echo strip_tags($texto);
                                        ?>
                                        </p>
                                        <div class="pro-deadline m-b-15">
                                            <div class="sub-title">
                                                Fecha Inicio:
                                            </div>
                                            <div class="text-muted">
                                                <?=$row['start_date'] ?>
                                            </div>
                                        </div>
                                        <div class="pro-deadline m-b-15">
                                            <div class="sub-title">
                                                Estado:
                                            </div>
                                            <div class="text-muted">
                                                <?=$row['estado'] ?>
                                            </div>
                                        </div>
                                        <?php 
                                        if($row['estado']=="trabajando")
                                        {  
                                            ?>
                                            <p class="m-b-5">Progreso <span class="text-success float-right">40%</span></p>
                                            <div class="progress progress-xs mb-0">
                                                <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                <!--END LIST PROJECTS-->
                    
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Create Project Modal -->
            <div id="create_project" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Crear Proyecto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-insert-proyectos" enctype="multipart/form-data" action="<?=RUTA?>process.php/proyectos/insert/" method="POST">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nombre del Proyecto</label>
                                            <input class="form-control" type="text" name="proyectos_insert_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="select" name="proyectos_insert_fk_cliente">
                                               <?php 
                                               $cliente=new cliente(new Connexion);
                                               $cliente=$cliente->getAll();
                                                while ($row=mysqli_fetch_array($cliente,MYSQLI_ASSOC)) {
                                                    ?>
                                                    <option value="<?=$row['pk_cliente']?>"><?=$row['nombres']." ".$row['apellidos']?></option>
                                                    <?php
                                                }
                                               ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Fecha Inicio</label>
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker" type="text" name="proyectos_insert_start_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Fecha Fin</label>
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker" type="text" name="proyectos_insert_end_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Prioridad</label>
                                            <select class="select" name="proyectos_insert_priority">
                                                <option value="high">Alta</option>
                                                <option value="medium">Media</option>
                                                <option value="low">Baja</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Presupuesto</label>
                                            <input class="form-control" type="number" name="proyectos_insert_presupuesto">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <textarea rows="4" name="proyectos_insert_descripcion" class="form-control summernote" placeholder="Ingrese un descripcion del proyecto a realizar"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Subir archivos</label>
                                    <input class="form-control" name="proyectos_insert_archivos[]" multiple type="file">
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Create Project Modal -->
            
            <!-- Edit Project Modal -->
            <div id="edit_project" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Project Name</label>
                                            <input class="form-control" type="text" id="proyectos_edit_nombres">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Client</label>
                                            <select class="select">
                                                <option>Global Technologies</option>
                                                <option>Delta Infotech</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Rate</label>
                                            <input placeholder="$50" class="form-control" value="$5000" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <select class="select">
                                                <option>Hourly</option>
                                                <option selected>Fixed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Priority</label>
                                            <select class="select">
                                                <option selected>High</option>
                                                <option>Medium</option>
                                                <option>Low</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Add Project Leader</label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Team Leader</label>
                                            <div class="project-members">
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor" class="avatar">
                                                    <img src="<?=RUTA_RES?>assets/img/profiles/avatar-16.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Add Team</label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Team Members</label>
                                            <div class="project-members">
                                                <a href="#" data-toggle="tooltip" title="John Doe" class="avatar">
                                                    <img src="<?=RUTA_RES?>assets/img/profiles/avatar-16.jpg" alt="">
                                                </a>
                                                <a href="#" data-toggle="tooltip" title="Richard Miles" class="avatar">
                                                    <img src="<?=RUTA_RES?>assets/img/profiles/avatar-09.jpg" alt="">
                                                </a>
                                                <a href="#" data-toggle="tooltip" title="John Smith" class="avatar">
                                                    <img src="<?=RUTA_RES?>assets/img/profiles/avatar-10.jpg" alt="">
                                                </a>
                                                <a href="#" data-toggle="tooltip" title="Mike Litorus" class="avatar">
                                                    <img src="<?=RUTA_RES?>assets/img/profiles/avatar-05.jpg" alt="">
                                                </a>
                                                <span class="all-team">+2</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="4" class="form-control" placeholder="Enter your message here"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Upload Files</label>
                                    <input class="form-control" type="file">
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Project Modal -->
            
            <!-- Delete Project Modal -->
            <div class="modal custom-modal fade" id="delete_project" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Eliminar Proyecto</h3>
                                <p>esta seguro de eliminar?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <form id="form-delete-proyectos" action="<?=RUTA?>process.php/proyectos/delete/" method="POST">
                                    <input type="hidden" name="proyectos_delete_id" id="proyectos_delete_id">
                                    <button class="btn btn-primary submit-btn">Eliminar</button>
                                    </form>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete Project Modal -->
            
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->