<?php
// =======================================
include __DIR__ . "/conecta.php";



// =======================================
// OBTENER DATOS DEL USUARIO A EDITAR
// =======================================

if (!isset($_GET['id'])) {
    die("ID no especificado");
}

$id = $_GET['id'];

$stmt = $conexion->prepare("SELECT * FROM usuario WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();

if (!$usuario) {
    die("Usuario no encontrado");
}


// =======================================
// SI ENVIARON FORMULARIO — ACTUALIZAR
// =======================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE usuario SET
                nombre = ?,
                apellido_paterno = ?,
                apellido_materno = ?,
                correo = ?,
                nickname = ?,
                id_rol = ?,
                id_genero = ?,
                id_cargo = ?,
                id_unidad_administrativa = ?
            WHERE id = ?";

    $stmt = $conexion->prepare($sql);

    try {
        $stmt->execute([
            $_POST['nombre'],
            $_POST['apellido_paterno'],
            $_POST['apellido_materno'],
            $_POST['correo'],
            $_POST['nickname'],
            $_POST['id_rol'],
            $_POST['id_genero'],
            $_POST['id_cargo'],
            $_POST['id_unidad_administrativa'],
            $id
        ]);

        header("Location: index.php");
        exit;

    } catch (PDOException $e) {
        die("Error al actualizar: " . $e->getMessage());
    }
}

?>

<!-- FORMULARIO BÁSICO PARA EDITAR -->
<form method="POST">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required>

    <label>Apellido paterno:</label>
    <input type="text" name="apellido_paterno" value="<?= $usuario['apellido_paterno'] ?>" required>

    <label>Apellido materno:</label>
    <input type="text" name="apellido_materno" value="<?= $usuario['apellido_materno'] ?>">

    <label>Correo:</label>
    <input type="email" name="correo" value="<?= $usuario['correo'] ?>" required>

    <label>Nickname:</label>
    <input type="text" name="nickname" value="<?= $usuario['nickname'] ?>">

    <label>ID Rol:</label>
    <input type="number" name="id_rol" value="<?= $usuario['id_rol'] ?>">

    <label>ID Género:</label>
    <input type="number" name="id_genero" value="<?= $usuario['id_genero'] ?>">

    <label>ID Cargo:</label>
    <input type="number" name="id_cargo" value="<?= $usuario['id_cargo'] ?>">

    <label>ID Unidad Administrativa:</label>
    <input type="number" name="id_unidad_administrativa" value="<?= $usuario['id_unidad_administrativa'] ?>">

    <br><br>

    <button type="submit">Actualizar usuario</button>

</form>
