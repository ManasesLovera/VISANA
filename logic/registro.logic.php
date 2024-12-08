<?php
require_once './config/database.php';
require_once 'helpers.php';

$errores = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
    $apellido = htmlspecialchars(trim($_POST['apellido']), ENT_QUOTES, 'UTF-8');
    $clave = trim($_POST['clave']);
    $direccion = htmlspecialchars(trim($_POST['direccion']), ENT_QUOTES, 'UTF-8');
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $upline = trim($_POST['upline']);
    $nacionalidad = htmlspecialchars(trim($_POST['nacionalidad']), ENT_QUOTES, 'UTF-8');
    $codigo = generarCodigoUnico($conn);

    // Validaciones
    if (strlen($nombre) < 2) $errores['nombre'] = "El nombre debe tener al menos 2 caracteres.";
    if (strlen($apellido) < 2) $errores['apellido'] = "El apellido debe tener al menos 2 caracteres.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores['email'] = "El correo no es válido.";
    if (!preg_match('/^\d{10,}$/', $telefono)) $errores['telefono'] = "El teléfono debe tener al menos 10 dígitos.";
    if (strlen($clave) < 8) $errores['clave'] = "La contraseña debe tener al menos 8 caracteres.";
    if ($upline && !($nombreUpline = validarUpline($conn, $upline))) {
        $errores['upline'] = "El upline proporcionado no existe.";
    }

    if (empty($errores)) {
        $claveHash = password_hash($clave, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO cliente (Nombre, Apellido, Clave, Direccion, Email, Telefono, Upline, Nacionalidad, Codigo, NombreCompleto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $nombreCompleto = $nombre . ' ' . $apellido;
        $stmt->bind_param("ssssssssss", $nombre, $apellido, $claveHash, $direccion, $email, $telefono, $upline, $nacionalidad, $codigo, $nombreCompleto);

        if ($stmt->execute()) {
            header("Location: registro.php?success=true&upline_nombre=$nombreUpline&codigo=$codigo");
            exit;
        } else {
            $errores['general'] = "Error al registrar. Intenta nuevamente.";
        }
        $stmt->close();
    }
}

$conn->close();