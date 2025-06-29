<?php
require_once '../sys/funciones.php';

$data = [
        'titulo_pagina' => 'Stock - Eliminar Clientes'
    ];

render_template('header', $data,'..');
require_once '../sys/seguridad.php';

echo "<h1>Eliminar Clientes</h1>"  ;
////////////////////////////////////////////////////////////////////////
//
//     Grabado de datos
//
////////////////////////////////////////////////////////////////////////
require_once("../sys/db_clientes.php");
$db_clientes = new db_clientes();

if (isset($_GET['id'])) {
    $db_clientes->setId(isset($_GET['id'])?$_GET['id']:0);
    $articulo = $db_clientes->getOne();

    $retorno_descripcion = $articulo[0]['descripcion'];
    $retorno_codigo = $articulo[0]['codigo'];

} elseif($_SERVER['REQUEST_METHOD']=='POST'){
    /*   Validaciones de datos    */
    $db_clientes->setId(isset($_POST['id'])?$_POST['id']:0);
    $valorRetorno = $db_clientes->eliminar();

    header("location:" . RAIZ_SITIO . "clientes/index.php");
}
?>

<form action="eliminar_clientes.php" method="post">
    <?= isset($_GET['id'])?'<input type="hidden" name="id" value="' . $_GET['id'] . '">':'' ?>
    <h1>Esta seguro que quiere eliminar el articulo <br> <?= $retorno_codigo .' - ' . $retorno_descripcion ?>??</h1>
    <input type="submit" value="Eliminar">
    <a href="index.php" class="enlace_boton">Cancelar</a>
</form>

<?php render_template('footer',[],'..')?>