<?php

    if (array_key_exists('usuario',$_POST) OR
    array_key_exists('contrasena',$_POST)) {

        $servidor = "sdb-57.hosting.stackcp.net";
        $bd = "proyectotienda-35303135db7e";
        $usuario = "pruebamanuel";
        $password = "Usuario1/";
    
        $enlace = mysqli_connect($servidor, $usuario, $password, $bd); 
        if (mysqli_connect_error()) {
            die("Error en la conexión");
        }
        if ($_POST['usuario']=='') {
            echo "<p> El campo usuario es obligatorio </p>";
        }
        else if ($_POST['contrasena']=='') {
            echo "<p> El campo contrasena es obligatorio </p>";
        }
        else {
            if(isset($_POST['iniciar'])){
            $user = htmlspecialchars($_POST['usuario']);
            $usermayus = strtoupper($user);
            $contra = $_POST['contrasena'];
            $cifrada = md5($contra);
            $query = "SELECT id_usuario, nombre_usuario, password FROM usuarios WHERE UPPER(nombre_usuario)='{$usermayus}' AND password='{$cifrada}' LIMIT 1";
            $result = mysqli_query($enlace,$query);
            if ($result) {
                $fila = mysqli_fetch_array($result); //Permite seleccionar una fila
                $id = $fila['id_usuario'];
            }  
            if (mysqli_num_rows($result)>0){
                setcookie("id",$id,time()+60*60*24*365);
                echo "<script>window.location.href = 'https://proyectotienda-com.stackstaging.com/index.php';</script>";
            }
            else {
                echo "<p> El usuario o contraseña que ha introducido no existe </p>";
            }
            
        }   
    }
}
    if (!empty($_GET['Logout']==1)){
        setcookie("id",$id,time()-60*60*24*365);
        session_destroy();
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Formulario de inicio de sesión</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<div class="contenedor">
		<h1>Iniciar Sesión</h1>
		<form method="post">
			<label for="usuario">Nombre de usuario:</label>
			<input type="text" name="usuario" id="usuario" placeholder="Ingrese su nombre de usuario" required>

			<label for="contrasena">Contraseña:</label>
			<input type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña" required>

			<button type="submit" name="iniciar">Ingresar</button>

			<button type="submit" name="registrar" onclick="crearCuenta()">¿No tienes cuenta? Registrate!!</button>
		</form>
	</div>
</body>
</html>

<script>
    function crearCuenta() {
        window.location.href = 'https://proyectotienda-com.stackstaging.com/registro.php';
    }
</script>