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
                            <h3 class="page-title">Profesiones</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=RUTA?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profesiones</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Nueva job</a>
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
                                        <th>Fecha Creacion</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $job=new job(new Connexion);
                                $job=$job->getAll();
                                while ($row=mysqli_fetch_array($job,MYSQLI_ASSOC)) {
                                  ?>
                                    <tr class="holiday-upcoming">
                                        <td><?=$row['pk_job']?></td>
                                        <td><?=$row['name']?></td>
                                        <td><?=$row['created_at']?></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target="#edit_holiday" onclick="modal_edit(<?=$row['pk_job']?>,'<?=$row['name']?>')"><i class="fa fa-pencil m-r-5"></i> Editar</a>
                                                    <a class="dropdown-item" style="cursor: pointer;" onclick="eliminar(<?=$row['pk_job']?>)" data-toggle="modal" data-target="#delete_holiday"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a>
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
                            <h5 class="modal-title">Nueva Profesion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-insert-job" action="<?=RUTA?>process.php/job/insert/" method="POST">
                                <div class="form-group">
                                    <label>Nombre <span class="text-danger"></span></label>
                                    <input class="form-control" type="text" name="job_insert_name">
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
                            <h5 class="modal-title">Editar Profesion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-edit-job" action="<?=RUTA?>process.php/job/update/" method="POST">
                                <div class="form-group">
                                    <label>Nombre <span class="text-danger">*</span></label>
                                    <input type="hidden" name="job_edit_id" id="job_edit_id">
                                    <input class="form-control" type="text" name="job_edit_name" id="job_edit_name">
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
									<h3>Eliminar Profesion</h3>
									<p>Esta Seguro de Eliminar?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">

										<div class="col-6">
                                        <form id="form-delete-job" method="POST" action="<?=RUTA?>process.php/job/delete/">
                                        <input type="hidden" name="job_delete_id" id="job_delete_id">
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