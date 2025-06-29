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
<h1 class="title is-3">Artículos</h1>

<div class="box buttons">
    <a href="alta_articulos.php" class="button is-primary">Alta</a>
</div>

<div class="box">
    <table class="table is-narrow">
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
                    <div class="buttons has-addons">
                        <a href="alta_articulos.php?id=<?php echo $value['id']?>" class="button is-primary is-small">Editar</a>
                        <a href="eliminar_articulos.php?id=<?php echo $value['id']?>" class="button is-danger  is-small">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
<?php render_template('footer',[],'..')?>