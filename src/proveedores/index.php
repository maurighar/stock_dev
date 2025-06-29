<?php
require_once '../sys/funciones.php';

$data = [
        'titulo_pagina' => 'Stock - Proveedores'
    ];

render_template('header', $data,'..');


require_once("../sys/db_proveedores.php");
$db_proveedores = new Db_proveedores();
$datos = $db_proveedores->get_all();

?>
<h1 class="title is-3">Proveedores</h1>

<div class="box buttons">
    <a href="alta_proveedores.php" class="button is-primary">Alta</a>
</div>

<div class="box">
    <table class="table is-narrow">
        <tr>
            <th>Nombre</th>
            <th>CUIT</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($datos as $key => $value):?>
        <tr>
            <td><?=$value['nombre']?></td>
            <td><?=$value['cuit']?></td>
            <td><?=$value['email']?></td>
            <td><?=$value['telefono']?></td>
            <td>
                <div class="buttons has-addons">
                    <a href="alta_proveedores.php?id=<?php echo $value['id']?>" class="button is-primary is-small">Editar</a>
                    <a href="eliminar_proveedores.php?id=<?php echo $value['id']?>" class="button is-danger  is-small">Eliminar</a>
                </div>
            </td>
        </tr>
        <?php endforeach ?>
    </table>
</div>

<?php render_template('footer',[],'..')?>