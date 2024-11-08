<?php
/*  Archivo con las configuraciónes generales del sistema  */
require_once 'sys_config.php';



function sitio() {
	echo RAIZ_SITIO;
}

// -----------------------------

function render_template(string $template, array $data = [], $dir_raiz = '.'){
	// guarda la directorio raiz si viene de otro directorio
	$data['directorio_de_raiz'] = $dir_raiz;

	extract($data);
	require "$dir_raiz/templates/$template.php";
}