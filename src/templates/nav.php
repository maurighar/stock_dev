<nav role="navigation" id="nav-main" class="nav">
		<ul class="menus" role="navigation">
			<li><a href="<?php sitio(); ?>">#</a></li>
			<li><a href="<?php sitio(); ?>articulos/index.php">Articulos</a></li>
			<!-- <li>
				<a href="<?php sitio(); ?>sistema/rechazos.php?tipo=solucionado">Rechazados</a>
				<ul class="menus">
					<a href="<?php sitio(); ?>sistema/rechazos.php?tipo=completo">Completo</a>
					<li><a href="<?php sitio(); ?>sistema/consulta.php?Tipo=6&valorconsulta=Rechazos">Listado rechazados</a></li>
				</ul>
			</li> -->

			<!-- <li><a href="<?php sitio(); ?>certif/">Carga de certificados</a></li> -->
			<!-- <li><a href="<?php sitio(); ?>sistema/liquidacion.php">Liquidación</a></li> -->
			<!-- <li><a href="<?php sitio(); ?>sistema/config.php">Config</a></li> -->
			<!-- <li><a href="<?php sitio(); ?>asociados/index.php">Asociados</a></li> -->
			<!-- <li><a href="<?php sitio(); ?>sistema/turnos.php?op=consulta">Turnos</a></li> -->
			<!-- <li><a href="<?php sitio(); ?>sistema/Documentacion.html">Doc</a></li> -->
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