<?php
// require_once $_SERVER['DOCUMENT_ROOT'].'/VISANA/config/database.php';
// require_once $_SERVER['DOCUMENT_ROOT'].'/VISANA/logic/helpers.php';

// function registrar($conn) {
//     $errores = [];
//     if ($_SERVER["REQUEST_METHOD"] === "POST") {
//         $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
//         $apellido = htmlspecialchars(trim($_POST['apellido']), ENT_QUOTES, 'UTF-8');
//         $usuario = htmlspecialchars(trim($_POST['usuario'] ?? ''), ENT_QUOTES, 'UTF-8');
//         $clave = trim($_POST['clave']);
//         $direccion = htmlspecialchars(trim($_POST['direccion']), ENT_QUOTES, 'UTF-8');
//         $email = trim($_POST['email']);
//         $telefono = trim($_POST['telefono']);
//         $upline = trim($_POST['upline']);
//         $nacionalidad = htmlspecialchars(trim($_POST['nacionalidad']), ENT_QUOTES, 'UTF-8');
//         $codigo = generarCodigoUnico($conn);

//         // Validaciones
//         if (strlen($nombre) < 2 || empty($nombre)) $errores['nombre'] = "El nombre debe tener al menos 2 caracteres.";
//         if (strlen($apellido) < 2 || empty($apellido)) $errores['apellido'] = "El apellido debe tener al menos 2 caracteres.";
//         if (strlen($usuario) < 2 || empty($usuairo)) $errores['usuario'] = "El usuario debe tener al menos 2 caracteres.";
//         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores['email'] = "El correo no es válido.";
//         if (!preg_match('/^\d{10,}$/', $telefono)) $errores['telefono'] = "El teléfono debe tener al menos 10 dígitos.";
//         if (strlen($clave) < 8) $errores['clave'] = "La contraseña debe tener al menos 8 caracteres.";
//         if ($clave !== $confirmarClave) $errores['confirmarClave'] = 'Las contraseñas no coinciden.';
//         if ($upline && !($nombreUpline = validarUpline($conn, $upline))) {
//             $errores['upline'] = "El upline proporcionado no existe.";
//         }

//         if (empty($errores)) {
//             $claveHash = password_hash($clave, PASSWORD_BCRYPT);
//             $stmt = $conn->prepare("INSERT INTO cliente (Nombre, Apellido, Clave, Direccion, Email, Telefono, Upline, Nacionalidad, Codigo, NombreCompleto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//             $nombreCompleto = $nombre . ' ' . $apellido;
//             $stmt->bind_param("ssssssssss", $nombre, $apellido, $claveHash, $direccion, $email, $telefono, $upline, $nacionalidad, $codigo, $nombreCompleto);

//             if ($stmt->execute()) {
//                 echo "<script>alert('Se registro exitosamente!');</script>";
//                 header("Location: login.php");
//                 exit;
//             } else {
//                 $errores['general'] = "Error al registrar. Intenta nuevamente.";
//                 echo "<script>alert('Error al registrar');</script>";
//                 header("Location: registro.php");
//             }
//             $stmt->close();
//         }
//     }
//     $conn->close();

//     return $errores;
// }
require_once $_SERVER['DOCUMENT_ROOT'].'/VISANA/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/VISANA/logic/helpers.php';

function registrar($conn) {
    $errores = [];

    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $clave = $_POST['clave'] ?? '';
    $confirmarClave = $_POST['confirmarClave'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');
    $upline = trim($_POST['upline'] ?? '');
    $nacionalidad = trim($_POST['nacionalidad']);
    $codigo = generarCodigoUnico($conn);

    // Validar campos requeridos
    if (empty($nombre)) $errores['nombre'] = 'El nombre es obligatorio.';
    if (empty($apellido)) $errores['apellido'] = 'El apellido es obligatorio.';
    if (empty($usuario)) $errores['usuario'] = 'El usuario es obligatorio.';
    if (empty($clave)) $errores['clave'] = 'La contraseña es obligatoria.';
    if ($clave !== $confirmarClave) $errores['confirmarClave'] = 'Las contraseñas no coinciden.';
    if (empty($email)) $errores['email'] = 'El correo es obligatorio.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores['email'] = 'El correo no es válido.';
    if (empty($upline)) $errores['upline'] = 'El código Upline es obligatorio.';
    if (empty($nacionalidad)) $errores['nacionalidad'] = 'El campo nacionalidad es obligatorio.';

    // Validar usuario único
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ? OR email = ?");
    $stmt->bind_param('ss', $usuario, $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errores['usuario'] = 'El usuario o correo ya está registrado.';
    }
    $stmt->close();

    // Validar Upline existente
    if (!empty($upline)) { // Verifica si el código upline no está vacío
        // Validar Upline existente
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE upline_code = ?");
        $stmt->bind_param('s', $upline);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 0) {
            $errores['upline'] = 'El código Upline no existe.';
        }
        $stmt->close();
    } else {
        // Si el código upline está vacío, lo dejamos pasar (opcionalmente puedes registrarlo como NULL en la base de datos)
        $upline = ''; // Asegúrate de que sea un string vacío para la base de datos
    }

    // Insertar usuario si no hay errores
    if (empty($errores)) {
        $hashedPassword = password_hash($clave, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO cliente (Nombre, Apellido, Usuario, NombreCompleto, Clave, Direccion, Telefono, Email, Upline, Nacionalidad, Codigo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $nombreCompleto = $nombre . ' ' . $apellido;
        $stmt->bind_param('sssssssssss', $nombre, $apellido, $usuario, $nombreCompleto, $hashedPassword, $direccion, $telefono, $email, $upline, $nacionalidad, $codigo);
        if ($stmt->execute()) {
            // Redireccion a login.php con mensaje de éxito
            echo "<script>
                alert('Se ha registrado exitosamente.');
                window.location.href = '../login.php';
            </script>";
            exit;
        } 
        else {
            $errores['general'] = 'Error al registrar el usuario.';
        }
        $stmt->close();
    }

    return $errores;
}
?>