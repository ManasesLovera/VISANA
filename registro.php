<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "visanaco_admin"; 
$password = "Bunker12345*"; 
$dbname = "visanaco_Registro"; 
// Conexión a la base de datos
//$servername = "localhost";
//$username = "root"; 
//$password = ""; 
//$dbname = "registro"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Lógica de procesamiento de formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $numerodocumento = $_POST['numerodocumento'] ?? '';
    $upline = $_POST['upline'] ?? '';
    $numerocelular = $_POST['numerocelular'] ?? '';
    $CorreoElectronico	= $_POST['CorreoElectronico'] ?? '';
    $direccionresidencia = $_POST['direccionresidencia'] ?? '';
    $nacionalidad = $_POST['nacionalidad'] ?? '';

    // Validación básica
    if (!empty($nombre) && !empty($apellidos) && !empty($numerodocumento) && !empty($upline) && !empty($numerocelular) &&  !empty($CorreoElectronico) && !empty($direccionresidencia && !empty($nacionalidad) )) {
        $stmt = $conn->prepare("INSERT INTO registrousuarios (nombre, apellidos, numerodocumento, upline, numerocelular, CorreoElectronico	, direccionresidencia, nacionalidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nombre, $apellidos, $numerodocumento, $upline, $numerocelular, $CorreoElectronico	, $direccionresidencia, $nacionalidad);

        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso');</script>";
        } else {
            echo "<script>alert('Error al registrar: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Por favor, complete todos los campos');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>VISANA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">administrativo@visana.com.co</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                </div>
                <div>
                    <a class="text-light" href="" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
                VISANA
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.html">Comprar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contactenos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registro.php">Registro</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Header -->

    <div class="container py-5">
        <div class="row py-5">
        <h2 class="text-center">Registro</h2>
        <form method="POST" action="registro.php">
        <div class="row">
            
                <div class="form-group col-md-6 mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control mt-1" id="nombre" name="nombre" required>
                </div>
            
           
                <div class="form-group col-md-6 mb-3">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control mt-1" id="apellidos" name="apellidos" required>
                </div>
              
                
                <div class="form-group col-md-6 mb-3">
                    <label for="numerodocumento">Numero Documento</label>
                    <input type="text" class="form-control mt-1" id="numerodocumento" name="numerodocumento" required>
                </div>
            
            
                <div class="form-group col-md-6 mb-3">
                    <label for="upline">UpLine</label>
                    <input type="text" class="form-control mt-1" id="upline" name="upline" required>
                </div>
            
            
                <div class="form-group col-md-6 mb-3">
                    <label for="numerocelular">Celular</label>
                    <input type="text" class="form-control mt-1" id="numerocelular" name="numerocelular" required>
                </div>
            
            <div class="form-group col-md-6 mb-3">
                <label for="CorreoElectronico" >Correo Electronico	</label>
                <input type="CorreoElectronico" class="form-control mt-1" id="CorreoElectronico" name="CorreoElectronico" required>
            </div>
            
            <div class="form-group col-md-6 mb-3">
                <label for="direccionresidencia" >Dirección Residencia</label>
                <input type="text" class="form-control mt-1" id="direccionresidencia" name="direccionresidencia" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <div class="form-group col-md-6 mb-3">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input type="text" class="form-control mt-1" id="nacionalidad" name="nacionalidad" required>
                </div>
            </div> 
            </div> 
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    </div>

    

    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
