<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<a  class="navbar-item" href="<?php sitio(); ?>">
		<?php echo (MODO_LOCAL)?'<strong class="notification is-danger">Dev</strong>':'Stock';?>
		</a>

		<a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
		</a>
	</div>

	<div id="navbar" class="navbar-menu">
		<div class="navbar-start">
			<a class="navbar-item" href="<?php sitio(); ?>articulos/index.php">Articulos</a>
			<a class="navbar-item" href="<?php sitio(); ?>proveedores/index.php">Proveedores</a>
		</div>
	</div>


	<div class="navbar-end">
		<div class="navbar-item">
			<div class="buttons">
				<?php
				//-----------------------------------------------
				// indico si la session esta inciada
				if (isset($_SESSION['user_id'])) {
					echo '(' . $_SESSION["user_name"]. '/<a href="' . RAIZ_SITIO . 'cerrarSecion.php">Cerrar</a>) ';
				} else {
					echo '<a href="' . RAIZ_SITIO . 'login.php">Login</a>  ';
				}
				//-----------------------------------------------
				echo date("D  d-m-Y");
				?>
				<br>
				Ver: 0.0.1
			</div>
		</div>
	</div>

</nav>