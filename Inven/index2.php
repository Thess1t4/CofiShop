<?php
session_start(); // Iniciar sesión

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir al login
    header("Location: inicio.php");
    exit();
}

echo "Bienvenido, " . $_SESSION['usuario'] . "!"; // Mostrar el usuario logueado
?>

<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

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

        .home{
            display: flex;
            align-items: center;
            min-height: 100vh;
            background: url('logito.png') no-repeat;
            background-size: cover;
            background-position: center;
        }

        .home .content{
            max-width: 50rem;

        }

        .home .content h3{
            font-size: 6rem;
            color: #333;
        }

        .home .content span{
            font-size: 3.5rem;
            color: var(--pink);
            padding: 1rem 0;
            line-height: 1.5;
        }

        .home .content span{
            font-size: 1.5rem;
            color: #1f1d1d;
            padding: 1rem 0;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <header>
        <a href="#" class="logo"> CofiShop<span>.</span></a>

        <nav class="navbar">
        <a href="">Inicio</a>
            <a href="Inven.php">Inventario</a>
            <a href="Registro.php">Registrar</a>
            <a href="cerrar.php">Cerrar</a>
        </nav>
    </header>

    <section class="home" id="home">
        <div class="content">
            <h3>CofiShop</h3>
            <span> BIENVENIDO </span>
        </div>
    </section>

</body>
</html>