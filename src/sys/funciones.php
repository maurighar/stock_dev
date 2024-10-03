<?php
/*  Archivo con las configuraciónes generales del sistema  */
require_once 'sys_config.php';



function sitio() {
	echo RAIZ_SITIO;
}

// -----------------------------

function render_template(string $template, array $data = []){
	extract($data);
	require "templates/$template.php";
}