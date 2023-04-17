<html>
    <link rel="stylesheet" type="text/css" href="style.css">
<body>
    <?php
    
    include 'database.php';
    
    $enlace = mysqli_connect($servidor, $usuario, $password, $database);
    
    if (!$enlace) {
        echo "Conexión fallida: " . mysqli_connect_error();
    }
    else {

      echo "<header>";
      echo "<h1>LA ROPA DE SIEMPRE</h1>";
      echo "<nav>";
      echo "<ul>";
      echo "<li><a href='#'>Inicio</a></li>";
      echo "<li><a href='#'>Inicio</a></li>";
      echo "<li><a href='#'>Inicio</a></li>";
      echo "<li><a href='iniciosesion.php?Logout=1'>Cerrar sesión</a></li>";
      echo "</ul>";
      echo "</nav>";
      echo "</header>";

      echo "<div class='categories'>";
      echo "<h2>Categorias</h2>";
      echo "<ul>";
      echo "<li><a href='mostrar_individual.php?individual=1'>Hombre</a></li>";
      echo "<li><a href='mostrar_individual.php?individual=2'>Mujer</a></li>";
      echo "<li><a href='mostrar_individual.php?individual=3'>Niño</a></li>";
      echo "<li><a href='mostrar_individual.php?individual=4'>Ambos</a></li>";
      echo "</ul>";
      echo "</div>";

      echo "<main class='content'>";
      echo "<table>";
      echo "<tr>";
        echo "<td>Nombre del usuario</td>";
        echo "<td>Nombre</td>";
        echo "<td>Apellido</td>";
        echo "<td>Correo</td>";
        echo "<td>Direccion</td>";
        echo "<td>Telefono</td>";
        echo "<td>Administrador</td>";
        echo "<td>Borrar</td>";
        echo "<td>Cambiar</td>";
        echo "</tr>";


        $query = "SELECT  id_usuario, nombre_usuario, nombre, apellido, correo, direccion, telefono, admin
        FROM usuarios"; 
        $resultado = mysqli_query($enlace,$query); 
        
        if ($resultado->num_rows > 0) {
      // Saca datos de cada linea
      while($row = $resultado->fetch_assoc()) {
        $id_usuario=($row["id_usuario"]);
        $nombre_usuario=($row["nombre_usuario"]);
        $nombre=($row["nombre"]);
        $apellido=($row["apellido"]);
        $correo=($row["correo"]);
        $direccion=($row["direccion"]);
        $telefono=($row["telefono"]);
        $admin=($row["admin"]);
        if ($admin=="N") {
          echo "<tr>";
        echo "<td>$nombre_usuario</td>";
        echo "<td>$nombre</td>";
        echo "<td>$apellido</td>";
        echo "<td>$correo</td>";
        echo "<td>$direccion</td>";
        echo "<td>$telefono</td>";
        echo "<td>$admin</td>";
        echo "<td><a href='borrar.php?usuario=$id_usuario'>Borrar</a></td>";
        echo "<td><a href='cambiar_admin.php?usuario=$id_usuario'>CambiarAdmin</a></td>";
        echo "</tr>";
        }
        else {
          echo "<tr class='administrador'>";
        echo "<td>$nombre_usuario</td>";
        echo "<td>$nombre</td>";
        echo "<td>$apellido</td>";
        echo "<td>$correo</td>";
        echo "<td>$direccion</td>";
        echo "<td>$telefono</td>";
        echo "<td>$admin</td>";
        echo "<td><a href='borrar.php?usuario=$id_usuario'>Borrar</a></td>";
        echo "<td><a href='cambiar_usuario.php?usuario=$id_usuario'>CambiarUsuario</a></td>";
        echo "</tr>";
        }

      }
      echo "</table>";
      echo "<footer>";
      echo "<p>Derechos Reservados &copy; Tienda de Ropa</p>";
      echo "</footer>";

    } else {
      echo "0 results";
    }
        mysqli_close($enlace);
    }
?>
    
</body>
</html>