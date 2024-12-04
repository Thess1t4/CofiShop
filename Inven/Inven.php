<?php
$servername = "localhost";
$username = "root"; // tu usuario de base de datos
$password = ""; // tu contraseña de base de datos
$dbname = "inventario"; // nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

    $sql = "SELECT * FROM producto";
    $result = $conn->query($sql);
?>

<html>
    <head>
        <style>
            :root{
                --pink:#e84393;
            }
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family:Verdana, Geneva, Tahoma, sans-serif;
                outline: none;
                border: none;
                text-decoration: none;
                text-transform: capitalize;
                transition: .2s linear;
            }
    
            html{
                scroll-behavior: smooth;
                scroll-padding-top: 6rem;
                overflow-x: hidden;
            }
    
            section{
                padding: 2rem 9%;
            }
    
            header{
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                background: #fff;
                padding: 2rem 9%;
                display: flex;
                align-items: center;
                justify-content: space-between;
                z-index: 1000;
                box-shadow: 0 .5rem 1rem rgb(0, 0, 0,.1);
            }
    
            header .logo{
                font-size: 3rem;
                color: #333;
                font-weight: bolder;
            }
    
            header .logo span{
                color: var(--pink);
            }
    
            header .navbar a{
                font-size: 2rem;
                padding: 0 1.5rem;
                color: #666;
            }
    
            header .navbar a:hover{
                color: var(--pink);
            }

            .products .box-container{
                display: flex;
                flex-wrap: wrap;
                gap: 1.5rem;
            }

            .products .box-container .box{
                flex: 1 1 30rem;
                box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0,.1);
                border-radius: .5rem;
                border: .1rem solid rgba(0, 0, 0, .1);
                position: relative;
            }

            .products .box-container .box .image{
                position: relative;
                text-align: center;
                padding-top: 2rem;
                overflow: hidden;
            }

            .products .box-container .box .image img{
                height: 25rem;
            }

            .products .box-container .box:hover .image img{
                transform: scale(1.1);
            }

            .products .box-container .box:hover .image .icons{
                position:absolute;
                bottom: 0;
                left: 0;
                right: 0;
                display: flex;
            }

            .products .box-container .box  .content{
                padding: 2rem;
                text-align: center;
            }

            .products .box-container .box  .content h3{
                font-size: 2.5rem;
                color: #333;
            }

            .products .box-container .box  .content .price{
                font-size: 2.5rem;
                color: var(--pink);
                font-weight: bolder;
                padding-top: 1rem;
            }

            .products .box-container .box  .content .price span{
                font-size: 1.5rem;
                color: #999;
                font-weight: lighter;
                text-decoration: none;
            }

            .boton-1{
                display: flex;
            }

            .btn-1{
                overflow: hidden;
                position: relative;
                text-decoration: none;
                color: #fff;
                padding: 10px 20px;
                border-radius: 30px;
                box-shadow: 0 0 0 0 rgba(143, 64, 248, 0.5),
                0 0 0 0 rgba(39, 200, 255, 0.5);
                transition: transform 0.3s ease,
                box-shadow 0.3s ease;
            }

            .btn-1::after{
                content: "";
                width: 400px;
                height: 400px;
                position: absolute;
                top: -50px;
                left: -100px;
                background-color: #ff3cac;
                background-image: linear-gradient(255deg, 
                #27d86c 0%,
                #26caf8 50%,
                #c625d0 100%
                );
                z-index: -100;
                transition: transform 0.5s ease;
            }

            .btn-1:hover{
                transform: translate(0, -6px);
                box-shadow: 10px -10px 25px 0 rgba(143, 64, 248, 0.5),
                10px -10px 25px 0 rgba(39, 200, 255, 0.5);
            }

            .btn-1:hover::after{
                transform: rotate(150deg);
            }
        </style>

<script>
        // Función para mostrar la alerta si el stock es bajo
        function mostrarAlertaProductoBajo(nombreProducto) {
            alert("¡Alerta! El producto " + nombreProducto + " está casi agotado.");
        }
    </script>
    </head>

    <body>
        <header>
            <a href="#" class="logo"> CofiShop<span>.</span></a>
    
            <nav class="navbar">
               <a href="index2.php">Inicio</a>
                <a href="Registro.php">Registrar</a>
                <a href="cerrar.php">Cerrar</a>
            </nav>
        </header>

        <section class="products" id="products">
            <h1 class="hearing"> latest <span>products</span></h1>
            
            <div class="box-container">
                <?php
                // Verificar si la consulta devolvió resultados
                if ($result->num_rows > 0) {
                    // Mostrar cada producto
                    while($row = $result->fetch_assoc()) {
                        $nombreProducto = $row["nombre"];
                    $cantidadProducto = $row["cantidad"];
                    if ($cantidadProducto <= 5) {
                        echo '<script>mostrarAlertaProductoBajo("' . $nombreProducto . '");</script>';
                    }
                        echo '
                        <div class="box">
                            <div class="image">
                                <img src="' . $row["imagen"] . '" alt="">
                                <div class="icons">
                                    <a href="#" class="fas fa-heart"></a>
                                    <a href="#" class="fas fa-share"></a>
                                </div>
                            </div>
                            <div class="content">
                                <h3>' . $row["nombre"] . '</h3>
                                <div class="price">$' . $row["precio"] . ' <span>Cantidad: ' . $row["cantidad"] . '</span></div>
                                <div class="boton-1"><a href="Modificar.php?id=' . $row["id"] . '" class="btn-1">Modificar</a></div>
                                <form action="eliminar.php" method="POST" style="display:inline;" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar este producto?\');">
                                <input type="hidden" name="id" value="' . $row["id"] . '">
                                <button type="submit" class="btn-1" style="margin-left: 10px;">Eliminar</button>
                            </form>
                            </div>
                        </div>';
                        
                    }
                } else {
                    echo "No hay productos disponibles.";
                }

                // Cerrar la conexión
                $conn->close();
                ?>
            </div>
        </section>
    </body>
</html>