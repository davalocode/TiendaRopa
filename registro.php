<?php

    header("Content-type:text/html;charset=utf-8");
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
            echo "<p> El campo Nombre de usuario es obligatorio </p>";
        }
        else if ($_POST['contrasena']=='') {
            echo "<p> El campo Contraseña es obligatorio </p>";
        }
		else if ($_POST['nombre']=='') {
            echo "<p> El campo Nombre es obligatorio </p>";
        }
		else if ($_POST['apellido']=='') {
            echo "<p> El campo Apellido es obligatorio </p>";
        }
		else if ($_POST['email']=='') {
            echo "<p> El campo Correo es obligatorio </p>";
        }
		else if ($_POST['direccion']=='') {
            echo "<p> El campo Dirección de calle es obligatorio </p>";
        }
		else if ($_POST['telefono']=='') {
            echo "<p> El campo teléfono es obligatorio </p>";
        }
        else {

			$user = htmlspecialchars($_POST['usuario']);
			$usermayus = strtoupper($user);

            $query = "SELECT nombre_usuario FROM usuarios WHERE UPPER(nombre_usuario)='".$usermayus."'";
            $result = mysqli_query($enlace,$query);
            if (mysqli_num_rows($result)>0) {
                echo "<p> El nombre de usuario que ha elegido ya existe, eliga otro </p>";
            }
            else {
                //Añadimos al usuario
                //Ciframos la contrasena

				$correo = htmlspecialchars($_POST['email']);
				$correomayus = strtoupper($correo);

				$query = "SELECT correo FROM usuarios WHERE correo='".$correomayus."'";
            	$result = mysqli_query($enlace,$query);

				if (mysqli_num_rows($result)>0) {
					echo "<p> El Correo electrónico que ha elegido ya existe, eliga otro </p>";
				}

				else {

					$nombre = htmlspecialchars($_POST['nombre']);
					$apellido = htmlspecialchars($_POST['apellido']);
					$direccion = htmlspecialchars($_POST['direccion']);
					$telefono = htmlspecialchars($_POST['telefono']);

                	$contra = htmlspecialchars($_POST['contrasena']);
                	$cifrada = md5($contra);
                	$query="INSERT INTO usuarios (nombre_usuario, nombre, apellido, password, correo, direccion, telefono, admin) 
					VALUES('{$user}',
					'{$nombre}',
					'{$apellido}',
					'{$cifrada}',
					'{$correo}',
					'{$direccion}',
					'{$telefono}',
					'N')";
                	if (mysqli_query($enlace,$query)){
                    	echo "<p> Has sido registrado</p>";
                	}

                	else {
                    	echo "<p> El usuario no se ha creado correctamente </p>";
                	}
				}
        	}   
    	}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Formulario de registro</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<div class="contenedor">
		<h1>Crear cuenta</h1>
		<form method="post">
			<label for="usuario">Nombre de usuario:</label>
			<input type="text" name="usuario" id="usuario" placeholder="Ingrese su nombre de usuario" required>

			<label for="contrasena">Contraseña:</label>
			<input type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña" required>

			<label for="nombre">Nombre completo:</label>
			<input type="text" name="nombre" id="usuario" placeholder="Ingrese su nombre completo" required>

			<label for="apellido">Apellido:</label>
			<input type="text" name="apellido" id="usuario" placeholder="Ingrese su apellido" required>

			<label for="email">Correo:</label>
			<input type="email" name="email" id="usuario" placeholder="Ingrese su email" required>

			<label for="direccion">Dirección de calle:</label>
			<input type="text" name="direccion" id="usuario" placeholder="Ingrese su dirección" required>

			<label for="telefono">Teléfono:</label>
			<input type="text" name="telefono" id="usuario" placeholder="Ingrese su teléfono" required>

			<button type="submit" name="iniciar">Crear cuenta</button>

			<button type="submit" name="registrar" onclick="tengoCuenta()">¿Ya tienes cuenta? Logeate!!</button>
		</form>
	</div>
</body>
</html>

<script>
    function tengoCuenta() {
        window.location.href = 'https://proyectotienda-com.stackstaging.com/iniciosesion.php';
    }
</script>