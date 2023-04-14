<?php 
    $servidor = "sdb-57.hosting.stackcp.net";
    $database = "proyectotienda-35303135db7e";
    $usuario = "dani-8dfc";
    $password = "usuario123";
    
    $enlace = mysqli_connect($servidor, $usuario, $password, $database);
    
    if (!$enlace) {
        echo "Conexión fallida: " . mysqli_connect_error();
    }
 else {
    echo "<script>window.location.href = 'http://proyectotienda-com.stackstaging.com/index.php';</script>";
    }
    ?>