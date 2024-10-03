<?php
require_once 'sys/funciones.php';

$data = [
        'titulo_pagina' => 'Stock - Artículos'
    ];

render_template('header', $data);
?>
<h1>Artículos</h1>

<div class="container2col">
    <div>
        Alta
    </div>
    <div>
        Modificación
    </div>
    <div>
        Baja
    </div>
    <div>
        Listados
    </div>
</div>



<?php render_template('footer')?>