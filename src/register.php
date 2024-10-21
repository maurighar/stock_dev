<?php
require_once 'sys/funciones.php';


$data = [
        'titulo_pagina' => 'Finanzas - Registro'
    ];

render_template('header', $data);

if($_SERVER['REQUEST_METHOD']=='POST'){
    

    $nombre = isset($_POST['nombre'])?$_POST['nombre']:'';  // valido si hay datos
    $apellido = isset($_POST['apellido'])?$_POST['apellido']:'';
    $email = isset($_POST['email'])?$_POST['email']:'';
    $pass = isset($_POST['pass'])?$_POST['pass']:'';
    $repass = isset($_POST['repass'])?$_POST['repass']:'';



    /*   Validaciones de datos    */
    $errores = array();
    
    if (empty($nombre)){ 
        $errores['nombre'] = 'Insertar nombre.'; 
    }
    if (empty($apellido)){ 
        $errores['apellido'] = 'Insertar apellido.'; 
    }
    if (empty($email)){ 
        $errores['email'] = 'Insertar email.'; 
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores['email'] = 'Formato de email incorrecto.'; 
    }

    /* validación de la contraseña  */
    if (empty($pass)){
        $errores['password'] = 'La contraseña es obligatoria.'; 
    }
    if (empty($repass)){ 
        $errores['repass'] = 'Debe confirmar la contraseña.'; 
    } elseif ($pass != $repass) {
        $errores['password'] = 'Las contraseñas no coinciden.'; 
    }



    if (empty($errores)){
        require_once 'sys/db_usuarios.php';
        $db_usuarios = new Db_usuarios();

        $errores = array();

        $db_usuarios->setNombre($nombre);
        $db_usuarios->setApellido($apellido);
        $db_usuarios->setEmail($email);
        $db_usuarios->setPassword($pass);
    
        if ($db_usuarios->getId() == 0){
            $valorRetorno = $db_usuarios->insertarDatos();
        } else {
            $valorRetorno = $db_usuarios->actualizar();
        }
        
        if (is_bool($valorRetorno)){
            echo '<div class="mensaje_correcto">Se grabo correcto</div>';
        } else {
            echo '<div class="mensaje_mal">' . $valorRetorno . '</div>';
        }

    } else {
        // mostrar los errores
        foreach ($errores as $key => $value) {
            echo "$value<br>";
        }
        echo '<a href="register.html">Regresar</a>';
    }


}
?>


<div>
    <h1>Registro de usuarios</h1>
</div>

<form action="register.php" id="formularioderegistro" method="post">
    <label for="" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="nombre" required> <br><br>

    <label for="" class="form-label">Apellido</label>
    <input type="text" class="form-control" name="apellido" id="apellido">

    <label for="" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="email" required>

    <label for="" class="form-label">Clave</label>
    <input type="password" class="form-control" name="pass" id="pass" required>

    <label for="" class="form-label">Repetir clave</label>
    <input type="password" class="form-control" name="repass" id="repass" required>
    <div class="invalid-feedback">Las contraseñas no coniciden.</div>

    <input type="submit" class="btn btn-primary" value='Registrarme'><br>
    <a href="login.html" class="btn btn-secondary">Login</a>
</form>



<?php render_template('footer')?>