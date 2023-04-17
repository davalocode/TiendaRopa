<?php 
    include "database.php";


    if (mysqli_connect_error()) {
        die("Error en la conexión que has hecho");
    }
    else {
                $id= htmlspecialchars($_GET['usuario']);
                $query = "UPDATE usuarios SET admin='N' WHERE id_usuario = $id"; 
                $resultado= mysqli_query($enlace, $query);
                echo "<script>window.location.href = 'https://proyectotienda-com.stackstaging.com/mostrar_usuarios.php';</script>";
    }
?>