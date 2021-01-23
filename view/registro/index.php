<?php 
$session=new Session();
$session=$session->getValue('projects_id_user');
if($session)
{
    header("Location: ".RUTA);
}
?>
<!-- Main Wrapper -->
<div class="main-wrapper">
			<div class="account-content">
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.html"><img src="<?=RUTA_RES?>assets/img/logo2.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Registrarse</h3>
							<p class="account-subtitle">Acceso a nuestro sistema</p>
							
							<!-- Account Form -->
							<form id="form-registro" method="POST" action="<?=RUTA?>process.php/registro/">
                                <div class="form-group">
									<label>Nombre Completo</label>
									<input class="form-control" type="text" name="registro__nombres">
								</div>
								<div class="form-group">
									<label>Correo Electronico</label>
									<input class="form-control" type="text" name="registro__email">
								</div>
								<div class="form-group">
									<label>Contraseña</label>
									<input class="form-control" type="password" name="registro__password">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Registrarse</button>
								</div>
								<div class="account-footer">
									<p>Ya tienes una cuenta? <a href="<?=RUTA?>login"> Inicia sesión</a></p>
								</div>
							</form>
							<!-- /Account Form -->
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->