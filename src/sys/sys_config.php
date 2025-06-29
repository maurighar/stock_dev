<?php


/** El sistema esta trabajando en modo local */
define('MODO_LOCAL', true);

define('RAIZ_SITIO', '/stock_dev/src/');

/*#############################################

	Configuración general de la base de datos

###############################################*/

/** El nombre de tu base de datos */
define('DB_NAME', 'gest_stock');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
if (MODO_LOCAL){
	define('DB_HOST', 'localhost');
} else {
	define('DB_HOST', 'localhost');  // dirección del servidor
}
