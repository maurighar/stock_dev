<?php
require_once '../sys/funciones.php';

$data = [
        'titulo_pagina' => 'Stock - Artículos'
    ];

render_template('header', $data,'..');


require_once("../sys/connect_db.php");
$db_articulos = new Db_articulos();
$datos = $db_articulos->get_all();

?>
<h1>Artículos</h1>

<div>
    <a class="enlace_boton" href="alta_articulos.php">Alta</a>
</div>


<table>
    <tr>
        <th>Código</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Acciones</th>
    </tr>
    <?php foreach($datos as $key => $value):?>
    <tr>
        <td><?=$value['codigo']?></td>
        <td><?=$value['descripcion']?></td>
        <td><?=$value['precio']?></td>
        <td><?=$value['cantidad']?></td>
        <td>
        <a href="alta_articulos.php?id=<?php echo $value['id']?>" class="btn-Editar">Editar </a> /
        <a href="eliminar_articulos.php?id=<?php echo $value['id']?>" class="btn-Eliminar">Eliminar</a>

        </td>
    </tr>
    <?php endforeach ?>
</table>

<?php render_template('footer',[],'..')?>