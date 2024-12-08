<?php

function generarCodigoUnico($conn) {
    do {
        $codigo = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 10);
        $stmt = $conn->prepare("SELECT COUNT(*) FROM cliente WHERE Codigo = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0);
    return $codigo;
}

function validarUpline($conn, $upline) {
    if (empty($upline)) {
        return true; // Si no se envía un upline, es válido.
    }
    $stmt = $conn->prepare("SELECT NombreCompleto FROM cliente WHERE Codigo = ?");
    $stmt->bind_param("s", $upline);
    $stmt->execute();
    $stmt->bind_result($nombreCompleto);
    $stmt->fetch();
    $stmt->close();

    return $nombreCompleto ?: false; // Devuelve el nombre completo o false si no existe.
}