<?php
require_once '../sys/funciones.php';

$data = [
        'titulo_pagina' => 'Stock - Eliminar Artículos'
    ];

render_template('header', $data,'..');
require_once '../sys/seguridad.php';

echo "<h1>Eliminar Artículos</h1>"  ;
////////////////////////////////////////////////////////////////////////
//
//     Grabado de datos
//
////////////////////////////////////////////////////////////////////////
require_once("../sys/db_proveedores.php");
$db_proveedores = new db_proveedores();

if (isset($_GET['id'])) {
    $db_proveedores->setId(isset($_GET['id'])?$_GET['id']:0);
    $articulo = $db_proveedores->getOne();

    $retorno_descripcion = $articulo[0]['descripcion'];
    $retorno_codigo = $articulo[0]['codigo'];

} elseif($_SERVER['REQUEST_METHOD']=='POST'){
    /*   Validaciones de datos    */
    $db_proveedores->setId(isset($_POST['id'])?$_POST['id']:0);
    $valorRetorno = $db_proveedores->eliminar();

    header("location:" . RAIZ_SITIO . "proveedores/index.php");
}
?>

<form action="eliminar_proveedores.php" method="post">
    <?= isset($_GET['id'])?'<input type="hidden" name="id" value="' . $_GET['id'] . '">':'' ?>
    <h1>Esta seguro que quiere eliminar el articulo <br> <?= $retorno_codigo .' - ' . $retorno_descripcion ?>??</h1>
    <input type="submit" value="Eliminar">
    <a href="index.php" class="enlace_boton">Cancelar</a>
</form>

<?php render_template('footer',[],'..')?>