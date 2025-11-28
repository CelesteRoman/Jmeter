<?php
include __DIR__ . "/conecta.php";

// =======================================
// ELIMINAR USUARIO
// =======================================

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = $_GET['id'];

$stmt = $conexion->prepare("DELETE FROM usuario WHERE id = ?");

try {
    $stmt->execute([$id]);
    header("Location: index.php");
    exit;

} catch (PDOException $e) {
    die("Error al eliminar: " . $e->getMessage());
}
