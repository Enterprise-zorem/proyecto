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
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Acceso a nuestro sistema</p>
							
							<!-- Account Form -->
							<form id="form-login" action="<?=RUTA?>process.php/login/" method="POST">
								<div class="form-group">
									<label>Correo Electronico</label>
									<input class="form-control" type="text" name="login__email">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Contraseña</label>
										</div>
										<div class="col-auto">
											<a class="text-muted" href="<?=RUTA?>recover">
												Olvidaste tu Contraseña?
											</a>
										</div>
									</div>
									<input class="form-control" type="password" name="login__password">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Login</button>
								</div>
								<div class="account-footer">
									<p>No tienes una cuenta? <a href="<?=RUTA?>registro">Registrate</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->