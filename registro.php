<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "VISANA"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Lógica de procesamiento de formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitización y validación de campos
    $nombre = isset($_POST['nombre']) ? htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8') : '';
    $apellido = isset($_POST['apellido']) ? htmlspecialchars(trim($_POST['apellido']), ENT_QUOTES, 'UTF-8') : '';
    $clave = isset($_POST['clave']) ? trim($_POST['clave']) : '';
    $direccion = isset($_POST['direccion']) ? htmlspecialchars(trim($_POST['direccion']), ENT_QUOTES, 'UTF-8') : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';

    // Validacion adicional
    $errores = [];

    // Validar nombre y apellido (mínimo 2 caracteres)
    if (empty($nombre) || strlen($nombre) < 2) {
        $errores[] = "El nombre debe tener al menos 2 caracteres.";
    }
    if (empty($apellido) || strlen($apellido) < 2) {
        $errores[] = "El apellido debe tener al menos 2 caracteres.";
    }
    // Validar correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    // Validar teléfono (solo números y mínimo 10 dígitos)
    if (!preg_match('/^\d{10,}$/', $telefono)) {
        $errores[] = "El teléfono debe contener solo números y al menos 10 dígitos.";
    }

    // Validar contraseña (mínimo 8 caracteres)
    if (strlen($clave) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres.";
    } else {
        // Hash de la contraseña
        $claveHash = password_hash($clave, PASSWORD_BCRYPT);
    }

    // Verificar si hay errores
    if (count($errores) > 0) {
        foreach ($errores as $error) {
            echo "<script>alert('$error');</script>";
        }
    } else {
        // Crear nombre completo
        $nombreCompleto = $nombre . ' ' . $apellido;

        // Preparar la consulta SQL
        $stmt = $conn->prepare("INSERT INTO cliente (Nombre, Apellido, Clave, Direccion, Email, Telefono, NombreCompleto) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nombre, $apellido, $claveHash, $direccion, $email, $telefono, $nombreCompleto);

        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso');</script>";
        } else {
            echo "<script>alert('Error al registrar: " . $stmt->error . "');</script>";
        }
        $stmt->close();
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
        <div class="row">
        <h2 class="text-center pb-5">Registro</h2>
        <form method="POST" action="registro.php">
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control mt-1" id="nombre" name="nombre" required>
                </div>
            
            
                <div class="form-group col-md-6 mb-3">
                    <label for="apellido">Apellidos</label>
                    <input type="text" class="form-control mt-1" id="apellido" name="apellido" required>
                </div>
                
                <div class="form-group col-md-6 mb-3">
                    <label for="clave">Contraseña</label>
                    <input type="password" class="form-control mt-1" id="clave" name="clave" required>
                </div>
            
                <div class="form-group col-md-6 mb-3">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control mt-1" id="direccion" name="direccion" required>
                </div>
            
                <div class="form-group col-md-6 mb-3">
                    <label for="email">Correo</label>
                    <input type="text" class="form-control mt-1" id="email" name="email" required>
                </div>
                
                <div class="form-group col-md-6 mb-3">
                    <label for="telefono" >Telefono</label>
                    <input type="tel" class="form-control mt-1" id="telefono" name="telefono" required>
                </div>
            </div> 
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
            
        </form>
    </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
