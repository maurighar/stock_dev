<?php
require_once '../sys/funciones.php';

$data = [
        'titulo_pagina' => 'Stock - Alta Clientes'
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
require_once("../sys/db_clientes.php");
$db_clientes = new db_clientes();

if (isset($_GET['id'])) {
    echo '<h1 class="title is-3">Modificación Clientes</h1>';
} else {
    echo '<h1 class="title is-3">Alta Clientes</h1>';
}


if (isset($_GET['id'])) {
    $db_clientes->setId(isset($_GET['id'])?$_GET['id']:0);
    $valorRetorno = $db_clientes->getOne();

    $retorno_nombre = $valorRetorno[0]['nombre'];
    $retorno_cuit = $valorRetorno[0]['cuit'];
    $retorno_email = $valorRetorno[0]['email'];
    $retorno_telefono = $valorRetorno[0]['telefono'];

} elseif($_SERVER['REQUEST_METHOD']=='POST'){
    /*   Validaciones de datos    */
    $errores = array();

    $db_clientes->setId(isset($_POST['id'])?$_POST['id']:0);
    $db_clientes->setnombre(isset($_POST['nombre'])?htmlspecialchars($_POST['nombre']):'');
    $db_clientes->setcuit(isset($_POST['cuit'])?htmlspecialchars($_POST['cuit']):'');
    $db_clientes->setemail(isset($_POST['email'])?$_POST['email']:0);
    $db_clientes->settelefono(isset($_POST['telefono'])?$_POST['telefono']:0);

    if ($db_clientes->getId() == 0){
        $valorRetorno = $db_clientes->insertarDatos();
    } else {
        $valorRetorno = $db_clientes->actualizar();
    }
    
    if (is_bool($valorRetorno)){
        echo '<div class="mensaje_correcto">Se grabo correcto</div>';
    } else {
        echo '<div class="mensaje_mal">' . $valorRetorno . '</div>';
        $retorno_nombre = $_POST['nombre'];
        $retorno_cuit = $_POST['cuit'];
        $retorno_email = $_POST['email'];
        $retorno_telefono = $_POST['telefono'];
    }
}

?>


<div id="CargaDatos"  class="box">
    <form action="alta_clientes.php" method="post">
    <?= isset($_GET['id'])?'<input type="hidden" name="id" value="' . $_GET['id'] . '">':'' ?>
        <div class="fixed-grid">
            <div class="grid is-col-min-14 is-row-gap-0.5">


                <div class="field">
                    <label class="label">Nombre</label>
                    <div class="control">
                        <input class="input"
                            type="text"
                            name="nombre"
                            id="nombre"
                            placeholder="Nombre"
                            <?= isset($retorno_nombre)?'value=' . $retorno_nombre :''  ?>
                            required
                        />
                    </div>
                </div>


                <div class="field">
                    <label class="label">CUIT</label>
                    <div class="control">
                        <input class="input"
                            type="text"
                            name="cuit"
                            id="cuit"
                            placeholder="CUIT"
                            required
                            <?= isset($retorno_cuit)?'value=' . $retorno_cuit :''  ?>
                        />
                    </div>
                </div>


                <div class="field">
                    <label class="label">E-mail</label>
                    <div class="control">
                        <input class="input"
                            type="text"
                            name="email"
                            id="email"
                            placeholder="Email"
                            <?= isset($retorno_email)?'value=' . $retorno_email :''  ?>
                            
                        />
                    </div>
                </div>


                <div class="field">
                    <label class="label">Teléfono</label>
                    <div class="control">
                        <input class="input"
                            type="text"
                            name="telefono"
                            id="telefono"
                            min=0
                            placeholder="Teléfono"
                            <?= isset($retorno_telefono)?'value=' . $retorno_telefono :''  ?>
                            
                        />
                    </div>
                </div>



            </div>
            <button type="submit" class="button is-success">Grabar</button>
        </div>
    </form>
</div>


<?php render_template('footer',[],'..')?>