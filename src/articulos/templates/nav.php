<nav role="navigation" id="nav-main" class="nav">
		<ul class="menus" role="navigation">
			<li><a href="<?php sitio(); ?>">#</a></li>
			<li><a href="<?php sitio(); ?>articulos/index.php">Articulos</a></li>
			<li><a href="<?php sitio(); ?>articulos/alta_articulos.php">Alta</a></li>
		</ul>

		<div class="version">
			<?php
			//-----------------------------------------------
			// indico si la session esta inciada
			// session_start();
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
	</nav>