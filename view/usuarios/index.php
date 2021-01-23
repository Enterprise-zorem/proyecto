<?php include "view/body_header.php"; ?>
<?php 

function asignado($variable,$termino)
{
        if($variable[$termino]=="0" || empty($variable[$termino]))
        {
            return "No asignado";
        }
        else
        {
            if($termino<>"telefono")
            {
                if($termino=="fk_job")
                {
                    $job=new job(new Connexion);
                    $job->setpk($variable[$termino]);
                    $job=$job->getAllById();
                    $job=$job->fetch_array(MYSQLI_ASSOC);
                    return $job['name'];
                }
                else if($termino=="fk_rol")
                {
                    $rol=new rol(new Connexion);
                    $rol->setpk($variable[$termino]);
                    $rol=$rol->getAllById();
                    $rol=$rol->fetch_array(MYSQLI_ASSOC);
                    return $rol['name'];
                }
                else if($termino=="fk_area")
                {
                    $area=new area(new Connexion);
                    $area->setpk($variable[$termino]);
                    $area=$area->getAllById();
                    $area=$area->fetch_array(MYSQLI_ASSOC);
                    return $area['name'];
                }
            }
            else
            {
                return $variable[$termino];
            }
        }
    
}

function parent($value)
{
    if($value=="0" || empty($value))
    {
        return "No asignado";
    }
    else
    {
        $usuario=new usuario(new Connexion);
        $usuario->setpk($value);
        $usuario=$usuario->getAllById();
        $usuario=$usuario->fetch_array(MYSQLI_ASSOC);
        if($usuario)
        {
            $array=array();
            $explode=explode(" ",$usuario['nombres']);
            $array['nombres']=$explode[0]." ".$explode[1];
            $array['image']=$usuario['image'];
            if($usuario['fk_rol']=="0" || empty($usuario['fk_rol']))
            {
                $array['rol']="No asignado";
            }
            else
            {
                $rol=new rol(new Connexion);
                $rol->setpk($usuario['fk_rol']);
                $rol=$rol->getAllById();
                $rol=$rol->fetch_array(MYSQLI_ASSOC);
                $array['rol']=$rol['name'];
            }
            return $array;
        }
        else
        {
            return "No Existe";
        }
    }
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
                            <h3 class="page-title">Usuarios</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=RUTA?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Usuarios</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add User</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <div class="row filter-row">
               
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" id="busqueda_nombres" class="form-control floating">
                            <label class="focus-label">Nombres</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select id="busqueda_job" class="select floating"> 
                            <option value="0">Seleccione Profesion</option>
                                <?php 
                                $job=new job(new Connexion);
                                $job=$job->getAll();
                                while ($row =mysqli_fetch_array($job,MYSQLI_ASSOC)) {
                                    ?>
                                    <option value="<?=$row['pk_job']?>"><?=$row['name']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label class="focus-label">Profesion</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select id="buqueda_area" class="select floating"> 
                                <option value="0">Seleccione Area</option>
                                <?php 
                                $area=new area(new Connexion);
                                $area=$area->getAll();
                                while ($row =mysqli_fetch_array($area,MYSQLI_ASSOC)) {
                                    ?>
                                    <option value="<?=$row['pk_area']?>"><?=$row['name']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label class="focus-label">Area</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <a class="btn btn-success btn-block"> Buscar </a>  
                    </div>
                </div>
                <!-- /Search Filter -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombres</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>Profesion</th>
                                        <th>Area</th>
                                        <th>Superior</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $usuario=new usuario(new Connexion);
                                $usuario=$usuario->getAll();
                                while ($row=mysqli_fetch_array($usuario,MYSQLI_ASSOC)) {
                                   ?>
                                   <tr>
                                    <td><?=$row['pk_usuario']?></td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="<?=RUTA?>perfil/<?=$row['pk_usuario']?>" class="avatar"><img src="<?=RUTA?><?=$row['image']?>" alt=""></a>
                                                <a href="<?=RUTA?>perfil/<?=$row['pk_usuario']?>"><?=$row['nombres']?> <span><?=asignado($row,"fk_rol");?></span></a>
                                            </h2>
                                        </td>
                                        <td><?=$row['email']?></td>
                                        <td><?=asignado($row,"telefono");?></td>
                                        <td>
                                            <span class="badge bg-inverse-danger"><?=asignado($row,"fk_job");?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-inverse-danger"><?=asignado($row,"fk_area");?></span>
                                        </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <?php
                                                $lorem=parent($row['parent']);
                                                if(is_array($lorem))
                                                {
                                                    ?>
                                                    <a href="<?=RUTA?>perfil/<?=$row['parent']?>" class="avatar"><img src="<?=RUTA?><?=$lorem['image']?>" alt=""></a>
                                                    <a href="<?=RUTA?>perfil/<?=$row['parent']?>"><?=$lorem['nombres']?> <span><?=$lorem['rol'];?></span></a>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <a href="#"><?=$lorem;?></a>
                                                    <?php
                                                }
                                                ?>
                                            </h2>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" style="cursor: pointer;" onclick='modal_edit(<?php echo json_encode($row);?>);' data-toggle="modal" data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Editar</a>
                                                    <a class="dropdown-item" style="cursor: pointer;" onclick='eliminar(<?=$row["pk_usuario"]?>);' data-toggle="modal" data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a>
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
            
            <!-- Add User Modal -->
            <div id="add_user" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Añadir Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-insert-usuario" action="<?=RUTA?>process.php/usuarios/insert/" method="POST">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nombres <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="usuario_insert_nombres">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Cumpleaños <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker"  name="usuario_insert_birthdate" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>DNI</label>
                                            <input class="form-control" type="text" name="usuario_insert_dni">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Telefono <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="usuario_insert_telefono">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Correo <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="usuario_insert_email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="password" name="usuario_insert_password">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Rol de Usuario</label>
                                            <select class="select" name="usuario_insert_rol">
                                            <option value="0">Seleccione</option>
                                            <?php
                                            $rol=new rol(new Connexion);
                                            $rol=$rol->getAll();
                                            while ($row=mysqli_fetch_array($rol,MYSQLI_ASSOC)) {
                                                ?>
                                                <option value="<?=$row['pk_rol']?>"><?=$row['name']?></option>
                                                <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Area</label>
                                            <select class="select" name="usuario_insert_area">
                                            <option value="0">Seleccione</option>
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
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Profesion</label>
                                            <select class="select" name="usuario_insert_job">
                                            <option value="0">Seleccione</option>
                                            <?php
                                            $job=new job(new Connexion);
                                            $job=$job->getAll();
                                            while ($row=mysqli_fetch_array($job,MYSQLI_ASSOC)) {
                                                ?>
                                                <option value="<?=$row['pk_job']?>"><?=$row['name']?></option>
                                                <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Informes a:</label>
                                            <select class="select" name="usuario_insert_parent">
                                            <option value="0">Seleccione</option>
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
            <!-- /Add User Modal -->
            
            <!-- Edit User Modal -->
            <div id="edit_user" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-edit-usuario" action="<?=RUTA?>process.php/usuarios/update/" method="POST">
                            <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nombres <span class="text-danger">*</span></label>
                                            <input type="hidden" name="usuario_edit_id" id="usuario_edit_id">
                                            <input class="form-control" type="text" name="usuario_edit_nombres" id="usuario_edit_nombres">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Cumpleaños <span class="text-danger">*</span></label>
                                            <div class="cal-icon"><input class="form-control datetimepicker"  name="usuario_edit_birthdate" id="usuario_edit_birthdate" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>DNI</label>
                                            <input class="form-control" type="text" name="usuario_edit_dni" id="usuario_edit_dni">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Telefono <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="usuario_edit_telefono" id="usuario_edit_telefono">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Correo <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="usuario_edit_email" id="usuario_edit_email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="password" name="usuario_edit_password" id="usuario_edit_password">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Rol de Usuario</label>
                                            <select class="select" name="usuario_edit_rol" id="usuario_edit_rol">
                                            <option value="0">Seleccione</option>
                                            <?php
                                            $rol=new rol(new Connexion);
                                            $rol=$rol->getAll();
                                            while ($row=mysqli_fetch_array($rol,MYSQLI_ASSOC)) {
                                                ?>
                                                <option value="<?=$row['pk_rol']?>"><?=$row['name']?></option>
                                                <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Area</label>
                                            <select class="select" name="usuario_edit_area" id="usuario_edit_area">
                                            <option value="0">Seleccione</option>
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
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Profesion</label>
                                            <select class="select" name="usuario_edit_job" id="usuario_edit_job">
                                            <option value="0">Seleccione</option>
                                            <?php
                                            $job=new job(new Connexion);
                                            $job=$job->getAll();
                                            while ($row=mysqli_fetch_array($job,MYSQLI_ASSOC)) {
                                                ?>
                                                <option value="<?=$row['pk_job']?>"><?=$row['name']?></option>
                                                <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Informes a:</label>
                                            <select class="select" name="usuario_edit_parent" id="usuario_edit_parent">
                                            <option value="0">Seleccione</option>
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
            <!-- /Edit User Modal -->
            
            <!-- Delete User Modal -->
            <div class="modal custom-modal fade" id="delete_user" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Eliminar Usuario</h3>
                                <p>Esta seguro de Eliminar?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                    <form id="form-delete-usuario" action="<?=RUTA?>process.php/usuarios/delete/" method="POST">
                                    <input type="hidden" name="usuario_delete_id" id="usuario_delete_id">
                                    <button class="btn btn-primary submit-btn">Eliminar</button>
                                    </form>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete User Modal -->
            
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
