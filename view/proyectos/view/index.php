<?php 
include "view/body_header.php";
?>
<?php
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
								<h3 class="page-title"><?=$proyecto['name']?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?=RUTA?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Proyecto</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
							<a href="<?=RUTA?>proyectos/tarea/<?=$proyecto['pk_proyecto']?>" class="btn add-btn"><i class="fa fa-plus"></i>Añadir Tareas</a>
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#edit_project"><i class="fa fa-plus"></i> Edit Project</a>
								<a href="task-board.html" class="btn btn-white float-right m-r-10" data-toggle="tooltip" title="Task Board"><i class="fa fa-bars"></i></a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									<div class="project-title">
										<h5 class="card-title"><?=$proyecto['name']?></h5>
										<small class="block text-ellipsis m-b-15"><span class="text-xs">2</span> <span class="text-muted">open tasks, </span><span class="text-xs">5</span> <span class="text-muted">tasks completed</span></small>
									</div>
									<?=$proyecto['descripcion']?>
								</div>
							</div>
							
							<div class="card">
								<div class="card-body">
									<h5 class="card-title m-b-20">Archivos subidos</h5>
									<ul class="files-list">
									<?php
									$array=json_decode($proyecto['archivos'],true);

									foreach ($array as $valor) {
										?>
										<li>
											<div class="files-cont">
												<div class="file-type">
													<span class="files-icon"><i class="fa fa-image"></i></span>
												</div>
												<div class="files-info">
													<span class="file-name text-ellipsis"><a href="<?=RUTA?><?=$valor?>"><?=data($valor,'name')?></a></span>
													<span class="file-date"><?=data($valor,'time')?></span>
													<div class="file-size">Size: <?=data($valor,'tamaño')?></div>
												</div>
												<ul class="files-action">
													<li class="dropdown dropdown-action">
														<a href="" class="dropdown-toggle btn btn-link" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:void(0)">Download</a>
															<a class="dropdown-item" href="#" data-toggle="modal" data-target="#share_files">Share</a>
															<a class="dropdown-item" href="javascript:void(0)">Delete</a>
														</div>
													</li>
												</ul>
											</div>
										</li>
										<?php
									}
									?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-xl-3">
							<div class="card">
								<div class="card-body">
									<h6 class="card-title m-b-15">Detalles del Proyecto</h6>
									<table class="table table-striped table-border">
										<tbody>
											<tr>
												<td>Presupuesto:</td>
												<td class="text-right"><?=$proyecto['presupuesto']?></td>
											</tr>
											<tr>
												<td>Fecha Inicio:</td>
												<td class="text-right"><?=$proyecto['start_date']?></td>
											</tr>
											<tr>
												<td>Fecha Limite:</td>
												<td class="text-right"><?=date("Y-m-d",strtotime($proyecto['start_date']."+ ".$proyecto['duration']." days"));?></td>
											</tr>
											<tr>
												<td>Prioridad:</td>
												<td class="text-right">
													<div class="btn-group">
														<a href="#" class="badge badge-danger dropdown-toggle"><?=$proyecto['priority']?> </a>
													</div>
												</td>
											</tr>
											<tr>
												<td>Estatus:</td>
												<td class="text-right"><?=$proyecto['estado']?></td>
											</tr>
										</tbody>
									</table>
									<?php 
									if($proyecto['estado']<>"creado")
									{
										?>
										<p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
										<div class="progress progress-xs mb-0">
											<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
										</div>
										<?php
									}
									?>
									
								</div>
							</div>
							<div class="card project-user">
								<div class="card-body">
									<h6 class="card-title m-b-20">Líderes asignados<button type="button" class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#assign_leader"><i class="fa fa-plus"></i> Añadir</button></h6>
									<ul class="list-box">
										<?php
										$array=json_decode($proyecto['fk_usuario_lider'],true);

										foreach ($array as $valor) {
											$usuario=new usuario(new Connexion);
											$usuario->setpk($valor);
											$usuario=$usuario->getAllById();
											$usuario=$usuario->fetch_array(MYSQLI_ASSOC);
											?>
											<li>
											<a href="<?=RUTA?>perfil/<?=$usuario['pk_usuario']?>">
												<div class="list-item">
													<div class="list-left">
														<span class="avatar"><img alt="" src="<?=$usuario['image']?>"></span>
													</div>
													<div class="list-body">
														<span class="message-author"><?=$usuario['nombres']?></span>
														<div class="clearfix"></div>
														<span class="message-content"><a onclick="eliminar(<?=$usuario['pk_usuario']?>,'liders');" class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a></span>
													</div>
												</div>
											</a>
										</li>
											<?php
										}
										?>
									</ul>
								</div>
							</div>
							<div class="card project-user">
								<div class="card-body">
									<h6 class="card-title m-b-20">
									Usuarios asignados 
										<button type="button" class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#assign_user"><i class="fa fa-plus"></i> Add</button>
									</h6>
									<ul class="list-box">
									<?php
										$array=json_decode($proyecto['fk_usuario'],true);
										if(empty($array))
										{
											$array=array();
										}
										foreach ($array as $valor) {
											$usuario=new usuario(new Connexion);
											$usuario->setpk($valor);
											$usuario=$usuario->getAllById();
											$usuario=$usuario->fetch_array(MYSQLI_ASSOC);
											?>
											<li>
											<a href="<?=RUTA?>perfil/<?=$usuario['pk_usuario']?>">
												<div class="list-item">
													<div class="list-left">
														<span class="avatar"><img alt="" src="<?=$usuario['image']?>"></span>
													</div>
													<div class="list-body">
														<span class="message-author"><?=$usuario['nombres']?></span>
														<div class="clearfix"></div>
														<span class="message-content"><a onclick="eliminar(<?=$usuario['pk_usuario']?>,'users');" class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a></span>
													</div>
												</div>
											</a>
										</li>
											<?php
										}
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Assign Leader Modal -->
				<div id="assign_leader" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Asignar líder a este proyecto</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="form-insert-liders" action="<?=RUTA?>process.php/proyectos/view/addliders/" method="POST">
								<div class="input-group m-b-30">
								<input type="hidden" id="insert_id_proyecto" name="insert_id_proyecto" value="<?=$proyecto['pk_proyecto']?>">
								<select name="insert_liders[]" class="js-example-basic-multiple select" multiple="multiple">
								<?php 
								$usuario=new usuario(new Connexion);
								$usuario=$usuario->getAll();
								while ($row=mysqli_fetch_array($usuario,MYSQLI_ASSOC)) {
									?>
									<option value="<?=$row['pk_usuario']?>"><?=$row['nombres']?></option>
									<?php
								}
								?>
								</select>
								</div>
								<button class="btn btn-primary submit-btn">GUARDAR</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Assign Leader Modal -->
				
				<!-- Assign User Modal -->
				<div id="assign_user" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Asignar usuario a este proyecto.</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="form-insert-users" action="<?=RUTA?>process.php/proyectos/view/addusers/" method="POST">
								<div class="input-group m-b-30">
								<input type="hidden" name="insert_id_proyecto" id="insert_id_proyecto" value="<?=$proyecto['pk_proyecto']?>">
								<select name="insert_users[]" class="js-example-basic-multiple select" multiple="multiple">
								<?php 
								$usuario=new usuario(new Connexion);
								$usuario=$usuario->getAll();
								while ($row=mysqli_fetch_array($usuario,MYSQLI_ASSOC)) {
									?>
									<option value="<?=$row['pk_usuario']?>"><?=$row['nombres']?></option>
									<?php
								}
								?>
								</select>
								</div>
								<button class="btn btn-primary submit-btn">GUARDAR</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Assign User Modal -->
				
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
												<input class="form-control" value="Project Management" type="text">
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
													<a class="avatar" href="#" data-toggle="tooltip" title="Jeffery Lalor">
														<img alt="" src="assets/img/profiles/avatar-16.jpg">
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
													<a class="avatar" href="#" data-toggle="tooltip" title="John Doe">
														<img alt="" src="assets/img/profiles/avatar-02.jpg">
													</a>
													<a class="avatar" href="#" data-toggle="tooltip" title="Richard Miles">
														<img alt="" src="assets/img/profiles/avatar-09.jpg">
													</a>
													<a class="avatar" href="#" data-toggle="tooltip" title="John Smith">
														<img alt="" src="assets/img/profiles/avatar-10.jpg">
													</a>
													<a class="avatar" href="#" data-toggle="tooltip" title="Mike Litorus">
														<img alt="" src="assets/img/profiles/avatar-05.jpg">
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
                                    <form id="form-delete-users" action="<?=RUTA?>process.php/proyectos/view/deleteusers/" method="POST">
                                    <input type="hidden" name="insert_id_proyecto" value="<?=$proyecto['pk_proyecto']?>">
									<input type="hidden" name="users_delete_id" id="users_delete_id">
									<input type="hidden" name="users_tipo" id="users_tipo">
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

		<?php

		//funciones

		function FileSizeConvert($bytes)
		{
			$bytes = floatval($bytes);
				$arBytes = array(
					0 => array(
						"UNIT" => "TB",
						"VALUE" => pow(1024, 4)
					),
					1 => array(
						"UNIT" => "GB",
						"VALUE" => pow(1024, 3)
					),
					2 => array(
						"UNIT" => "MB",
						"VALUE" => pow(1024, 2)
					),
					3 => array(
						"UNIT" => "KB",
						"VALUE" => 1024
					),
					4 => array(
						"UNIT" => "B",
						"VALUE" => 1
					),
				);

			foreach($arBytes as $arItem)
			{
				if($bytes >= $arItem["VALUE"])
				{
					$result = $bytes / $arItem["VALUE"];
					$result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
					break;
				}
			}
			return $result;
		}
		function data($file,$tipo)
		{
			if($tipo=="tamaño")
			{
				return FileSizeConvert(filesize($file));
			}
			else if($tipo=="extension")
			{
				$info = new SplFileInfo($file);
				return $info->getExtension();
			}
			else if($tipo=="time")
			{
				$timestamp = filectime($file);
				$date = date("d M  Y H:i", $timestamp);
				return $date;
			}
			else if($tipo=="name")
			{
				$name=explode("/", $file);
				return $name[3];
			}
		}
		?>