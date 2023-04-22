<?php 

    include "database.php";


    if (mysqli_connect_error()) {
        die("Error en la conexión");
    }
    else {

        if(isset($_GET['producto_id'])) {
            $idusuario = $_COOKIE['id'];
            $productoid = htmlspecialchars($_GET['producto_id']);
            $id= htmlspecialchars($_GET['producto_id']);
            $query = "SELECT carrito_producto.id_carrito, carrito_producto.id_producto, carrito_producto.cantidad FROM carrito_producto, carrito, usuarios 
            WHERE carrito_producto.id_carrito=carrito.id_carrito AND carrito.id_usuario=usuarios.id_usuario AND usuarios.id_usuario={$idusuario} AND carrito_producto.id_producto={$producto_id}";
            $resultado= mysqli_query($enlace, $query);

            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    $producto=($row["id_producto"]);
                    $cantidad=($row["cantidad"]);
                    $carrito=($row["id_carrito"]);
                    if ($cantidad>0) {
                        $cantidadtotal=$cantidad+1;
                        $query = "UPDATE carrito_producto SET cantidad={$cantidadtotal} WHERE id_carrito={$carrito} AND id_producto={$producto}";
                        $resultado= mysqli_query($enlace, $query);
                        if (!$resultado) {
                            echo "Algo ha salido mal";
                        }
                        else {
                            echo "<script>window.location.href = 'https://proyectotienda-com.stackstaging.com/';</script>";
                        }
                    }
                    else {
                        $query = "INSERT INTO carrito_producto (id_carrito, id_producto, cantidad) 
                        VALUES((SELECT id_carrito FROM carrito WHERE id_usuario={$idusuario}), {$productoid}, 1)";
                        $resultado= mysqli_query($enlace, $query);
                        if (!$resultado) {
                            echo "Algo ha salido mal";
                        }
                        else {
                            echo "<script>window.location.href = 'https://proyectotienda-com.stackstaging.com/';</script>";
                        }
                    }
                }
            }
            else {
                $query = "INSERT INTO carrito_producto (id_carrito, id_producto, cantidad) 
                VALUES((SELECT id_carrito FROM carrito WHERE id_usuario={$idusuario}), {$productoid}, 1)";
                $resultado= mysqli_query($enlace, $query);
                if (!$resultado) {
                    echo "Algo ha salido mal";
                }
                else {
                    echo "<script>window.location.href = 'https://proyectotienda-com.stackstaging.com/';</script>";
                }
                
            }

            echo "<script>window.location.href = 'https://proyectotienda-com.stackstaging.com/';</script>";
            
        }
    }
?>