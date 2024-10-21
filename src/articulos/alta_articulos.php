<?php
require_once '../sys/funciones.php';

$data = [
        'titulo_pagina' => 'Stock - Alta Artículos'
    ];

render_template('header', $data,'..');
require_once '../sys/seguridad.php';

?>

<?php
////////////////////////////////////////////////////////////////////////
//
//     Grabado de datos
//
////////////////////////////////////////////////////////////////////////
require_once("../sys/connect_db.php");
$db_articulos = new Db_articulos();

if (isset($_GET['id'])) {
    echo '<h1>Modificación Artículos</h1>';
} else {
    echo '<h1>Alta Artículos</h1>';
}


if (isset($_GET['id'])) {
    $db_articulos->setId(isset($_GET['id'])?$_GET['id']:0);
    $valorRetorno = $db_articulos->getOne();

    $retorno_codigo = $valorRetorno[0]['codigo'];
    $retorno_descripcion = $valorRetorno[0]['descripcion'];
    $retorno_precio = $valorRetorno[0]['precio'];
    $retorno_cantidad = $valorRetorno[0]['cantidad'];

} elseif($_SERVER['REQUEST_METHOD']=='POST'){
    /*   Validaciones de datos    */
    $errores = array();

    $db_articulos->setId(isset($_POST['id'])?$_POST['id']:0);
    $db_articulos->setCodigo(isset($_POST['codigo'])?htmlspecialchars($_POST['codigo']):'');
    $db_articulos->setDescripcion(isset($_POST['descripcion'])?htmlspecialchars($_POST['descripcion']):'');
    $db_articulos->setPrecio(isset($_POST['precio'])?$_POST['precio']:0);
    $db_articulos->setCantidad(isset($_POST['cantidad'])?$_POST['cantidad']:0);

    if ($db_articulos->getId() == 0){
        $valorRetorno = $db_articulos->insertarDatos();
    } else {
        $valorRetorno = $db_articulos->actualizar();
    }
    
    if (is_bool($valorRetorno)){
        echo '<div class="mensaje_correcto">Se grabo correcto</div>';
    } else {
        echo '<div class="mensaje_mal">' . $valorRetorno . '</div>';
        $retorno_codigo = $_POST['codigo'];
        $retorno_descripcion = $_POST['descripcion'];
        $retorno_precio = $_POST['precio'];
        $retorno_cantidad = $_POST['cantidad'];
    }
}

?>


<form action="alta_articulos.php" method="post">
    <div class="container2col">
        <div>
            <label>Código</label>
            <input
                type="text"
                name="codigo"
                id="codigo"
                placeholder="Código del articulo"
                <?= isset($retorno_codigo)?'value=' . $retorno_codigo :''  ?>
                required
            />
        </div>
        <div>
            <label>Descripción</label>
            <input
                type="text"
                name="descripcion"
                id="descripcion"
                placeholder="Descripción del articulo"
                required
                <?= isset($retorno_descripcion)?'value=' . $retorno_descripcion :''  ?>
            />
        </div>
        <div>
            <label>Precio</label>
            <input
                type="number"
                name="precio"
                id="precio"
                placeholder="Precio del articulo"
                <?= isset($retorno_precio)?'value=' . $retorno_precio :''  ?>
                required
            />
        </div>
        <div>
            <label>Cantidad</label>
            <input
                type="number"
                name="cantidad"
                id="cantidad"
                min=0
                placeholder="Cantidad del articulo"
                <?= isset($retorno_cantidad)?'value=' . $retorno_cantidad :''  ?>
                required
            />
        </div>
    </div>
    <?= isset($_GET['id'])?'<input type="hidden" name="id" value="' . $_GET['id'] . '">':'' ?>
    <input type="submit" value="Guardar">
</form>



<?php render_template('footer',[],'..')?>