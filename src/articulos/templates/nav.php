<nav role="navigation" id="nav-main" class="nav">
		<ul class="menus" role="navigation">
			<li><a href="<?php sitio(); ?>">#</a></li>
			<li><a href="<?php sitio(); ?>articulos/index.php">Articulos</a></li>
			<li><a href="<?php sitio(); ?>articulos/alta_articulos.php">Alta</a></li>
		</ul>

		<div class="version">
			<a href="<?php sitio(); ?>login.php">Login</a>
			<?php
			// if ($_SESSION["autentificado"] = 'SI') {
			//  	echo $_SESSION["usuario"]. '  ';
			// } else {
			// 	echo '<a href="' . RAIZ_SITIO . 'sistema/login.php"></a>  ';
			// }
			echo date("D  d-m-Y");
			?>
			<br>
			Ver: 0.0.1
		</div>
	</nav>