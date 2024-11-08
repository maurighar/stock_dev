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
require_once("../sys/connect_db.php");
$db_articulos = new Db_articulos();

if (isset($_GET['id'])) {
    $db_articulos->setId(isset($_GET['id'])?$_GET['id']:0);
    $articulo = $db_articulos->getOne();

    $retorno_descripcion = $articulo[0]['descripcion'];
    $retorno_codigo = $articulo[0]['codigo'];

} elseif($_SERVER['REQUEST_METHOD']=='POST'){
    /*   Validaciones de datos    */
    $db_articulos->setId(isset($_POST['id'])?$_POST['id']:0);
    $valorRetorno = $db_articulos->eliminar();

    header("location:" . RAIZ_SITIO . "articulos/index.php");
}
?>

<form action="eliminar_articulos.php" method="post">
    <?= isset($_GET['id'])?'<input type="hidden" name="id" value="' . $_GET['id'] . '">':'' ?>
    <h1>Esta seguro que quiere eliminar el articulo <br> <?= $retorno_codigo .' - ' . $retorno_descripcion ?>??</h1>
    <input type="submit" value="Eliminar">
    <a href="index.php" class="enlace_boton">Cancelar</a>
</form>

<?php render_template('footer',[],'..')?>