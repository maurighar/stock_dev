<?php
require_once 'sys/funciones.php';


$data = [
        'titulo_pagina' => 'Finanzas - Login'
    ];

render_template('header', $data);

$year_post = isset($_POST['year'])?intval($_POST['year']):intval(date("Y"));

if($_SERVER['REQUEST_METHOD']=='POST'){    
    /*   Validaciones de datos    */
    $errores = array();

    $email = isset($_POST['email'])?htmlspecialchars($_POST['email']):'';  // valido si hay datos
    $pass = isset($_POST['password'])?$_POST['password']:'';  // valido si hay datos


    if (empty($email)){ 
        $errores['email'] = 'Insertar email.'; 
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores['email'] = 'Formato de email incorrecto.'; 
    }
    if (empty($pass)){
        $errores['password'] = 'La contraseña es obligatoria.'; 
    }

    if (empty($errores)){
        require_once 'sys/db_usuarios.php';
        $db_usuarios = new Db_usuarios();
        $db_usuarios->setEmail($email);

        $usuarios = $db_usuarios->getByEmail();
        foreach ($usuarios as $user) {
            if (password_verify($pass, $user['password'])){
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                header('Location:index.php');
            }
        }

    } else {
        // mostrar los errores
        foreach ($errores as $key => $value) {
            echo "$value<br>";
        }
        // echo '<a href="login.html">Regresar</a>';
    }
    

}
?>
<h1>Login</h1>


<div class="container3col">

<div></div>    
<div class="cuadro_gris">
    <form action="login.php" method="post">

        <div class="mb-3">
            <label>Email</label>
            <input
                type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder="Correo electronico"
                required
            />
        </div>


        <div class="mb-3">
            <label>
            <input
                type="password"
                class="form-control"
                name="password"
                id="password"
                placeholder="Contraseña"
                required
            />
        </div>

        <input type="submit" class="btn btn-primary" value="Iniciar Seción">
    </form>
</div>
<div></div>

</div>

<div class="container3col"></div>

<?php render_template('footer')?>