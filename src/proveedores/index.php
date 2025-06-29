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
<h1>Proveedores</h1>

<div>
    <a class="enlace_boton" href="alta_proveedores.php">Alta</a>
</div>


<table>
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
        <a href="alta_proveedores.php?id=<?php echo $value['id']?>" class="btn-Editar">Editar </a> /
        <a href="eliminar_proveedores.php?id=<?php echo $value['id']?>" class="btn-Eliminar">Eliminar</a>

        </td>
    </tr>
    <?php endforeach ?>
</table>

<?php render_template('footer',[],'..')?>