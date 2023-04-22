<html>
    <link rel="stylesheet" type="text/css" href="style.css">
<body>
    <?php
    
    include 'database.php';

    $enlace = mysqli_connect($servidor, $usuario, $password, $database);
    
    if (isset($_COOKIE['id'])) {
        $valor_id = $_COOKIE['id'];
      } else {
        echo "La cookie no está definida.";
      }

    if (!$enlace) {
        echo "Conexión fallida: " . mysqli_connect_error();
    }
    else {
      $id=htmlspecialchars($_GET['usuario']); 
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


      $query = "SELECT usuarios.nombre_usuario, productos.nombre, carrito_producto.cantidad FROM carrito, carrito_producto, usuarios, productos 
      WHERE carrito.id_carrito = carrito_producto.id_carrito AND usuarios.id_usuario = carrito.id_usuario 
      AND productos.id_producto = carrito_producto.id_producto and usuarios.id_usuario=$valor_id;"; 
      $resultado = mysqli_query($enlace,$query); 
        
      if ($resultado->num_rows > 0) {
      // Saca datos de cada linea
      while($row = $resultado->fetch_assoc()) {
        
        $nombre_usuario=($row["nombre_usuario"]);
        $nombre=($row["nombre"]);
        $cantidad=($row["cantidad"]);
        echo "<div class='product'>";
        echo "<h2>$nombre_usuario</h2>";
        echo "<p>$nombre</p>";
        echo "<p>Cantidad: $cantidad</p>";
        echo "</div>";

      }
      echo "</div>";
      echo "<footer>";
      echo "<p>Derechos Reservados &copy; Tienda de Ropa</p>";
      echo "</footer>";
    }
        mysqli_close($enlace);
    }
?>
    
</body>
</html>