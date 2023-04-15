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

      if(isset($_GET['individual']))
     {
      $id=htmlspecialchars($_GET['individual']); 
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


      $query = "SELECT productos.nombre, productos.descripcion, 
      productos.imagen, productos.precio_unidad 
      FROM productos, tipo 
      WHERE productos.id_tipo = tipo.id_tipo AND tipo.id_tipo=$id"; 
      $resultado = mysqli_query($enlace,$query); 
        
      if ($resultado->num_rows > 0) {
      // Saca datos de cada linea
      while($row = $resultado->fetch_assoc()) {
        
        $nombre=($row["nombre"]);
        $descripcion=($row["descripcion"]);
        $imagen=($row["imagen"]);
        $precio_unidad=($row["precio_unidad"]);
        echo "<div class='product'>";
        echo "<h2>$nombre</h2>";
        echo "<p>$descripcion</p>";
        echo "<p>Precio: $precio_unidad</p>";
        echo "<img src='$imagen' alt='$nombre'>";
        echo "<br>";
        echo "<button>Añadir al Carrito</button>";
        echo "</div>";

      }
      echo "</div>";
      echo "<footer>";
      echo "<p>Derechos Reservados &copy; Tienda de Ropa</p>";
      echo "</footer>";
    }

    } else {
      echo "0 results";
    }
        mysqli_close($enlace);
    }
?>
    
</body>
</html>