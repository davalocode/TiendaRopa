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
      echo "<li><a href='mostrar_carrito.php'>Mi Carrito</a></li>";
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


        $query = "SELECT id_producto, nombre, descripcion, imagen, precio_unidad
        FROM productos"; 
        $resultado = mysqli_query($enlace,$query); 
        
        if ($resultado->num_rows > 0) {
      // Saca datos de cada linea
      while($row = $resultado->fetch_assoc()) {
        
        $nombre=($row["nombre"]);
        $id=($row["id_producto"]);
        $descripcion=($row["descripcion"]);
        $imagen=($row["imagen"]);
        $precio_unidad=($row["precio_unidad"]);
        echo "<div class='product'>";
        echo "<h2>$nombre</h2>";
        echo "<p>$descripcion</p>";
        echo "<p>Precio: $precio_unidad</p>";
        echo "<img src='$imagen' alt='$nombre'>";
        echo "<br>";
        echo "<a href='anadirCarrito.php?producto_id={$id}'>Añadir al Carrito</a>";
        echo "</div>";

      }
      echo "</div>";
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